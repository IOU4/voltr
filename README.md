# Voltr:

## Usage:

first thing rename `.env.example` inside `api` directory to `.env` replacing `<<>>` inside the file with desired creadentials (do not update `DB_HOST` and `DB_NAME`)
```bash
$ cd api
$ mv .env.example .env
```

finally make sure you have docker and docker compose installed in you're machine and run:
```bash
$ docker compose up -d
```

the app should  be accessible at [localhost:80](http://localhost:8080).
