CREATE TABLE [progress] (
	id NUMERIC(18, 0) NOT NULL,
	ns_id NUMERIC(18, 0) NOT NULL,
	item_type VARCHAR(255) NOT NULL,
	course_code VARCHAR(255) NOT NULL,
	path_code VARCHAR(255) NOT NULL,
	score float,
	progress float,
	pass integer,
	elearning_status VARCHAR(255) NOT NULL,
	created_ts datetime NOT NULL,
	updated_ts datetime NOT NULL,
  CONSTRAINT [PK_PROGRESS] PRIMARY KEY CLUSTERED
  (
  [id] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)
