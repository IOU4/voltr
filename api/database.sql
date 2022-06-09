CREATE DATABASE IF NOT EXISTS voltr;
use voltr;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  phone varchar(20) UNIQUE,
  password VARCHAR(255) NOT NULL,
  photo TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS categories (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category varchar(255)
);

CREATE TABLE IF NOT EXISTS cities (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  city VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS items (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(60),
  description TEXT(250),
  author_id INT, 
  cover VARCHAR(255),
  category_id INT,
  city_id INT NOT NULL,
  address TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  FOREIGN KEY(author_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(city_id) REFERENCES cities(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS items_images (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  image TEXT,
  item_id INT NOT NULL,
  FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS saved_items (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  item_id INT NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO users ( id, username, email, phone, password) VALUES 
  ( 1, 'emaduo', 'adim@emad.me', '+212600112233', '$2y$10$hXXGkzXo6NHsuXDuYQQm2uh/DQvQwbn5y99h6lP6VYW9/C5/Z3kY2'), -- password 'secret'
  ( 2, 'jawad', 'adim@jawad.me', '+212644556677', '$2y$10$GgRWD5Gf/As07rDoVGvZZ.CY2/Ki5JvsvwF3IICI2nsL.rDdbu3Mi'); -- password 'secret2' bcrypt default cost

INSERT INTO categories (category) VALUES 
  ('books'), 
  ('electronics');

INSERT INTO cities (city) VALUES 
  ('casablanca'),
  ('rabat'),
  ('safi'),
  ('beni-mellal'),
  ('marakkech'),
  ('agadir'),
  ('el-jadida'),
  ('tanger'),
  ('khmissat'),
  ('oujda'),
  ('berkane'),
  ('tata'),
  ('errachidia');

INSERT INTO items (title, description, category_id, city_id, address, author_id) VALUES 
  ('books', 'I have some used books in littirature, they are in a good status', 1,1,'ain sbe3', 1),
  ('shuter island', 'leonardo decaprio makes prefect again, this thing gonna hurt your brain for a while', 1, 2, 'soussi', 2);
