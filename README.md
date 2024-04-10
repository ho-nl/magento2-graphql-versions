# Regsiter Magento GraphQL Schema

This project allows you to register the Magento GraphQL schema in [Hive](https://the-guild.dev/graphql/hive).


## Run using act

You can run the github actions workflow locally by using [act](https://github.com/nektos/act).
```
act --secret-file .secrets --input magento_version=2.4.6 --input php_version=8.1
```

You will need to create the secrets file. See the Hive entry in the team vault in 1password for its contents.
