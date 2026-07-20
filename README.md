# Regsiter Magento GraphQL Schema

This project allows you to register the Magento GraphQL schema in [Hive](https://the-guild.dev/graphql/hive).


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
