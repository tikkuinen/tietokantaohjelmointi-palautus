CREATE TABLE customer (
    customer_id INT,
    firstname VARCHAR(15) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    address VARCHAR(20) NOT NULL,
    postcode CHAR(6) NOT NULL,
    city VARCHAR(20) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    PRIMARY KEY (customer_id)
)

CREATE TABLE orders (
    order_no INT,
    customer_id INT NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (order_no),
    FOREIGN KEY (customer_id) REFERENCES customer
)

CREATE TABLE order_row (
    order_no INT NOT NULL,
    row_no INT NOT NULL,
    product_no INT NOT NULL,
    amount INT NOT NULL,
    PRIMARY KEY (row_no),
    FOREIGN KEY (order_no) REFERENCES orders
)

CREATE TABLE product (
    product_no INT,
    product_name VARCHAR(20) NOT NULL,
    price NUMERIC(8,2),
    PRIMARY KEY (product_no),
    FOREIGN KEY (product_no) REFERENCES order_row
)

CREATE TABLE user (
    username VARCHAR(255),
    passwd VARCHAR(255) NOT NULL,
    PRIMARY KEY (username)
)


INSERT INTO product VALUES 
(1, "Norsu", 6.90),
(2, "Sika", 4.90),
(3, "Kirahvi", 9.90)