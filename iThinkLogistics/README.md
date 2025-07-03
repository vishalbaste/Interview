📄 README.md
markdown
Copy
Edit
# Laravel 12 - User Management System

This project is a modular **User Management System** built using Laravel 12, with proper architecture using DAO, BO, and Service Layers. It features API endpoints for creating, updating, retrieving, and deleting users with validation and caching.

---

## 🚀 Features

- User CRUD via RESTful APIs
- Modular code with DAO / BO / Service layers
- Form Request Validation
- Laravel Caching for user retrieval
- Clean, commented, and testable code

---

## 🛠️ Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL / MariaDB
- Redis (for caching, optional)
- Postman / Thunder Client (for API testing)

---

## ⚙️ Project Setup

### 1. Clone the repository

```bash
git clone https://github.com/your-username/user-management.git
cd user-management
2. Install dependencies
bash
Copy
Edit
composer install
3. Copy and configure .env
bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Update the .env file with your database details:

dotenv
Copy
Edit
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
(Optional for Redis)

dotenv
Copy
Edit
CACHE_DRIVER=redis
4. Run Migrations
bash
Copy
Edit
php artisan migrate
5. Seed Dummy Data (Optional)
bash
Copy
Edit
php artisan db:seed --class=UserSeeder
6. Run the server
bash
Copy
Edit
php artisan serve
🧪 API Documentation
Base URL: http://localhost:8000/api

🔹 Create User
POST /users

Request Body:
json
Copy
Edit
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123"
}
Response:
json
Copy
Edit
{
  "message": "User created successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
🔹 Get All Users
GET /users

Response:
json
Copy
Edit
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
]
🔹 Get Single User
GET /users/{id}

🔹 Update User
PUT /users/{id}

Request Body:
json
Copy
Edit
{
  "name": "Updated Name",
  "email": "updated@example.com",
  "password": "newpass123"
}
🔹 Delete User
DELETE /users/{id}

✅ Architecture Overview
bash
Copy
Edit
app/
├── DAO/
│   └── UserDao.php         # Handles direct DB operations
├── BO/
│   └── UserBo.php          # Business logic
├── Services/
│   └── UserService.php     # Coordinates between Controller & BO
├── Http/
│   ├── Controllers/
│   │   └── Api/UserController.php
│   └── Requests/
│       └── StoreUserRequest.php
🧰 Notes
Caching is implemented using Laravel’s Cache facade.

Validation handled using Form Requests.

On update/delete, cache is invalidated.

Only apiResource() routes are used (no web UI).

📬 Contact
For issues or contributions, please open an issue or PR on the repo.
