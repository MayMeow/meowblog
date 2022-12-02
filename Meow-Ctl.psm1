function meow([string] $command)
{
    if ($command -eq "up") {
        meowUp
    }

    if ($command -eq "down") {
        meowDown
    }

    if ($command -eq "migrate") {
        meowMigrate
    }
}

function meowUp()
{
    docker compose -f .\compose-dev.yml up -d
}

function meowMigrate()
{
    docker compose -f compose-dev.yml run --rm composer bash -c "php bin/cake.php migrations migrate"
}

function meowDown()
{
    docker compose -f .\compose-dev.yml down -v
}