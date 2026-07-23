# Magento GraphQL schema history

This repo tracks the GraphQL schema of every Magento 2 release as a series of git commits to
`schema.graphql`, one commit per Magento version (oldest first). The SDL is sorted
alphabetically (types, fields, arguments, enum values) before committing, so diffs between
versions show real schema changes only.

Each version's commit is tagged with the version number, so comparing releases is:

```
git diff 2.4.8 2.4.9 -- schema.graphql
```

or on GitHub via the compare links below.

## Schema diffs

One row per Magento version, with the core (bundled-free) build as the hub in the middle. **↓**
compares a tag against the previous release in the same column — patch rows (`-pN`) chain within
their own patch line, which branches off its base version. The **←** column compares core against
the bundled Magento build of the same row (what the bundled extensions add); the **→** column
compares core against the Mage-OS release of the same row (how Mage-OS differs from its base).
All links are direct two-dot diffs.

| Magento | ← | Magento core | → | Mage-OS |
|---------|:-:|--------------|:-:|---------|
| 2.3.0 | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.0..2.3.0) | core-2.3.0 |  |  |
| 2.3.1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.0..2.3.1) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.1..2.3.1) | core-2.3.1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.0..core-2.3.1) |  |  |
| 2.3.2 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.1..2.3.2) |  | *(unbuildable)* |  |  |
| 2.3.3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.2..2.3.3) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.3..2.3.3) | core-2.3.3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.1..core-2.3.3) |  |  |
| 2.3.4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.3..2.3.4) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.4..2.3.4) | core-2.3.4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.3..core-2.3.4) |  |  |
| 2.3.5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.4..2.3.5) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.5..2.3.5) | core-2.3.5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.4..core-2.3.5) |  |  |
| 2.4.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.5..2.4.0) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.0..2.4.0) | core-2.4.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.5..core-2.4.0) |  |  |
| 2.4.1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.0..2.4.1) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.1..2.4.1) | core-2.4.1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.0..core-2.4.1) |  |  |
| 2.4.2 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.1..2.4.2) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.2..2.4.2) | core-2.4.2 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.1..core-2.4.2) |  |  |
| 2.4.3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.2..2.4.3) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.3..2.4.3) | core-2.4.3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.2..core-2.4.3) |  |  |
| 2.4.4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.3..2.4.4) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.4..2.4.4) | core-2.4.4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.3..core-2.4.4) |  |  |
| 2.4.5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.4..2.4.5) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.5..2.4.5) | core-2.4.5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.4..core-2.4.5) |  |  |
| 2.4.6 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.5..2.4.6) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6..2.4.6) | core-2.4.6 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.5..core-2.4.6) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6..mage-os-1.0.0) | mage-os-1.0.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.6..mage-os-1.0.0) |
| 2.4.6-p8 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.6..2.4.6-p8) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6-p8..2.4.6-p8) | core-2.4.6-p8 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6..core-2.4.6-p8) |  |  |
| 2.4.6-p9 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.6-p8..2.4.6-p9) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6-p9..2.4.6-p9) | core-2.4.6-p9 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6-p8..core-2.4.6-p9) |  |  |
| 2.4.6-p15 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.6-p9..2.4.6-p15) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6-p15..2.4.6-p15) | core-2.4.6-p15 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6-p9..core-2.4.6-p15) |  |  |
| 2.4.7 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.6..2.4.7) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.7..2.4.7) | core-2.4.7 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.6..core-2.4.7) |  |  |
| 2.4.8 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.7..2.4.8) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8..2.4.8) | core-2.4.8 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.7..core-2.4.8) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8..mage-os-1.1.0) | mage-os-1.1.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-1.0.0..mage-os-1.1.0) |
| 2.4.8-p1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8..2.4.8-p1) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p1..2.4.8-p1) | core-2.4.8-p1 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8..core-2.4.8-p1) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p1..mage-os-1.2.0) | mage-os-1.2.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-1.1.0..mage-os-1.2.0) |
| 2.4.8-p2 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8-p1..2.4.8-p2) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p2..2.4.8-p2) | core-2.4.8-p2 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p1..core-2.4.8-p2) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p2..mage-os-1.3.0) | mage-os-1.3.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-1.2.0..mage-os-1.3.0) |
| 2.4.8-p3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8-p2..2.4.8-p3) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p3..2.4.8-p3) | core-2.4.8-p3 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p2..core-2.4.8-p3) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p3..mage-os-2.0.0) | mage-os-2.0.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-1.3.0..mage-os-2.0.0) |
|  |  |  | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p3..mage-os-2.1.0) | mage-os-2.1.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-2.0.0..mage-os-2.1.0) |
| 2.4.8-p4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8-p3..2.4.8-p4) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p4..2.4.8-p4) | core-2.4.8-p4 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p3..core-2.4.8-p4) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p4..mage-os-2.2.0) | mage-os-2.2.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-2.1.0..mage-os-2.2.0) |
| 2.4.8-p5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8-p4..2.4.8-p5) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p5..2.4.8-p5) | core-2.4.8-p5 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p4..core-2.4.8-p5) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8-p5..mage-os-2.3.0) | mage-os-2.3.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-2.2.0..mage-os-2.3.0) |
| 2.4.9 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/2.4.8..2.4.9) | [←](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.9..2.4.9) | core-2.4.9 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.8..core-2.4.9) | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.9..mage-os-3.0.0) | mage-os-3.0.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-2.3.0..mage-os-3.0.0) |
|  |  |  | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.9..mage-os-3.1.0) | mage-os-3.1.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-3.0.0..mage-os-3.1.0) |
|  |  |  | [→](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.4.9..mage-os-3.2.0) | mage-os-3.2.0 [↓](https://github.com/ho-nl/magento2-graphql-versions/compare/mage-os-3.1.0..mage-os-3.2.0) |

Notes:

- **Magento core** (`magento-core` branch, `core-*` tags) is Magento without the bundled
  third-party extensions: installed with
  [yireo/magento2-replace-bundled](https://github.com/yireo/magento2-replace-tools) and, from
  2.4.7, with `Magento_PaymentServicesPaypalGraphQl` disabled (Adobe Payment Services is bundled
  but not covered by the replace list). core-2.3.2 cannot be built: its republished module set
  produces an internally inconsistent schema (`CartItemInput` referenced but never defined).
- **Patch versions**: the GraphQL schema only ever changed in a handful of patch releases
  (2.4.6-p8/p9/p15 and 2.4.8-p1, determined by diffing `*schema.graphqls` between all patch tags of
  the magento2 repository). The remaining `-pN` rows are present as Mage-OS base anchors and are
  schema-identical to their line's last changing patch — their tags point at that same commit, so a
  ↓ between two of them shows an empty ("identical") diff. Schema-changing patch commits live on
  small side branches off their base version, so the main chain stays a linear minor-version history.
- **Mage-OS** rows sit next to the Magento version their release is based on, per the
  [Mage-OS compatibility matrix](https://mage-os.org/get-started/system-requirements/)
  (1.0.0 → 2.4.6, 1.1.0 → 2.4.8, 1.2.0 → 2.4.8-p1, 1.3.0 → 2.4.8-p2, 2.0.0 / 2.1.0 → 2.4.8-p3,
  2.2.0 → 2.4.8-p4, 2.3.0 → 2.4.8-p5, 3.x → 2.4.9). Mage-OS releases with no schema change are
  tagged on their predecessor's commit, so their ↓ links show an empty diff.
- Mage-OS ships without the Adobe-bundled extensions, which is why its → comparisons are against
  the `core-*` tags; comparing against plain Magento would drown real differences in bundled noise.
- Full ranges: [Magento 2.3.0..2.4.9](https://github.com/ho-nl/magento2-graphql-versions/compare/2.3.0..2.4.9),
  [core-2.3.0..core-2.4.9](https://github.com/ho-nl/magento2-graphql-versions/compare/core-2.3.0..core-2.4.9).
  Any other pair works by editing a compare URL — every version is a tag.

## Adding a new version

Dispatch the `register-schema.yml` workflow with the new `magento_version` (plus matching
`php_version`, `mysql_version`, `search_engine`, `search_image` inputs). It installs Magento,
generates the schema, sorts it and commits + tags it. **Dispatch one version at a time, oldest
first, and wait for each run to finish** — commit order is the diff chain.

## Mage-OS

The `mage-os` branch tracks the [Mage-OS](https://mage-os.org/) distribution the same way, with
tags like `mage-os-3.2.0`. The branch forks from the `2.4.6` tag (Mage-OS 1.0.0's Magento base),
so the first Mage-OS commit diffs against its Magento parent. Only feature releases (`x.y.0`) are
tracked. To add a Mage-OS version, dispatch `register-schema.yml` **on the `mage-os` branch** with:

```
magento_version:  <mage-os version, e.g. 3.2.0>
composer_package: mage-os/product-community-edition
composer_repo:    https://repo.mage-os.org/
label:            mage-os-<version>
search_engine:    opensearch (all versions)
php_version:      8.2 for 1.0.0, 8.3 from 1.1.0
mysql_version:    8.0 for 1.x/2.x, 8.4 for 3.x
```

Comparing across distributions works through tags: `git diff 2.4.9 mage-os-3.2.0 -- schema.graphql`.

## Magento core-only

The `magento-core` branch rebuilds every Magento version with
`extra_require=yireo/magento2-replace-bundled:^4` (`^3` for 2.3.x), labels `core-<version>`, and
`disable_modules=Magento_PaymentServicesPaypalGraphQl` from 2.4.7 (Adobe Payment Services is
bundled but not covered by the yireo replace list).
Old versions additionally need: `composer_version=composer:v2` always (packagist dropped composer
v1 metadata in 2025), `search_engine=none` + `mysql_version=5.7` for 2.3.x, and
`extra_require="... react/promise:^2"` for 2.4.0 – 2.4.3 (their Elasticsearch client breaks with
react/promise v3).

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
- `allow-is-synchronous.php` — those republished modules also use the `is_synchronous`
  communication.xml attribute that early 2.3.x XSDs don't allow.

The workflow also disables composer's security-advisory blocking (composer ≥ 2.9 refuses to
install old Magento versions otherwise), ignores the composer-plugin-api platform requirement
(2.3.x/2.4.0/2.4.1 pin inert plugins to plugin-api v1), and normalizes legacy comma-separated
`implements` lists in the SDL (Magento ≤ 2.3.3) before sorting.

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
