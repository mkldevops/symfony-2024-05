SHELL := /bin/bash
tests:
	APP_ENV=test symfony console doctrine:database:drop --force || true
	APP_ENV=test symfony console doctrine:database:create
	APP_ENV=test symfony console doctrine:schema:update --force
	APP_ENV=test symfony console doctrine:fixtures:load -n
	APP_ENV=dev symfony php bin/phpunit $(MAKECMDGOALS)

up:
	docker compose up -d
	symfony serve -d

push:
	git add .
	git commit -m "$(m)"
	git push

.PHONY: tests
