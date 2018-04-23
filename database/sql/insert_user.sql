CREATE TABLE [user] (
	id NUMERIC(18,0) NOT NULL,
	ns_id NUMERIC(18,0) NOT NULL UNIQUE,
	login_name CHAR(255) NOT NULL,
	full_name NVARCHAR(255) NOT NULL,
	org_id NUMERIC(18,0) NOT NULL,
	department_name NVARCHAR(255),
	job_title NVARCHAR(255),
	phone varchar(255),
	sex varchar(255) NOT NULL,
	ns_number NUMERIC(18,0) NOT NULL,
	mail varchar(255) NOT NULL,
	birthday datetime NOT NULL,
	elearning_status varchar(255) NOT NULL,
	hrms_status varchar(255) NOT NULL,
	user_ad varchar(255) NOT NULL,
	user_enable varchar(255) NOT NULL,
	created_at datetime NOT NULL,
	updated_at datetime NOT NULL,
  CONSTRAINT [PK_USER] PRIMARY KEY CLUSTERED
  (
  [id] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)

)