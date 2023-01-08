# MeowBlog

## Instalation

Application inside container runs under `www-data:www-data` user.

```bash
sudo chown -R www-data:www-data data/
```

Create security key

```bash
docker compose -f docker-compose.prod.yml run --rm app sh -c "php bin/cake.php generate_security_key"
```

Create Database

```bash
docker compose -f docker-compose.prod.yml run --rm app sh -c "php bin/cake.php migrations migrate"
```

Start Application

```bash
docker compose -f docker-compose.dev.yml up -d
```

## More information

- [Roadmap](https://github.com/users/MayMeow/projects/4)

## Development

Requirements

- Docker or Docker Desktop
- Lando
- PHP 8.1 and up
- Node
- Yarn

### For backend

```bash
lando start
lando composer install
lando php bin/cake.php migrations migrate
```

## For frontend

```bash
fnm install # to install node - optionally
yarn install
yarn build
```

Source codes for frontend are stored in `webroot_src`, currently only styles which is slightly modified picocss.

‼️ After successfull build you need to change css path in `templates/layout/default.php`. (not ideal but for now it is like it is).
