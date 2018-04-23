CREATE TABLE [organization] (
	id NUMERIC(18, 0) NOT NULL,
	code VARCHAR(255) NOT NULL,
	name NVARCHAR(255) NOT NULL,
	org_id NUMERIC(18, 0) NOT NULL UNIQUE,
	level integer NOT NULL,
	parent_code VARCHAR(255) NOT NULL,
	is_tct integer,
	is_active integer,
	elearning_status VARCHAR(255),
	hrms_status VARCHAR(255) NOT NULL,
	created_at datetime NOT NULL,
	updated_at datetime NOT NULL,
  CONSTRAINT [PK_ORGANIZATION] PRIMARY KEY CLUSTERED
  (
  [id] ASC
  ) WITH (IGNORE_DUP_KEY = OFF)

)