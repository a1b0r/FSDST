# Full Stack Developer Skills Test

## Project Overview

This application is a simple login page with the following features:

- **Login Form**: Consists of user email field, password field, login button, and a "Remember Me" checkbox.
- **Modern UI**: Styled using Bootstrap to make it user-friendly.
- **AJAX Authentication**: Uses AJAX to call an external API endpoint for user authentication.
- **PHP API Endpoint**: A simple API endpoint in PHP that handles the login request, validates the user, and returns a welcome message.
- **Routes**: Only specific API routes are available (`/api/login`, `/api/logout`, `/api/rememberme`, `/api/register`).
- **Database**: A MySQL database table that persists user data.
- **Code Documentation**: All code is documented for clarity and maintainability.
- **Dockerized Setup**: The application is containerized using Docker for easy setup.

## Table of Contents

- [Project Overview](#project-overview)
- [Project Structure](#project-structure)
- [Setup Instructions](#setup-instructions)
- [Database Schema](#database-schema)
- [Usage](#usage)
- [Shutting Down](#shutting-down)
- [Notes](#notes)

## Setup Instructions

### Prerequisites

- **Docker**: Ensure Docker is installed on your machine.
- **Docker Compose**: Make sure Docker Compose is installed.

### Steps

1. **Clone the Repository**

   ```bash
   git clone 
   cd 
    ```

2. **Build and Run the Docker Containers**

    ```bash
    docker-compose up -d --build
    ```

3. Initialize the Database
    - The database is automatically initialized using the schema.sql file during the Docker setup.

4. Access the Application
    - Open your browser and navigate to http://localhost:8080/.

## Database Schema

The database schema is defined in the schema.sql file and includes a single table users with the following fields:

- id: Auto-incrementing primary key
- email: User email (unique)
- password: Hashed password
- username: User's name
