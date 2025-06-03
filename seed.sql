-- Create the Product Table
CREATE TABLE da7_product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL,
    commodity VARCHAR(255) NOT NULL,
    variety VARCHAR(255),
    year YEAR NOT NULL,
    batch VARCHAR(100),
    lot VARCHAR(100),
    date_received DATE NOT NULL,
    bags_received INT NOT NULL,
    germination_test_date DATE
);

-- Create the Province Table
CREATE TABLE da7_province (
    province_id INT AUTO_INCREMENT PRIMARY KEY,
    province_name VARCHAR(255) NOT NULL
);

-- Create the LGU Table
CREATE TABLE da7_lgu (
    lgu_id INT AUTO_INCREMENT PRIMARY KEY,
    lgu_name VARCHAR(255) NOT NULL,
    province_id INT NOT NULL,
    FOREIGN KEY (province_id) REFERENCES da7_province(province_id) ON DELETE CASCADE
);

-- Create the Association Table
CREATE TABLE da7_association (
    assoc_id INT AUTO_INCREMENT PRIMARY KEY,
    assoc_name VARCHAR(255) NOT NULL
);

-- Create the Distribution Table
CREATE TABLE da7_distribution (
    distribution_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    date_distributed DATE NOT NULL,
    bags_distributed INT NOT NULL,
    remaining_bags INT NOT NULL,
    province_id INT NOT NULL,
    lgu_id INT NOT NULL,
    assoc_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES da7_product(product_id) ON DELETE CASCADE,
    FOREIGN KEY (province_id) REFERENCES da7_province(province_id) ON DELETE CASCADE,
    FOREIGN KEY (lgu_id) REFERENCES da7_lgu(lgu_id) ON DELETE CASCADE,
    FOREIGN KEY (assoc_id) REFERENCES da7_association(assoc_id) ON DELETE CASCADE
);