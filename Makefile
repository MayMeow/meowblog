ui:
	npx tailwindcss -i ./assets/theme.css -o ./webroot/css/theme.css --minify

server_start:
	php bin/cake.php server -H 0.0.0.0