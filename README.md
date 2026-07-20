# Magento GraphQL schema history

This repo tracks the GraphQL schema of every Magento 2 release as a series of git commits to
`schema.graphql`, one commit per Magento version (oldest first). The SDL is sorted
alphabetically (types, fields, arguments, enum values) before committing, so diffs between
versions show real schema changes only.

Each version's commit is tagged with the version number, so comparing releases is:

```
git diff 2.4.8 2.4.9 -- schema.graphql
```

or on GitHub: `https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8...2.4.9`

## Adding a new version

Dispatch the `register-schema.yml` workflow with the new `magento_version` (plus matching
`php_version`, `mysql_version`, `search_engine`, `search_image` inputs). It installs Magento,
generates the schema, sorts it and commits + tags it. **Dispatch one version at a time, oldest
first, and wait for each run to finish** — commit order is the diff chain.

## Version compatibility

Magento 2.4.8 removed Elasticsearch support entirely, so 2.4.8 and later must be run with
`search_engine=opensearch` and an OpenSearch image. Known-good input combinations:

| Magento | php_version | mysql_version | search_engine  | search_image                            |
|---------|-------------|---------------|----------------|-----------------------------------------|
| ≤ 2.4.7 | per release | 8.0           | elasticsearch7 | docker.io/wardenenv/elasticsearch:7.6   |
| 2.4.8   | 8.3         | 8.0           | opensearch     | opensearchproject/opensearch:2.19.1     |
| 2.4.9   | 8.3         | 8.4           | opensearch     | opensearchproject/opensearch:2.19.1     |

## Old Magento versions

The workflow patches the installed Magento before `setup:install` (see `.github/patches/`):

- `acsd-59280-union-types.php` — Magento < 2.4.5's code generator crashes on PHP 8 union types in
  dependency signatures (backport of the official 2.4.5 fix).
- `polyfill-framework-interfaces.php` — Adobe republished old module packages (MSI,
  security-package) in place with code implementing framework interfaces that only exist in
  Magento ≥ 2.4.6; this polyfills the missing interfaces.

The workflow also disables composer's security-advisory blocking (composer ≥ 2.9 refuses to install
old Magento versions otherwise).

## History

The 2.3.0 – 2.4.9 commits were seeded from the schemas previously published to GraphQL Hive
(fetched with the since-removed `replay-history.yml` workflow, sorted with
`.github/scripts/sort-schema.js`). Hive is no longer used.

## Run using act

You can run the github actions workflow locally by using [act](https://github.com/nektos/act).
```
act --secret-file .secrets --input magento_version=2.4.6 --input php_version=8.1
```

`.secrets` needs `AUTH_JSON` (repo.magento.com credentials, see 1Password). Note the final
commit+push step will fail locally under act; the generated `schema.graphql` is still produced.
