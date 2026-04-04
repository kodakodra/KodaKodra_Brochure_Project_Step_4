-- migration.sql
--
-- Creates the users table for the KodaKodra portfolio site.
-- Run this once against your MySQL database to set up the schema.
-- Example: mysql -u root -p kodakodra < migration.sql

-- Create the database if it doesn't exist yet
CREATE DATABASE IF NOT EXISTS kodakodra CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE kodakodra;

-- ===========================
-- Users Table
-- ===========================
-- Stores registered user accounts.
-- Passwords are stored as bcrypt hashes — never plain text.
-- Role defaults to 'user' — can be promoted to 'admin' manually.

CREATE TABLE IF NOT EXISTS users (
    id         INT UNSIGNED    NOT NULL AUTO_INCREMENT,  -- Unique ID for each user
    name       VARCHAR(100)    NOT NULL,                 -- Display name
    email      VARCHAR(150)    NOT NULL UNIQUE,          -- Login email, must be unique
    password   VARCHAR(255)    NOT NULL,                 -- Bcrypt hashed password
    role       ENUM('user','admin') NOT NULL DEFAULT 'user', -- Access level
    created_at TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Registration date
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
