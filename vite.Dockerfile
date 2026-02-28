FROM node:18-alpine

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install npm dependencies
RUN npm install

# Copy the rest of the application
COPY . .

# Expose Vite port
EXPOSE 5174

# Start Vite development server
CMD ["npm", "run", "dev"]
