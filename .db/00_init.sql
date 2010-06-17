DROP TABLE IF EXISTS news;
CREATE TABLE news
(
		  id integer auto_increment,
		  publ_begin date,
		  publ_end date,
		  top boolean,
		  subject text,
		  body text,
		  image text,
		  CONSTRAINT news_pkey PRIMARY KEY (id)
);

CREATE INDEX news_date
  ON news
  (publ_begin, publ_end);


DROP TABLE IF EXISTS settings;
CREATE TABLE settings
(
		  set_id integer auto_increment,
		  set_name varchar(255) NOT NULL,
		  set_value text,
		  CONSTRAINT settings_pkey PRIMARY KEY (set_id),
		  CONSTRAINT settings_set_name_key UNIQUE (set_name)
);

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
		  user_id integer auto_increment NOT NULL,
		  u_login varchar(255),
		  u_passwd text,
		  u_fname text,
		  u_lname text,
		  u_lastlogin datetime,
		  CONSTRAINT users_pkey PRIMARY KEY (user_id),
		  CONSTRAINT users_u_login_key UNIQUE (u_login)
);

DROP TABLE IF EXISTS user_rights;
CREATE TABLE user_rights
(
		  id integer auto_increment NOT NULL,
		  controller_id text,
		  allow_action text,
		  user_group_id integer,
		  CONSTRAINT user_rights_pkey PRIMARY KEY (id)
);

DROP TABLE IF EXISTS user_groups;
CREATE TABLE user_groups
(
		  id integer auto_increment NOT NULL,
		  name text,
		  CONSTRAINT user_groups_pkey PRIMARY KEY (id)
);

DROP TABLE IF EXISTS static_pages;
CREATE TABLE static_pages
(
		  id varchar(255) NOT NULL,
		  sp_title text,
		  sp_meta text,
		  sp_text text,
		  sp_meta_descr text,
		  CONSTRAINT static_pages_pkey PRIMARY KEY (id)
);

DROP TABLE IF EXISTS static_pages_history;
CREATE TABLE static_pages_history
(
		id integer auto_increment NOT NULL,
		sp_id	text,
		hdate	datetime,
		sp_text	text,	-- save history only for the page body
		CONSTRAINT static_pages_history_pkey PRIMARY KEY (id)
);

insert into user_groups values(1,'Admin');
insert into users values(1,'admin',md5('mymegapassword'),'','',NOW() );


