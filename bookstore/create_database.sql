-- create_database.sql
-- Run this in MySQL (e.g., via mysql CLI or phpMyAdmin)

CREATE DATABASE IF NOT EXISTS bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE bookstore;

-- Create a DB user (run as root) or set credentials you will use in dbconfig.php
-- CREATE USER 'bookuser'@'localhost' IDENTIFIED BY 'bookpass';
-- GRANT ALL ON bookstore.* TO 'bookuser'@'localhost';
-- FLUSH PRIVILEGES;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  phone VARCHAR(15) NOT NULL,
  sex VARCHAR(10),
  dob DATE,
  languages VARCHAR(200),
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample insert (passwords must be hashed if used for login)
INSERT INTO users (name, password_hash, email, phone, sex, dob, languages, address)
VALUES ('Test User', '$2y$10$examplehashplaceholder.....', 'test@example.com', '9876543210', 'Male', '2000-01-01', 'English', 'Sample address');
