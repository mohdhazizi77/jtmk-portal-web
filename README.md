# JTMK Portal

A modern web application built for educational portal management, featuring robust role-based access control (RBAC), secure authentication pipelines, and a high-performance reactive frontend.

## 🚀 Tech Stack

- **Backend:** Laravel 12+ (PHP 8.2+)
- **Frontend:** Vue 3, TypeScript, Inertia.js, Tailwind CSS v4, shadcn-vue
- **Database & Cache:** MySQL 8.0, Redis
- **Containerization:** Laravel Sail (Docker)
- **Authorization:** Spatie Laravel-Permission

---

## 🛠️ Installation & Setup

Follow these steps to set up the project locally inside your WSL / Linux environment.

### 1. Clone & Environment Configuration

Ensure you have cloned the repository into your local environment. Duplicate the environment configuration file:

cp .env.example .env

Open .env and ensure the application and database ports are configured properly to prevent conflicts with your local host services:

APP_PORT=8080
FORWARD_DB_PORT=4306

### 2. Initialize Container Environment

Install Composer dependencies via a runtime container and spin up Laravel Sail:

docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd)":/var/www/html \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs

./vendor/bin/sail up -d

### 3. Generate Application Key & Database Seed

Execute your database migrations and seed system roles, permissions, and initial administrative accounts:

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed

### 4. Frontend Asset Compilation

Install Node packages and run the Vite development server:

./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

The application will now be accessible at: **http://localhost:8080**

---

## 📊 Database Schema (Custom Users)

The application uses a customized users table layout designed for structured identification and first-time login onboarding tracking:

Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('nric')->unique();
$table->string('name');
$table->string('phone_number')->nullable();
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->boolean('is_first_login')->default(1)->comment('0 = FALSE, 1 = TRUE');
$table->timestamp('is_first_login_at')->nullable()->comment('TIMESTAMP OF FIRST LOGIN');
$table->string('password');
$table->rememberToken();
$table->timestamps();
});

---

## 🔐 Authorization & Access Control

The application implements a strict **Resource-Action** naming convention for clear visual scoping and modularity when rendering checkboxes or matching permissions within UI layouts.

### Permissions Layout Matrix

- permission_management-view
- permission_management-create
- permission_management-edit
- permission_management-delete
- role_management-view
- role_management-create
- role_management-edit
- role_management-delete
- user_management-view
- user_management-create
- user_management-edit
- user_management-delete

### Seeded Accounts (Development)

| Role | Email | Password | Custom Attributes Set | Target Permissions |
| :--- | :--- | :--- | :--- | :--- |
| **Super Admin** | superadmin@jtmk.com | password | is_first_login: 0 | Complete administrative capability (Permission::all()) |
| **Admin** | admin@jtmk.com | password | is_first_login: 1 | Limited control (user_management operations only) |

---

## 📂 Core Structure Customization

Using the default first-party Laravel Vue starter kit skeleton, layout systems are fully modularized inside resources/js:

- **Application Layouts:** Located in resources/js/layouts/AppLayout.vue. Easily swap the sidebar component structure to an alternative top navbar navigation system by swapping layout wrappers.
- **Authentication Forms:** Located in resources/js/layouts/AuthLayout.vue. Supports immediate style pivoting across Simple, Card, and Split display wrappers.
