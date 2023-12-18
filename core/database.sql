-- create the database
CREATE DATABASE IF NOT EXISTS uiiDb;
USE uiiDb;
DROP TABLE IF EXISTS intoreIdentities;
DROP TABLE IF EXISTS activities;
-- create intoreIdentities information table
CREATE TABLE IF NOT EXISTS intoreIdentities(
  id int primary key not null auto_increment,
  fullName VARCHAR(50) not null,
  nationalId VARCHAR(20) not null,
  gender VARCHAR(15) not null,
  mother VARCHAR(50) not null,
  father VARCHAR(50) not null,
  martialStatus VARCHAR(15) not null,
  height VARCHAR(10) not null,
  mass VARCHAR(10) not null,
  bmi VARCHAR(10) default null,
  pressure VARCHAR(20) default null,
  vaccination VARCHAR(100) default null,
  district VARCHAR(20) not null,
  sector VARCHAR(20) not null,
  cell VARCHAR(20) not null,
  village VARCHAR(20) not null,
  firstTel VARCHAR(20) default null,
  secondTel VARCHAR(20) default null,
  email VARCHAR(200) default null,
  school VARCHAR(50) default null,
  combination VARCHAR(50) default null,
  additionalInfo VARCHAR(500) default null
);
CREATE TABLE IF NOT EXISTS activities (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  participant TEXT DEFAULT NULL,
  otherAttendees TEXT default null,
  location VARCHAR(255) DEFAULT NULL,
  descriptions TEXT DEFAULT NULL,
  pictures VARCHAR(1000) DEFAULT NULL,
  attendanceOption VARCHAR(50) DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS honors(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  ownerTeam TEXT DEFAULT NULL,
  grantToAll VARCHAR(1000) DEFAULT "true",
  dueDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  descriptions TEXT DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS misconduct(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  ownerTeam TEXT DEFAULT NULL,
  grantToAll VARCHAR(1000) DEFAULT "true",
  dueDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  descriptions TEXT DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS responsibilities(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  ownerFullName TEXT DEFAULT NULL,
  startDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  endDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  description TEXT DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS permissions(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  ownerFullName TEXT DEFAULT NULL,
  startDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  endDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  description TEXT DEFAULT NULL
);