CREATE TABLE customer (
    customer_id INTEGER PRIMARY KEY NOT NULL,
    firstname VARCHAR(15) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    address VARCHAR(20) NOT NULL,
    postcode CHAR(6) NOT NULL,
    city VARCHAR(20) NOT NULL,
    tel VARCHAR(15) NOT NULL
)

CREATE TABLE orders (
    order_no INTEGER PRIMARY KEY NOT NULL,
    customer_id INTEGER NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customer
)

CREATE TABLE order_row (
    row_no INTEGER PRIMARY KEY NOT NULL,
    order_no INTEGER NOT NULL,
    product_no INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    FOREIGN KEY (order_no) REFERENCES orders
)

CREATE TABLE product (
    product_no INTEGER PRIMARY KEY NOT NULL,
    product_name VARCHAR(20) NOT NULL,
    price NUMERIC(8,2),
    FOREIGN KEY (product_no) REFERENCES order_row
)

CREATE TABLE user (
    username VARCHAR(255) PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL
)

INSERT INTO product(product_name, price) VALUES 
("Norsu", 6.90),
("Sika", 4.90),
("Kirahvi", 9.90)

INSERT INTO customer(firstname,lastname,address,postcode,city,tel) VALUES 
("Keijo", "Kirahvi", "Keijotie 4", "40420", "Jyväskylä", "0503247564")

INSERT INTO user(username, passwd) VALUES ("Tiia", "salasana")