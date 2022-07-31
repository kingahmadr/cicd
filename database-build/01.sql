CREATE DATABASE IF NOT EXISTS `test`;
GRANT ALL ON `test`.* TO 'user_db'@'%';

CREATE DATABASE IF NOT EXISTS `database1`;
GRANT ALL ON `database2`.* TO 'user_db'@'%';

CREATE DATABASE IF NOT EXISTS `database2`;
GRANT ALL ON `database2`.* TO 'user_db'@'%';

CREATE DATABASE IF NOT EXISTS `database3`;
GRANT ALL ON `database3`.* TO 'user_db'@'%';
