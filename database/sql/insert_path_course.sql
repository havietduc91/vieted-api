CREATE TABLE [path_course] (
	path_code VARCHAR(255) NOT NULL,
	course_code VARCHAR(255) NOT NULL,
	created_ts datetime NOT NULL,
	updated_ts datetime NOT NULL,
  CONSTRAINT [PK_PATH_COURSE] PRIMARY KEY CLUSTERED
  (
  [path_code] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)
)