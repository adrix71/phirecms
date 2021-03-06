--
-- Phire CMS 2 SQLite Database
--

-- --------------------------------------------------------

--
-- Set database encoding
--

PRAGMA encoding = "UTF-8";
PRAGMA foreign_keys = ON;

-- --------------------------------------------------------

--
-- Table structure for table "config"
--

DROP TABLE IF EXISTS "[{prefix}]config";
CREATE TABLE IF NOT EXISTS "[{prefix}]config" (
  "setting" varchar NOT NULL PRIMARY KEY,
  "value" text NOT NULL,
  UNIQUE ("setting")
) ;

--
-- Dumping data for table "config"
--

INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('domain', '');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('document_root', '');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('installed_on', '0000-00-00 00:00:00');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('updated_on', '0000-00-00 00:00:00');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('system_theme', 'default');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('datetime_format', 'M j Y');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('pagination', '25');
INSERT INTO "[{prefix}]config" ("setting", "value") VALUES ('updates', '');

-- --------------------------------------------------------

--
-- Table structure for table "roles"
--

DROP TABLE IF EXISTS "[{prefix}]roles";
CREATE TABLE IF NOT EXISTS "[{prefix}]roles" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "parent_id" integer,
  "name" varchar NOT NULL,
  "verification" integer,
  "approval" integer,
  "email_as_username" integer,
  "email_required" integer,
  "permissions" text,
  UNIQUE ("id"),
  CONSTRAINT "fk_role_parent_id" FOREIGN KEY ("parent_id") REFERENCES "[{prefix}]roles" ("id") ON DELETE SET NULL ON UPDATE CASCADE
) ;

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('[{prefix}]roles', 2000);
CREATE INDEX "user_role_name" ON "[{prefix}]roles" ("name");

--
-- Dumping data for table "roles"
--

INSERT INTO "[{prefix}]roles" ("id", "parent_id", "name", "verification", "approval", "email_as_username", "email_required", "permissions") VALUES
(2001, NULL, 'Phire', 1, 1, 0, 0, 'a:2:{s:5:"allow";a:0:{}s:4:"deny";a:2:{i:0;a:2:{s:8:"resource";s:8:"register";s:10:"permission";N;}i:1;a:2:{s:8:"resource";s:11:"unsubscribe";s:10:"permission";N;}}}');

-- --------------------------------------------------------

-- --
-- Table structure for table "users"
--

DROP TABLE IF EXISTS "[{prefix}]users";
CREATE TABLE IF NOT EXISTS "[{prefix}]users" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "role_id" integer,
  "username" varchar NOT NULL,
  "password" varchar NOT NULL,
  "first_name" varchar,
  "last_name" varchar,
  "company" varchar,
  "title" varchar,
  "email" varchar,
  "phone" varchar,
  "active" integer,
  "verified" integer,
  UNIQUE ("id"),
  CONSTRAINT "fk_user_role" FOREIGN KEY ("role_id") REFERENCES "[{prefix}]roles" ("id") ON DELETE CASCADE ON UPDATE CASCADE
) ;

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('[{prefix}]users', 1000);
CREATE INDEX "user_role_id" ON "[{prefix}]users" ("role_id");
CREATE INDEX "username" ON "[{prefix}]users" ("username");
CREATE INDEX "user_email" ON "[{prefix}]users" ("email");
CREATE INDEX "user_first_name" ON "[{prefix}]users" ("first_name");
CREATE INDEX "user_last_name" ON "[{prefix}]users" ("last_name");

--
-- Dumping data for table "users"
--

-- --------------------------------------------------------

-- --
-- Table structure for table "modules"
--

DROP TABLE IF EXISTS "[{prefix}]modules";
CREATE TABLE IF NOT EXISTS "[{prefix}]modules" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "file" varchar NOT NULL,
  "folder" varchar NOT NULL,
  "name" varchar NOT NULL,
  "prefix" varchar NOT NULL,
  "version" varchar NOT NULL,
  "active" integer NOT NULL,
  "order" integer NOT NULL,
  "assets" text,
  "updates" text,
  "installed_on" datetime,
  "updated_on" datetime,
  UNIQUE ("id")
) ;

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('[{prefix}]modules', 3000);
CREATE INDEX "module_folder" ON "[{prefix}]modules" ("folder");
