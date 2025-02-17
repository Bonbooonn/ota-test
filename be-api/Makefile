ENV = $(shell cat .env | grep APP_ENV | sed -E 's/.*=(.*)/\1/')

help: ## Show all available commands
	@awk 'BEGIN {FS = ":.*##"} /^[a-zA-Z_-]+:.*##/ { printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

bash: ## Run bash in the container
	docker exec -it $(ENV)-be-api-api sh

migration: ## Create a new migration
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan make:migration $(file)"

run-migrations: ## Run the main migration
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan migrate"

run-fresh-migrations: ## Run the main migration
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan migrate:fresh"

routes-list: ## List all the routes
	docker exec -it $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan route:list"

create-user: ## Create a new user
	docker exec -it $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan app:create-default-user"

ide-helper-generate: ## Generate the ide-helper
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan ide-helper:generate"

ide-helper-models: ## Generate the ide-helper models
	docker exec -it $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan ide-helper:models"

composer-dump: ## Run composer dump-autoload
	docker exec -it $(ENV)-be-api-api sh -c "cd /home/dev/app && composer dump-autoload"

create-unit-test: ## Create a new unit test
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan make:test $(namespace) --unit"

create-feature-test: ## Create a new feature test
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan make:test $(namespace)"

run-tests: ## Run the tests
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan test --coverage --min=95 --no-ansi"

composer-install: ## Run composer install
	docker exec -it $(ENV)-be-api-api sh -c "cd /home/dev/app && composer install"

generate-key: ## Generate the app key
	docker exec -t $(ENV)-be-api-api sh -c "cd /home/dev/app && php artisan key:generate"
