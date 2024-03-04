CREATE TABLE plan_types (
   id INT(11) AUTO_INCREMENT PRIMARY KEY,
   type_name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE plans (
   id INT(11) AUTO_INCREMENT PRIMARY KEY,
   type_id INT(11) NOT NULL,
   name VARCHAR(255) NOT NULL,
   price VARCHAR(255) NOT NULL,
   description TEXT NOT NULL,
   is_active TINYINT(1) NOT NULL,
   FOREIGN KEY (type_id) REFERENCES plan_types(id)
);

INSERT INTO plan_types (type_name) VALUES ('Pro');
INSERT INTO plan_types (type_name) VALUES ('Free');
INSERT INTO plan_types (type_name) VALUES ('Business');

INSERT INTO plans (type_id, name, price, description, is_active) VALUES (1, 'Pro for persons', '99$', 'Professional plan for persons', 1);
