CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert a test user with email 'testuser@example.com' and password 'password'
INSERT INTO users (email, password) VALUES 
('testuser@example.com', '$2y$10$WwX3P180vYdBLreGkh5dM.Jp.brMK00epneAERDopYeGAY0kM4FEK'); -- Password is 'password'
