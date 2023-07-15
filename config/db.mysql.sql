CREATE DATABASE user_level_db;
USE user_level_db;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'inactive',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users
ADD COLUMN gender ENUM('male', 'female') NOT NULL DEFAULT 'male';

INSERT INTO users (username, email, status, password, created_at, gender)
VALUES
    ('user1', 'user1@example.com', 'active', MD5('password1'), NOW(), 'female'),
    ('user2', 'user2@example.com', 'active', MD5('password2'), NOW(), 'female'),
    ('user3', 'user3@example.com', 'active', MD5('password3'), NOW(), 'female'),
    ('user4', 'user4@example.com', 'active', MD5('password4'), NOW(), 'female'),
    ('user5', 'user5@example.com', 'active', MD5('password5'), NOW(), 'female'),
    ('user6', 'user6@example.com', 'active', MD5('password6'), NOW(), 'female'),
    ('user7', 'user7@example.com', 'active', MD5('password7'), NOW(), 'female'),
    ('user8', 'user8@example.com', 'active', MD5('password8'), NOW(), 'female'),
    ('user9', 'user9@example.com', 'active', MD5('password9'), NOW(), 'female'),
    ('user10', 'user10@example.com', 'active', MD5('password10'), NOW(), 'female'),
    ('user11', 'user11@example.com', 'active', MD5('password11'), NOW(), 'female'),
    ('user12', 'user12@example.com', 'active', MD5('password12'), NOW(), 'female'),
    ('user13', 'user13@example.com', 'active', MD5('password13'), NOW(), 'female'),
    ('user14', 'user14@example.com', 'active', MD5('password14'), NOW(), 'male'),
    ('user15', 'user15@example.com', 'active', MD5('password15'), NOW(), 'male'),
    ('user16', 'user16@example.com', 'active', MD5('password16'), NOW(), 'male'),
    ('user17', 'user17@example.com', 'active', MD5('password17'), NOW(), 'male'),
    ('user18', 'user18@example.com', 'active', MD5('password18'), NOW(), 'male'),
    ('user19', 'user19@example.com', 'active', MD5('password19'), NOW(), 'male'),
    ('user20', 'user20@example.com', 'active', MD5('password20'), NOW(), 'male');

    ALTER TABLE users ADD COLUMN user_level VARCHAR(50) NOT NULL DEFAULT 'normal';

