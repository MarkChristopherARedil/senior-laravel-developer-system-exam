# Mini Project Management (Laravel 10)

## Requirements
- PHP 8.1+
- Composer
- MySQL
- Node.js & npm

## Setup
1. git clone ...
2. cp .env.example .env && set DB credentials
3. composer install
4. npm install && npm run dev
5. php artisan key:generate
6. php artisan migrate --seed
7. php artisan serve

## Authentication
- Breeze provides register/login UI.
- Admin seeded: admin@example.com / password

## API
- API endpoints under `/api`
- Protected by Laravel Sanctum (use personal access tokens)

## Architecture overview
- Models: User, Project, Task
- Controllers: ProjectController, TaskController
- Form Requests: validation for Project/Task
- API Resources for consistent JSON responses
- Tests: Feature tests for create project, create task, and guest access

## Tests
Run: `php artisan test`
