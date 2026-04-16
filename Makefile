COMPOSE_FILE = docker-compose.yml
CONTAINER_NAME = wordpress-container
THEME_PATH = jullybride.ru/wp-content/themes/tailpress-theme

.PHONY: help install up down restart logs check-db

help: ## Показать список команд
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

install: ## Запуск WordPress (убедитесь, что сеть proxy создана)
	docker-compose -f $(COMPOSE_FILE) up -d
	@echo "WordPress запущен на сети 'proxy'"

up: ## Поднять контейнеры
	docker-compose -f $(COMPOSE_FILE) up -d

down: ## Остановить и удалить контейнеры
	docker-compose -f $(COMPOSE_FILE) down

restart: ## Перезапустить WordPress
	docker-compose -f $(COMPOSE_FILE) restart

logs: ## Посмотреть логи (полезно при ошибке Connection Refused)
	docker-compose -f $(COMPOSE_FILE) logs -f

check-db: ## Проверить доступность MariaDB из контейнера WordPress
	docker exec -it $(CONTAINER_NAME) ping -c 3 mariadb-container

npm-install: ## Установка зависимостей темы через Docker
	docker run --rm -v $(PWD):/app -w /app/$(THEME_PATH) node:20 npm install

composer-install: ## Установка PHP зависимостей темы через Composer
	docker run --rm -v $(PWD):/app -w /app/$(THEME_PATH) composer install

npm-dev: ## Запуск компиляции в реальном времени (Vite)
	docker run --rm -p 3000:3000 -v $(PWD):/app -w /app/$(THEME_PATH) node:20 npm run dev

npm-build: ## Сборка темы для продакшена
	docker run --rm -v $(PWD):/app -w /app/$(THEME_PATH) node:20 npm run build

push:
	git add .
	git commit -m "save"
	git push origin main