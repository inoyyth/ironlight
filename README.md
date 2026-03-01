# IronLight

A modern Laravel application showcasing senior technical delivery with clean architecture and modern web technologies.

- homepage: `localhost:{port}`
- admin: `localhost:{port}/admin/login`

Demo site:

- homepage: `https://testironlight.fastevalbpe.com`
- admin: `https://testironlight.fastevalbpe.com/admin/login`
- credentials: `admin@ironlight.com` / `password123`

## Tech Stack

- **Backend**: Laravel 12.0 with PHP 8.2+
- **Frontend**: Vite with Tailwind CSS v4.2.1
- **Database**: MySQL 8.4
- **Cache**: Redis (Alpine)
- **Development Environment**: Laravel Sail (Docker)

## Architecture Decisions

### Laravel Sail Integration

- **Why**: Provides consistent development environment across all machines
- **Benefits**: Eliminates "works on my machine" issues, simplifies onboarding
- **Services**: PHP 8.5, MySQL 8.4, Redis, Vite dev server

### Tailwind CSS v4 with Vite

- **Why**: Latest version with improved performance and new features
- **Integration**: Uses `@tailwindcss/vite` plugin for seamless development
- **Configuration**: Custom config with Inter font and responsive breakpoints
- **Import Strategy**: Updated to v4 syntax (`@import "tailwindcss/preflight"`)

### Database & Caching Strategy

- **MySQL**: Primary database for persistent data storage
- **Redis**: Session management and application caching
- **Migrations**: Database schema version control
- **Seeders**: Initial data population

## Quick Start

### Prerequisites

- Docker Desktop installed and running
- Git

### Setup Instructions

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd ironlight
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    with docker:

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

4. **Configure database** (edit `.env`):

    ```env
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=ironlight
    DB_USERNAME=sail
    DB_PASSWORD=password

    CACHE_STORE=redis
    REDIS_HOST=redis
    REDIS_PORT=6379
    ```

5. **Start development environment**

    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Run database migrations**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7. **Run database seeders**

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

8. **Build frontend assets**
    ```bash
    ./vendor/bin/sail npm run build
    ```

## Development Commands

### Using Sail

```bash
# Start all services
./vendor/bin/sail up -d

# Stop all services
./vendor/bin/sail down

# Run artisan commands
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan tinker

# Run npm commands
./vendor/bin/sail npm run dev
./vendor/bin/sail npm run build
```

### Composer Scripts

```bash
# Full setup (install, migrate, build)
composer run setup

# Development mode (all services running)
composer run dev

# Run tests
composer run test
```

## Project Structure

```
├── app/                 # Application logic
├── resources/
│   ├── views/          # Blade templates
│   ├── css/            # Tailwind CSS
│   └── js/             # JavaScript
├── database/           # Migrations and seeders
├── routes/             # Web and API routes
├── compose.yaml        # Docker services configuration
├── vite.config.js      # Vite configuration
└── tailwind.config.js  # Tailwind configuration
```

## Frontend Development

### Templating Approach

- **Blade Templates**: Laravel's native templating engine for server-side rendering
- **Component-Based Architecture**: Reusable Blade components (`x-card`, `x-button`, `alert`, etc) for consistent UI
- **Tailwind CSS Integration**: Utility-first CSS approach for rapid styling
- **Responsive Design**: Mobile-first approach with Tailwind's responsive utilities

### Tailwind CSS v4 Features

- Updated import syntax for better performance
- Improved CSS generation
- Enhanced developer experience

### Vite Integration

- Hot module replacement during development
- Optimized production builds
- Asset versioning and caching

## Database Management

### MySQL Configuration

- Container: `mysql.ironlight`
- Port: `3306` (forwarded)
- Volume: Persistent data storage

### Redis Configuration

- Container: `redis.ironlight`
- Port: `6379` (forwarded)
- Usage: Sessions, cache, queues

## Deployment Considerations

### Environment Variables

- Ensure all `.env` variables are properly configured
- Database credentials should be secured in production
- Redis connection settings for caching

### Asset Building

- Run `npm run build` before deployment
- Ensure Vite assets are properly versioned
- Check Tailwind CSS compilation

## Contributing

1. Follow Laravel coding standards
2. Use Sail for consistent development environment
3. Test database migrations before committing
4. Ensure frontend assets build correctly

## License

This project is open-sourced software licensed under the MIT license.
