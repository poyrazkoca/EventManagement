CREATE DATABASE IF NOT EXISTS event_management CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE event_management;

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
    );

ALTER TABLE users ADD COLUMN IF NOT EXISTS profile_picture VARCHAR(255);

CREATE TABLE IF NOT EXISTS events (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      user_id INT NOT NULL,
                                      title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(100) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );

ALTER TABLE events ADD COLUMN IF NOT EXISTS poster VARCHAR(255);

CREATE TABLE IF NOT EXISTS event_registrations (
                                                   id INT AUTO_INCREMENT PRIMARY KEY,
                                                   event_id INT NOT NULL,
                                                   user_id INT NOT NULL,
                                                   registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                                   FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
    );
