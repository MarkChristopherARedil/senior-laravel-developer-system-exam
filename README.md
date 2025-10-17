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
- Admin seeded: email: "admin@example.com" | Password: "password"

## API
- API endpoints under `/api/v1`
- Protected by Laravel Sanctum (use personal access tokens)

1. Login

POST /api/v1/login

Headers:
- Content-Type: application/json
- Accept: application/json

Body Example:

```sh
{
    "email": "admin@example.com",
    "password": "password"
}
```

Response Example:
```sh
{
    "message": "Login successfully!",
    "auth_token": "2|IENqPcZh3T8dp7X2FCdDku4stpFk3YjPjY8wBiu64ec105cb",
    "token_type": "Bearer"
}
```


2. Logout

GET /api/v1/logout

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Accept: application/json

Response Example:
```sh
{
  "message": "Logged out successfully."
}
```


3. Get All Projects

GET /api/v1/projects

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Accept: application/json


4. Get Project by ID

GET /api/v1/projects/{id}

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Accept: application/json


5. Create Project

POST /api/v1/projects/store

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Content-Type: application/json


6. Update Project

PUT /api/v1/projects/{id}

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Content-Type: application/json
- Accept: application/json

Body Example:
```sh
{
  "title": "Updated Project Title",
  "description": "Revised scope and deadline",
  "deadline": "2025-12-31"
}
```

Response Example:
```sh
{
  "message": "Project updated successfully!"
}
```


7. Delete Project

DELETE /api/v1/projects/{id}

Headers:
- Authorization: Bearer YOUR_TOKEN_HERE
- Accept: application/json

Response Example:
```sh
{
  "message": "Project deleted successfully!"
}
```

Accept: application/json
## Architecture overview
- Models: User, Project, Task
- Controllers: ProjectController, TaskController
- Form Requests: validation for Project/Task
- API Resources for consistent JSON responses
- Tests: Feature tests for create project, create task, and guest access

## Tests
Run: `php artisan test`
