CREATE TABLE prueba.user_real_states (
	id BIGINT UNSIGNED auto_increment NOT null primary KEY,
	address varchar(100) NOT NULL,
	city varchar(100) NOT NULL,
	phone varchar(100) NOT NULL,
	`postal_code` BIGINT UNSIGNED  NOT NULL,
	`type` ENUM('Casa','Casa de Campo','Apartamento') NOT NULL,
	price varchar(100) NOT NULL,
	user_id BIGINT UNSIGNED NOT NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;
