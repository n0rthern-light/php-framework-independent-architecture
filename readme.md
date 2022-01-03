### Completely framework independent architecture
An modulit application with help of Hexagonal Architecture & DDD & Symfony framework. The purpose of this architecture is a very high business scalability while remaining framework and dependency decoupled - which grants you an aging-proof codebase where the framework or the infrastructural solutions can be replaced without huge effort at any time you wish.

##### Concepts:
- `core` directory contains only business logic, domain services, application services, repository declarations (interfaces) - each dependency is defined as interface at this stage.
- `framework` directory contains `symfony/skeleton` application with the infrastructure implementations of the interfaces declared in `core` and the needed framework routing & security stuff.

```bash
.
├── core
│   ├── composer.json
│   ├── composer.lock
│   ├── phpunit.xml
│   ├── src
│   │   ├── Auction
│   │   │   ├── Application
│   │   │   └── Domain
│   │   │       ├── AggregateRoot
│   │   │       ├── Collection
│   │   │       ├── Entity
│   │   │       └── ValueObject
│   │   ├── Portal
│   │   │   ├── Application
│   │   │   └── Domain
│   │   │       ├── AggregateRoot
│   │   │       ├── Entity
│   │   │       └── ValueObject
│   │   └── Shared
│   │       ├── Application
│   │       └── Domain
│   │           ├── Collection
│   │           ├── Entity
│   │           ├── Enum
│   │           └── ValueObject
│   └── test
│       └── ImportTest.php
└── framework
    ├── bin
    │   └── console
    ├── composer.json
    ├── composer.lock
    ├── config
    │   ├── bundles.php
    │   ├── packages
    │   │   ├── cache.yaml
    │   │   ├── framework.yaml
    │   │   └── routing.yaml
    │   ├── preload.php
    │   ├── routes
    │   │   └── framework.yaml
    │   ├── routes.yaml
    │   └── services.yaml
    ├── public
    │   └── index.php
    ├── src
    │   ├── Auction
    │   │   ├── Infrastructure
    │   │   └── UserInterface
    │   │       └── Controller
    │   ├── Kernel.php
    │   └── Portal
    │       ├── Infrastructure
    │       └── UserInterface
    ├── symfony.lock
    └── var
        └── log
```
