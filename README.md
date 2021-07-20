# Sales Dashboard

This is a simple skill demonstration project, with the goal of creating a simple sales dashboard using PHP, Mysql and some javascript.

## Setup

### Dependencies

To run the docker container, `docker` and `docker-compose` are required.

In order to install the application, `php` 8.0 and `composer` 2 are required.

### Installation

1. Copy the `.env.example` file, and optionally change the env variable values.

```bash
$ cp .env.example .env
```

2. Install php dependencies:

```bash
$ composer install
```

3. Start the docker container:

```bash
$ docker-compose up -d
```

The application should be accessible at [localhost](http://localhost)

### Database

The database is created and stored inside a docker volume. If you wish to reset it, drop the volume and restart the container:

```bash
$ docker-compose down -v && docker-compose up -d
```
