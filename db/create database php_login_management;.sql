-- create database php_login_management;
-- create database php_login_management_test;
-- CREATE TABLE users(
--     id VARCHAR(255) PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     password VARCHAR(255) NOT NULL
-- ) ENGINE InnoDB;
-- use php_login_management;
-- use php_login_management_test;
-- CREATE TABLE sessions(
--     id VARCHAR(255) PRIMARY KEY,
--     user_id VARCHAR(255) NOT NULL
-- )ENGINE InnoDB;
-- SHOW CREATE TABLE users;
ALTER TABLE sessions
ADD CONSTRAINT fk_sessions_user FOREIGN KEY (user_id) REFERENCES users(id);