

# Overview
This project is a shopping list application developed with pure PHP 8 and MySQL 8.
 
It utilizes a **custom microframework** built with Object-Oriented Programming **(OOP)** principles.

The framework incorporates a **routing system** and follows the Model-View-Controller **(MVC)** pattern.

Notably, it features a database driver abstraction to ensure flexibility; thus, facilitating the swapping of databases without major code alterations **(dependency inversion principle)**.

And also **RESTful API** Provides access to application functionalities via API endpoints.


<img width="1439" alt="Screenshot 1403-02-13 at 17 14 35" src="https://github.com/sinazahed/zahed_dev_S_26_G/assets/29659040/cb3813ae-a261-4334-8db0-b9710d44dbca">




# Technologies Used

- **PHP 8**: Core language used for server-side scripting.
- **MySQL 8**: Database management system utilized for data storage.
- **JavaScript (Vanilla)**: Employed for client-side (Ajax)interactions.

- **Bootstrap**: Utilized for frontend styling and layout.

- **PHPUnit**: Used for feature testing of the RESTful API.

- **Docker**: The application has been containerized for simplified deployment. (nginx , phpmyadmin , mysql , php)


# Demo

you can visist the online sample of this app in this url

https://shopping.sinazahed.bio/list


## Usage/Examples

- Clone the repository to your local machine.

- Intall Docker

Run the Docker container using the provided Dockerfile.
```javascript
docker compose up -d
composer install
```

### Database

you can download and **import** the database from this url https://shopping.sinazahed.bio/list.sql
**or** run the create table command directly in mysql

```javascript

CREATE TABLE `list` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(70) NOT NULL,
  `checked` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

```



now you can access the website with address http://localhost/list

you can customize and config .env file based on your enviroment


## Run tests
```javascript
    ./vendor/bin/phpunit
```
