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

## 📂 Core Structure Customization

Using the default first-party Laravel Vue starter kit skeleton, layout systems are fully modularized inside resources/js:

- **Application Layouts:** Located in resources/js/layouts/AppLayout.vue. Easily swap the sidebar component structure to an alternative top navbar navigation system by swapping layout wrappers.
- **Authentication Forms:** Located in resources/js/layouts/AuthLayout.vue. Supports immediate style pivoting across Simple, Card, and Split display wrappers.
