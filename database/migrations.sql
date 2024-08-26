CREATE DATABASE IF NOT EXISTS human;
USE human;
-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT,
    name VARCHAR(200),
    email VARCHAR(200),
    password TEXT,
    phone VARCHAR(20),
    role ENUM('admin', 'user') DEFAULT 'user',
    gender ENUM('male', 'female'),
    state VARCHAR(30),
    address TEXT,
    created_at DATE DEFAULT CURRENT_TIMESTAMP,
    updated_at DATE,
    PRIMARY KEY(id)
);
-- Trigger to update updated_at timestamp on user update
CREATE TRIGGER update_user_timestamp BEFORE
UPDATE ON users FOR EACH ROW
SET NEW.updated_at = CURRENT_TIMESTAMP;
-- Inserting an admin user for initial setup
INSERT INTO users (name, password, phone, role, email)
VALUES (
        'administrator',
        'password',
        '08033333333',
        'admin',
        'admin@admin.com'
    );
-- Complaints table
CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title TEXT,
    body TEXT,
    response TEXT,
    created_at DATE DEFAULT CURRENT_TIMESTAMP,
    updated_at DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
-- right
CREATE TABLE IF NOT EXISTS rights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category ENUM (
        'Physical',
        'Emotional',
        'Sexual',
        'neglect',
        'Environmental',
        'Indigenous',
        'Women',
        'Children',
        'Education',
        'Health',
        'Speech',
        'Privacy',
        'Labor'
    ),
    title VARCHAR(250),
    body TEXT,
    created_at DATE DEFAULT CURRENT_TIMESTAMP
);


-- Trigger to update updated_at timestamp on complaint update
CREATE TRIGGER update_complaint_timestamp BEFORE
UPDATE ON complaints FOR EACH ROW
SET NEW.updated_at = CURRENT_TIMESTAMP;
-- Notifications table
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(250),
    body TEXT,
    created_at DATE DEFAULT CURRENT_TIMESTAMP
);