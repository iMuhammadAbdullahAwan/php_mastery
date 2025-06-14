CREATE DATABASE todo;
USE todo;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100)
);
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    completed TINYINT(1) NOT NULL DEFAULT 0,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);