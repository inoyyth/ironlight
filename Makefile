.PHONY: up down dev build install npm-only

# Start all services including npm dev
up:
	./vendor/bin/sail up -d

# Start only web services (no npm dev)
web:
	./vendor/bin/sail up laravel.ironlight mysql redis -d

# Start npm dev service only
npm-only:
	./vendor/bin/sail up npm-dev -d

# Start everything with npm dev
dev:
	./vendor/bin/sail up -d

# Stop all services
down:
	./vendor/bin/sail down

# Rebuild containers
build:
	./vendor/bin/sail build --no-cache

# Install dependencies
install:
	./vendor/bin/sail up -d
	./vendor/bin/sail composer install
	./vendor/bin/sail npm install

# View logs
logs:
	./vendor/bin/sail logs -f

# View npm dev logs
logs-npm:
	./vendor/bin/sail logs npm-dev -f

# Access main container shell
shell:
	./vendor/bin/sail shell

# Access npm container shell
shell-npm:
	./vendor/bin/sail exec npm-dev bash

# Install npm dependencies manually
npm-install:
	./vendor/bin/sail exec npm-dev npm install

# Start npm dev manually
npm-dev:
	./vendor/bin/sail exec npm-dev npm run dev

# Build npm dev container
build-npm:
	./vendor/bin/sail build npm-dev

# Rebuild npm dev container
rebuild-npm:
	./vendor/bin/sail build npm-dev --no-cache
