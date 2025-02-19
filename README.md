# EventFlow - User Event Management Platform

## Overview
EventHub is a Laravel-based platform that allows users to organize, manage, and participate in events. The application provides a seamless experience for creating events, joining existing ones, and managing attendance - all with real-time notifications and email communications.

## Features

### Core Functionality
- User registration and authentication (JWT-based)
- Event creation and management
- Event browsing and filtering
- Event participation with attendance tracking
- Admin verification for event publishing

## Technical Stack

### Backend
- PHP 8.1+
- Laravel 10.x
- JWT Authentication (tymon/jwt-auth)
- Database: MySQL/PostgreSQL

## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/Mohamed072005/EventFlow-BackEnd.git
   cd EventFlow-BackEnd
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Set up environment file
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env` file
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eventhub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Configure JWT
   ```bash
   php artisan jwt:secret
   ```

6. Run migrations and seeders
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. Start the development server
   ```bash
   php artisan serve
   ```

## API Routes

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - User login

### Events (Protected Routes)
- `POST /api/create/event` - Create a new event
- `GET /api/get/events` - Get all verified events
- `PUT /api/verify/event/{id}` - Verify an event (admin only)

## Planned Enhancements

- Event categories and tags
- Advanced search functionality
- Event recommendations based on user preferences
- In-app messaging between event participants
- Calendar integration
- Mobile app version

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

