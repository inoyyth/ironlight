#!/bin/bash

# Start Laravel Sail with npm run dev
echo "Starting Laravel Sail with npm run dev..."

# Start Sail in background
./vendor/bin/sail up -d

# Wait for containers to be ready
echo "Waiting for containers to start..."
sleep 10

# Install npm dependencies if needed
./vendor/bin/sail exec laravel.ironlight sh -c "if [ ! -d node_modules ]; then npm install; fi"

# Start npm run dev in the container
echo "Starting npm run dev..."
./vendor/bin/sail exec -i laravel.ironlight npm run dev

echo "Development environment is ready!"
echo "App: http://localhost"
echo "Vite: http://localhost:5173"
