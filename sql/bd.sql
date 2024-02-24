-- base de données ensaf_ventes

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(256) NOT NULL
    role VARCHAR(50) NOT NULL DEFAULT 'user';
);

CREATE TABLE vetements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    image_data LONGBLOB
);

-- ALTER TABLE vetements ADD COLUMN image_data LONGBLOB;