cd /home/forge/your-app-name
git pull origin $FORGE_SITE_BRANCH

$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

if [ -f bin/cake.php ]; then
    $FORGE_PHP bin/cake.php migrations migrate --no-lock
    $FORGE_PHP bin/cake.php cache clear_all
fi
