--create database

USE `loan_system`;
DROP TABLE IF EXISTS `members`;
--creating Table
CREATE TABLE `members` (
    id int auto_increment primary key,
    name varchar(300),
    NIN_NO varchar(300),
    City varchar(300),
    email varchar(300),
    phone varchar(300),
    guaranter varchar(300),
    guaranterphone varchar(300),
    date_collected date,
    date_end date,
    Amount_taken int,
    Amount_to_be_paid int,
    Paid_amount int,
    Balance int,
    profits varchar(250)
);


