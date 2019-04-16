create schema `e-learning` collate utf8_unicode_ci;

create table answer
(
	id int auto_increment
		primary key,
	answer_content varchar(255) null,
	question_id int null,
	`rank` smallint(6) null,
	create_at datetime null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null
)
collate=utf8_bin;

create table course
(
	id int auto_increment
		primary key,
	subject_id int null,
	teacher_id int null,
	name varchar(255) null,
	image1 varchar(255) null,
	image2 varchar(255) null,
	image3 varchar(255) null,
	description text null,
	create_at datetime null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null
)
collate=utf8_bin;

create table enroll
(
	id int auto_increment
		primary key,
	course_id int null,
	student_id int null,
	status int default 0 null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null,
	create_at datetime null
)
collate=utf8_bin;

create table essay_answer
(
	id int null,
	material_id int null,
	question_id int null,
	student_id int null,
	content longtext null,
	create_by int null,
	create_at datetime null,
	del_flg smallint(6) null
);

create table lession
(
	id int auto_increment
		primary key,
	course_id int null,
	`rank` int null,
	name varchar(255) null,
	image varchar(255) null,
	length int default 0 null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	create_at datetime null,
	del_flg smallint(6) default 0 null,
	overview varchar(255) null
)
collate=utf8_bin;

create table lession_status
(
	id int auto_increment
		primary key,
	status int null,
	lesson_id int null,
	student_id int null,
	update_by int null,
	create_by int null,
	update_at datetime null,
	create_at datetime null,
	del_flg smallint(6) default 0 null
);

create table material
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	lesson_id int null,
	type int default 0 null,
	`rank` smallint(6) null,
	limit_time int null,
	content_url varchar(255) null,
	descriptions text null,
	create_at datetime null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null
)
collate=utf8_bin;

create table migration
(
	version varchar(180) not null
		primary key,
	apply_time int null
);

create table qa
(
	id int auto_increment
		primary key,
	student_id int null,
	material_id int null,
	question text null,
	answer text null,
	create_by int null,
	update_by int null,
	create_at datetime null,
	update_at datetime null,
	del_Flg int default 0 null,
	is_approved smallint(6) null
);

create table question
(
	id int auto_increment
		primary key,
	material_id int null,
	name varchar(255) null,
	content text null,
	`rank` smallint(6) null,
	hint varchar(255) null,
	answer_content varchar(255) null,
	create_at datetime null,
	essay_content varchar(255) null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null
)
collate=utf8_bin;

create table question_component
(
	id int auto_increment
		primary key,
	name varchar(50) null,
	question_id int null,
	missing smallint(6) null,
	`rank` int null,
	create_by int null,
	create_at datetime null,
	del_flg smallint(6) default 0 null
);

create table question_status
(
	id int auto_increment
		primary key,
	student_id int null,
	question_id int null,
	type smallint(6) null,
	status smallint(6) null,
	create_by int null,
	create_at datetime null,
	del_flg smallint(6) default 0 null
);

create table quiz
(
	id int auto_increment
		primary key,
	material_id varchar(45) null,
	type smallint(6) null,
	content varchar(255) null,
	create_at datetime null,
	update_at datetime null,
	create_by int null,
	update_by int null,
	del_flg smallint(6) default 0 null
)
collate=utf8_bin;

create table student
(
	id int auto_increment
		primary key,
	username varchar(255) not null,
	name varchar(255) collate utf8_bin not null,
	phone char(11) null,
	class varchar(10) collate utf8_bin null,
	dob varchar(10) null,
	conduct smallint(6) null,
	address varchar(255) collate utf8_bin not null,
	image varchar(255) collate utf8_bin null,
	contact varchar(255) collate utf8_bin null,
	auth_key varchar(32) not null,
	password_hash varchar(255) not null,
	password_reset_token varchar(255) null,
	email varchar(255) not null,
	status smallint(6) default 10 not null,
	created_at int not null,
	updated_at int not null,
	verification_token varchar(255) null,
	constraint email
		unique (email),
	constraint password_reset_token
		unique (password_reset_token),
	constraint username
		unique (username)
);

create table subject
(
	id int not null
		primary key,
	image varchar(255) null,
	name varchar(50) not null,
	create_at datetime null,
	update_at datetime null
)
collate=utf8_bin;

create table user
(
	id int auto_increment
		primary key,
	username varchar(255) not null,
	auth_key varchar(32) not null,
	password_hash varchar(255) not null,
	password_reset_token varchar(255) null,
	email varchar(255) not null,
	status smallint(6) default 10 not null,
	created_at int not null,
	updated_at int not null,
	verification_token varchar(255) null,
	constraint email
		unique (email),
	constraint password_reset_token
		unique (password_reset_token),
	constraint username
		unique (username)
);

