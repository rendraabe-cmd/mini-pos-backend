# Mini POS Backend API 🛒

REST API untuk aplikasi Mini Point of Sale (POS) yang dibangun menggunakan **Laravel 11** dengan **Sanctum Authentication** dan **MySQL**.

## 🚀 Tech Stack

- **Backend Framework:** Laravel 11
- **Database:** MySQL 8
- **Authentication:** Laravel Sanctum (Bearer Token)
- **PHP Version:** 8.4+
- **API Testing:** Bruno

## ✨ Features

- ✅ Authentication (Login, Logout, Get User)
- ✅ Role-based Users (Admin & Kasir)
- ✅ Category Management (CRUD)
- ✅ Product Management (CRUD with Filtering)
- ✅ Transaction System (Checkout with Auto Stock Update)
- ✅ Invoice Auto-Generation
- ✅ Dashboard Statistics (Revenue, Top Products, Recent Transactions)
- ✅ Database Transaction (Rollback Safety)

## 📋 API Endpoints

### Auth
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/auth/login` | Login user | ❌ |
| POST | `/api/auth/logout` | Logout user | ✅ |
| GET | `/api/auth/me` | Get current user | ✅ |

### Categories
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/categories` | List all categories | ✅ |
| POST | `/api/categories` | Create category | ✅ |
| GET | `/api/categories/{id}` | Get category detail | ✅ |
| PUT | `/api/categories/{id}` | Update category | ✅ |
| DELETE | `/api/categories/{id}` | Delete category | ✅ |

### Products
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/products` | List products (with filter) | ✅ |
| POST | `/api/products` | Create product | ✅ |
| GET | `/api/products/{id}` | Get product detail | ✅ |
| PUT | `/api/products/{id}` | Update product | ✅ |
| DELETE | `/api/products/{id}` | Delete product | ✅ |

### Transactions
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/transactions` | List all transactions | ✅ |
| POST | `/api/transactions` | Create new transaction | ✅ |
| GET | `/api/transactions/{id}` | Get transaction detail | ✅ |

### Dashboard
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/dashboard/stats` | Get dashboard statistics | ✅ |

## 🛠️ Installation

### Prerequisites
- PHP >= 8.4
- Composer
- MySQL 8
- Git

### Setup

```bash
# Clone repository
git clone https://github.com/rendraabe-cmd/mini-pos-backend.git
cd mini-pos-backend

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_pos
DB_USERNAME=root
DB_PASSWORD=your_password

# Create database
mysql -u root -p -e "CREATE DATABASE mini_pos;"

# Run migrations & seeders
php artisan migrate:fresh --seed

# Start server
php artisan serve
