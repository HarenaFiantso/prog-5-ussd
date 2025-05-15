# Brown money 💸

![php](https://img.shields.io/badge/PHP-v8.3-violet?logo=php)
[![ci](https://github.com/HarenaFiantso/prog-5-ussd/actions/workflows/validate.yml/badge.svg)](https://github.com/tsirysndr/replay/actions/workflows/ci.yml)

**Brown Money!** is a CLI simulation of USSD menu #144# Orange Money Madagascar.  
This project aims to implement **good software development practices**, including code organization, naming conventions,
linting, documentation and continuous integration.


> [!IMPORTANT]
> Brown money is still in development and not ready for production use.

## Learning objectives

- Structure a PHP project in accordance with **clean code** principles
- Implement consistent naming conventions
- Use a suitable linter and integrate it into a CI pipeline (GitHub Actions)
- Create an interactive command-line application (CLI) in PHP

## Technical stack

- PHP 8.3
- **CLI** (Command Line Interface)
- GitHub Actions (CI)
- **PHP_CodeSniffer** (lint PSR-12)

## Naming conventions

| Element        | Convention         | Example                        |
|----------------|--------------------|--------------------------------|
| **Classes**    | `PascalCase`       | `UssdSimulator`, `MenuLoader`  |
| **Methods**    | `camelCase()`      | `startSession()`, `loadMenu()` |
| **Variables**  | `camelCase`        | `$userInput`, `$menuPath`      |
| **Constants**  | `UPPER_SNAKE_CASE` | `ACTION_EXIT`, `MAX_DEPTH`     |
| **PHP files**  | `snake_case`       | `menu_loader.php`              |
| **Namespaces** | `PascalCase`       | `App\Core`, `App\Menu`         |

## Linting

The project uses **PHP_CodeSniffer** with the **PSR-12** standard to check code quality and consistency.

### Installing dependencies

```bash
composer install
```
