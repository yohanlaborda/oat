# OAT

## Install

Composer is required to install.

```bash
composer install
```

For the use of the database we have SQLite. We must run the migration.

```bash
php bin/console doctrine:migrations:migrate
```

## Import CSV

To import the csv we use a symfony command.

```bash
php bin/console app:import:csv
```

## Pre commit

To verify the code and run the tests, use the following command:

```bash
composer pre-commit
```
