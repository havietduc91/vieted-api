CREATE TABLE [log] (
	id NUMERIC(18,0) NOT NULL,
	table_name varchar(255) NOT NULL,
	action varchar(255) NOT NULL,
	start_time datetime NOT NULL,
	end_time datetime,
	status varchar(255),
	log_text NTEXT,
	created_at datetime NOT NULL
  CONSTRAINT [PK_LOG] PRIMARY KEY CLUSTERED
  (
  [id] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)

)