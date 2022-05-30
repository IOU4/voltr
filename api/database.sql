CREATE DATABASE IF NOT EXISTS voltr;
use voltr;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  phone varchar(20) UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS categories (
  id INT NOT NULL PRIMARY KEY,
  name varchar(255)
);

CREATE TABLE IF NOT EXISTS items (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(60),
  description TEXT(250),
  author_id INT, 
  cover VARCHAR(255),
  category_id INT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  FOREIGN KEY(author_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO users (
  id,
  username,
  email,
  phone,
  password
) VALUES ( 
  1,
  'emaduo',
  'adim@emad.me',
  '+212600112233',
  '$2y$10$hXXGkzXo6NHsuXDuYQQm2uh/DQvQwbn5y99h6lP6VYW9/C5/Z3kY2'
);
-- password 'secret'

INSERT INTO users (
  id,
  username,
  email,
  phone,
  password
) VALUES ( 
  2,
  'jawad',
  'adim@jawad.me',
  '+212644556677',
  '$2y$10$GgRWD5Gf/As07rDoVGvZZ.CY2/Ki5JvsvwF3IICI2nsL.rDdbu3Mi'
);
-- password 'secret2' bcrypt default cost

INSERT INTO categories VALUES ( 1, 'books');

INSERT INTO items (
  id,
  title, 
  description, 
  category_id,
  author_id
  ) VALUES ( 
  1,
  'books',
  'I have some used books in littirature, they are in a good status', 
  1,
  1
);

INSERT INTO items (
  id,
  title, 
  description, 
  category_id,
  author_id
  ) VALUES ( 
  2,
  'shuter island',
  'leonardo decaprio makes prefect again, this thing gonna hurt your brain for a while', 
  1,
  2
);
