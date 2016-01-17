CREATE TABLE certificates
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    description VARCHAR(255) NOT NULL
);
CREATE TABLE feedback
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(255) NOT NULL,
    feedback LONGTEXT NOT NULL
);
CREATE TABLE pages
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title_ru VARCHAR(100) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    content_ru LONGTEXT NOT NULL,
    content_en LONGTEXT NOT NULL,
    slug VARCHAR(255) NOT NULL,
    is_offer CHAR(2) DEFAULT '0',
    icon VARCHAR(50)
);
CREATE TABLE rating_log
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    who_vote INT NOT NULL,
    who_received INT NOT NULL,
    num DOUBLE NOT NULL
);
CREATE TABLE report
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    initiator INT NOT NULL,
    receiver INT NOT NULL,
    text LONGTEXT NOT NULL,
    date DATETIME NOT NULL
);
CREATE TABLE settings
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    title VARCHAR(80) NOT NULL,
    value LONGTEXT NOT NULL
);
CREATE TABLE storage
(
    `key` VARCHAR(255),
    value LONGTEXT
);
CREATE TABLE user
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    identity VARCHAR(255),
    avatar VARCHAR(512) NOT NULL,
    vcf VARCHAR(255) NOT NULL,
    network VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    name VARCHAR(80),
    surname VARCHAR(80) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    facebook_url VARCHAR(255) NOT NULL,
    twitter_url VARCHAR(255) NOT NULL,
    xing_url VARCHAR(255) NOT NULL,
    balance REAL NOT NULL,
    rating REAL DEFAULT 0 NOT NULL,
    level TINYINT NOT NULL,
    password VARCHAR(64) NOT NULL,
    salt VARCHAR(64) NOT NULL,
    expert_confirm TINYINT NOT NULL,
    is_active TINYINT NOT NULL,
    is_staff TINYINT NOT NULL,
    is_seen TINYINT NOT NULL,
    last_login DATETIME NOT NULL,
    date_joined DATETIME NOT NULL
);
CREATE TABLE user_certificate
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    certificate_id INT NOT NULL,
    date DATE NOT NULL
);
ALTER TABLE rating_log ADD FOREIGN KEY (who_vote) REFERENCES user (id);
ALTER TABLE rating_log ADD FOREIGN KEY (who_received) REFERENCES user (id);
ALTER TABLE user_certificate ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE user_certificate ADD FOREIGN KEY (certificate_id) REFERENCES certificates (id) ON DELETE CASCADE ON UPDATE CASCADE;
