
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

## 🛠️ Project Setup

### 1. Clone the repository

```bash
git clone https://github.com/your-username/user-management.git
cd user-management
```

### 2. Install dependencies

```bash
composer install
```

### 3. Copy and configure `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database details:

```dotenv
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Seed Dummy Data (Optional)

```bash
php artisan db:seed --class=UserSeeder
```

### 6. Run the server

```bash
php artisan serve
```

---

## 🧪 API Documentation

Base URL: `http://localhost:8000/api`

### 🔹 Create User

**POST** `/users`

#### Request Body:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123"
}
```

---

### 🔹 Get All Users

**GET** `/users`

---

### 🔹 Get Single User

**GET** `/users/{id}`

---

### 🔹 Update User

**PUT** `/users/{id}`

#### Request Body:
```json
{
  "name": "Updated Name",
  "email": "updated@example.com",
  "password": "newpass123"
}
```

---

### 🔹 Delete User

**DELETE** `/users/{id}`

---

## ✅ Architecture Overview

```
app/
├── DAO/
│   └── UserDao.php
├── BO/
│   └── UserBo.php
├── Services/
│   └── UserService.php
├── Http/
│   ├── Controllers/
│   │   └── Api/UserController.php
│   └── Requests/
│       └── StoreUserRequest.php
```

---

## 📬 Contact

For issues or contributions, please open an issue or PR on the repo.

---

## 📜 License

MIT License
