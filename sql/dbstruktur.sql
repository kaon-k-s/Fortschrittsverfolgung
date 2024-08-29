create database fortschrittsverfolgung;

use fortschrittsverfolgung;

create table projekt(
	id int not null auto_increment primary key,
	titel varchar(50) not null,
	erledigungsgrad int not null,
	arbeitszeit float,
	maxarbeitszeit float,
	deadlein date;
);
