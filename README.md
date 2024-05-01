

# Overview
This project is a shopping list application developed with pure PHP 8 and MySQL 8.
 
It utilizes a **custom microframework** built with Object-Oriented Programming **(OOP)** principles.

The framework incorporates a **routing system** and follows the Model-View-Controller **(MVC)** pattern.

Notably, it features a database driver abstraction to ensure flexibility; thus, facilitating the swapping of databases without major code alterations **(dependency inversion principle)**.

And also **RESTful API** Provides access to application functionalities via API endpoints.



# Technologies Used

- **PHP 8**: Core language used for server-side scripting.
- **MySQL 8**: Database management system utilized for data storage.
- **JavaScript (Vanilla)**: Employed for client-side (Ajax)interactions.

- **Bootstrap**: Utilized for frontend styling and layout.

- **PHPUnit**: Used for feature testing of the RESTful API.

- **Docker**: The application has been containerized for simplified deployment. (nginx , phpmyadmin , mysql , php)


## Demo

Insert gif or link to demo


## Usage/Examples

- Clone the repository to your local machine.

- Intall Docker

Run the Docker container using the provided Dockerfile.
```javascript
docker compose up -d
```

now you can access the website with address http://localhost/list

you can customize and config .env file based on your enviroment


- Run tests
```javascript
    ./vendor/bin/phpunit
```
