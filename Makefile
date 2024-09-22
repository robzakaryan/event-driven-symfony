start:
	docker compose up -d

down:
	docker compose down

composer-update:
	docker compose exec app composer update

run-tests:
	docker compose exec app composer run-phpunit

run-stan:
	docker compose exec app composer run-phpstan

run-lint:
	docker compose exec app composer run-phplint

run-cs:
	docker compose exec app composer run-phpcs

check-code-quality:
	docker compose exec app composer run-phpunit && composer run-phpstan && composer run-phpcs && composer run-phplint