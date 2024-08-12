# Service Selection App

A Laravel-based web application for managing services and users, including service selection functionality. This app allows users to view, create, update, and delete services and users, with the ability to select and match services.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- CRUD operations for services and users.
- Service selection and matching functionality.
- AJAX-based frontend for seamless interaction.
- Bootstrap 5 for responsive design.

## Requirements

- PHP 8.1 or higher
- Composer
- Laravel 10.x
- MySQL or any other supported database

## Installation

1. **Clone the Repository**

    ```bash
    git clone https://github.com/yourusername/service-selection-app.git
    cd service-selection-app
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Create and Configure the Environment File**

    ```bash
    cp .env.example .env
    ```

4. **Generate an Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations and Seeders**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

## Configuration

- Open the `.env` file and set the following variables according to your database configuration:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=service_selection_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

## Usage

1. **Start the Laravel Development Server**

    ```bash
    php artisan serve
    ```

2. **Access the Application**

    Open your web browser and navigate to `http://127.0.0.1:8000`.

## API Endpoints

- **Services:**
    - `GET /api/services` - Retrieve all services
    - `POST /api/services` - Create a new service
    - `PUT /api/services/{id}` - Update a service
    - `DELETE /api/services/{id}` - Delete a service

- **Users:**
    - `GET /api/users` - Retrieve all users
    - `POST /api/users` - Create a new user
    - `PUT /api/users/{id}` - Update a user
    - `DELETE /api/users/{id}` - Delete a user

- **Service Selection:**
    - `POST /api/select-service` - Add a service to a user's selected list
    - `POST /api/unselect-service` - Remove a service from a user's selected list
    - `GET /api/selected-services/{userId}` - Retrieve all selected services for a specific user
    - `GET /api/unselected-services/{userId}` - Retrieve all unselected services for a specific user

## Running the Application

To run the application, make sure you have the necessary dependencies installed and follow the usage instructions to start the development server. You can then access the application in your web browser.

## Testing

Run the application's tests using PHPUnit:

```bash
php artisan test
