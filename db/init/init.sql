CREATE DATABASE IF NOT EXISTS voltr;
use voltr;

CREATE TABLE  users (
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

CREATE TABLE categories (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category varchar(255)
);

CREATE TABLE cities (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  city VARCHAR(255)
);

CREATE TABLE items (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(60),
  description TEXT(250),
  author_id INT, 
  cover VARCHAR(255),
  category_id INT,
  city_id INT NOT NULL,
  address TEXT,
  status VARCHAR(255) DEFAULT 'pending_approve',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  FOREIGN KEY(author_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(city_id) REFERENCES cities(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE items_images (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  image TEXT,
  item_id INT NOT NULL,
  FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE saved_items (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  item_id INT NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE reserved_items (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  item_id INT NOT NULL,
  user_id INT NOT NULL,
  take_at DATETIME,
  description TEXT,
  status VARCHAR(100) default 'pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE DEFINER=CURRENT_USER TRIGGER `reserve_item`
  AFTER INSERT ON reserved_items FOR EACH ROW 
  UPDATE items SET items.status = 'pending_reserve' WHERE items.id = new.item_id; 

CREATE DEFINER=CURRENT_USER TRIGGER `unreserve_item` 
  AFTER DELETE ON `reserved_items` FOR EACH ROW 
  UPDATE items SET items.status = 'active' WHERE items.id = old.item_id;

DELIMITER //
CREATE DEFINER=CURRENT_USER TRIGGER `aprove_or_reject_reserve` 
  AFTER UPDATE ON `reserved_items` FOR EACH ROW 
  BEGIN
    IF new.status = 'rejected' THEN
      UPDATE items
      SET status = 'active'
      WHERE id = new.item_id;
    ELSEIF NEW.status = 'accepted' THEN
      UPDATE items
      SET status = 'reserved'
      WHERE id = new.item_id;
    END IF;
  END//
DELIMITER ;

INSERT INTO users ( id, username, email, phone, password) VALUES 
  ( 1, 'emaduo', 'admin@emad.me', '+212600112233', '$2y$10$hXXGkzXo6NHsuXDuYQQm2uh/DQvQwbn5y99h6lP6VYW9/C5/Z3kY2'), -- password 'secret'
  ( 2, 'jawad', 'admin@jawad.me', '+212644556677', '$2y$10$GgRWD5Gf/As07rDoVGvZZ.CY2/Ki5JvsvwF3IICI2nsL.rDdbu3Mi'); -- password 'secret2' bcrypt default cost

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
