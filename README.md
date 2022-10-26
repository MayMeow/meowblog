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