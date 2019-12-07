DROP TABLE IF EXISTS machines;
CREATE TABLE machines (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  Name TEXT NOT NULL,
  Mac CHAR(12),
  IP CHAR(16),
  IPv6 CHAR(40),
  Location TEXT,
  Com TEXT,
  Owner TEXT,
  eMail TEXT,
  cmd INTEGER,
  FOREIGN KEY (cmd) REFERENCES commands(id)
);

DROP TABLE IF EXISTS commands;
CREATE TABLE commands (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  cmd TEXT UNIQUE
);