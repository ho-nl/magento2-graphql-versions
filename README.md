# Regsiter Magento GraphQL Schema

This project allows you to register the Magento GraphQL schema in [Hive](https://the-guild.dev/graphql/hive).

Schemas are published to the `reach-digital/magento2-second/m2` target. Publishing goes through the
`magento2-second` GitHub environment, whose `HIVE_ACCESS_TOKEN` secret holds a Hive access token with
schema-publish permission on that project. Publish order matters: Hive's version history is the diff
chain, so **never run the workflow for multiple versions concurrently** — dispatch versions one at a
time, oldest first, and wait for each run to finish.

## Workflows

- `register-schema.yml` — installs a Magento version and publishes its GraphQL schema.
- `replay-history.yml` — fetches existing schema versions from an old Hive target (repo-level
  `HIVE_ACCESS_TOKEN` secret) and republishes them to a new target in ascending version order. Used
  to rebuild a clean history on a fresh target; safe to re-run, aborts on the first failed publish.

## Old Magento versions

The workflow patches the installed Magento before `setup:install` (see `.github/patches/`):

- `acsd-59280-union-types.php` — Magento < 2.4.5's code generator crashes on PHP 8 union types in
  dependency signatures (backport of the official 2.4.5 fix).
- `polyfill-framework-interfaces.php` — Adobe republished old module packages (MSI,
  security-package) in place with code implementing framework interfaces that only exist in
  Magento ≥ 2.4.6; this polyfills the missing interfaces.

The workflow also disables composer's security-advisory blocking (composer ≥ 2.9 refuses to install
old Magento versions otherwise).


## Version compatibility

Magento 2.4.8 removed Elasticsearch support entirely, so 2.4.8 and later must be run with
`search_engine=opensearch` and an OpenSearch image. Known-good input combinations:

| Magento | php_version | mysql_version | search_engine  | search_image                            |
|---------|-------------|---------------|----------------|-----------------------------------------|
| ≤ 2.4.7 | per release | 8.0           | elasticsearch7 | docker.io/wardenenv/elasticsearch:7.6   |
| 2.4.8   | 8.3         | 8.0           | opensearch     | opensearchproject/opensearch:2.19.1     |
| 2.4.9   | 8.3         | 8.4           | opensearch     | opensearchproject/opensearch:2.19.1     |

## Run using act

You can run the github actions workflow locally by using [act](https://github.com/nektos/act).
```
act --secret-file .secrets --input magento_version=2.4.6 --input php_version=8.1
```

You will need to create the secrets file. See the Hive entry in the team vault in 1password for its contents.
