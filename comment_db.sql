
CREATE DATABASE `comment_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `comment_db`;

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'id of comment',
  `author` varchar(20) NOT NULL COMMENT 'name of user',
  `text` longtext NOT NULL COMMENT 'the text of the comment',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;



INSERT INTO `comment` (`id`, `author`, `text`) VALUES
(1, 'Ivko Iryna', 'This is the fist comment that needs to be displayed in the list of comments. It is not that long and not short. It is just an example of entry.  '),
(2, 'Petrov Alex', 'In software engineering, the active record pattern is an architectural pattern found in software that stores its data in relational databases. It was named by Martin Fowler in his 2003 book Patterns of Enterprise Application Architecture.[1] The interface of an object conforming to this pattern would include functions such as Insert, Update, and Delete, plus properties that correspond more or less directly to the columns in the underlying database table.'),
(3, 'Mr. Smith', 'In software engineering, the singleton pattern is a design pattern that restricts the instantiation of a class to one object. This is useful when exactly one object is needed to coordinate actions across the system. The concept is sometimes generalized to systems that operate more efficiently when only one object exists, or that restrict the instantiation to a certain number of objects. The term comes from the mathematical concept of a singleton.');

