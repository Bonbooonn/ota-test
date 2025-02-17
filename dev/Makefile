DOCKER_COMPOSE_ENV = $(shell cat .env | grep DOCKER_COMPOSE_ENV | sed -E 's/.*=(.*)/\1/')
VCS = $(shell cat .env | grep VCS | sed -E 's/.*=(.*)/\1/')
SELECTED_APPS = $(shell grep '^SELECTED_APPS=' .env | sed -E 's/SELECTED_APPS="([^"]*)"/\1/')
DEFAULT_NETWORK = $(shell grep '^DEFAULT_NETWORK=' .env | cut -d '=' -f2)
PROJECTS = $(shell grep '^PROJECTS=' .env | sed -E 's/PROJECTS="([^"]*)"/\1/')
.PHONY: start-selected stop-selected clone-projects create-networks

help: ## Show all available commands
	@awk 'BEGIN {FS = ":.*##"} /^[a-zA-Z_-]+:.*##/ { printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

remove-all: # REMOVE ALL INSTANCES IN DOCKER (Containers, networks, volumes, images, cache)
	docker system prune -a --volumes

show-containers: ## Show all containers
	@echo "Containers:"
	@docker ps -a

create-network: ## Create network
	@echo "Creating network with name: $(DEFAULT_NETWORK)"
	docker network create --driver=bridge $(DEFAULT_NETWORK)

start-selected: ## Start selected apps
	@echo "Starting selected apps: $(SELECTED_APPS)"
	@for app in $(SELECTED_APPS); do \
		APP_DOCKER_COMPOSE_FILE=docker-compose.$$app.yml; \
		echo "Processing $$app with file $$APP_DOCKER_COMPOSE_FILE..."; \
		if [ -f $$APP_DOCKER_COMPOSE_FILE ]; then \
			echo "Starting $$app using $$APP_DOCKER_COMPOSE_FILE..."; \
			docker-compose -p $(DOCKER_COMPOSE_ENV)-$$app -f $$APP_DOCKER_COMPOSE_FILE up -d --build; \
		else \
			echo "File $$APP_DOCKER_COMPOSE_FILE does not exist, skipping $$app."; \
		fi; \
	done

stop-selected: ## Stop selected apps
	@echo "Stopping selected apps: $(SELECTED_APPS)"
	for app in ${SELECTED_APPS}; do \
		APP_DOCKER_COMPOSE_FILE=docker-compose.$$app.yml; \
		if [ -f $$APP_DOCKER_COMPOSE_FILE ]; then \
			docker-compose -p $(DOCKER_COMPOSE_ENV)-$$app -f $$APP_DOCKER_COMPOSE_FILE down; \
		fi; \
	done
