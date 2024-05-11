# Laravel Banking System

This is a simple Laravel application for managing banking operations such as user registration, login, transactions, deposits, and withdrawals.

## Installation

### 1. Clone the repository
git clone https://github.com/maruf-67/mediusware

### 2.  Install Composer Dependencies
cd mediusware
composer install

### 3.  Install NPM Dependencies
npm install

### 4. Set Up Environment Variables
Create a copy of the .env.example file and rename it to .env. Update the database configuration according to your environment:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

### 5. Generate Application Key
php artisan key:generate

### 6. Run Migrations
php artisan migrate

### 7. Seed the Database
I have added User and demo transaction seeder which will help the process
php artisan db:seed

### 8. Start the Development Server
php artisan serve

The application will be available at http://localhost:8000.



