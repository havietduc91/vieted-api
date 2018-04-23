CREATE TABLE [path] (
	id NUMERIC(18,0) NOT NULL,
	code VARCHAR(255) NOT NULL UNIQUE,
	name NVARCHAR(255) NOT NULL,
	elearning_status VARCHAR(255) NOT NULL,
	org_id NUMERIC(18,0) NOT NULL,
	object NTEXT,
	content NTEXT,
	goal NTEXT,
	start_time datetime,
	end_time datetime,
	created_at datetime NOT NULL,
	updated_at datetime NOT NULL,
  CONSTRAINT [PK_PATH] PRIMARY KEY CLUSTERED
  (
  [id] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)

)