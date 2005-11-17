# phpMyAdmin SQL Dump
# version 2.5.7-pl1
# http://www.phpmyadmin.net
#
# Host: localhost
# Erstellungszeit: 11. November 2005 um 15:42
# Server Version: 4.0.20
# PHP-Version: 4.3.8
# 
# Datenbank: `podtracker`
# 

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `ptracker`
#

CREATE TABLE `ptracker` (
  `id` bigint(20) NOT NULL auto_increment,
  `url` char(255) default NULL,
  `time` date default NULL,
  `host` char(40) default NULL,
  `ip` char(20) default NULL,
  `ref` char(255) default NULL,
  `os` char(50) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Daten für Tabelle `ptracker`
#

INSERT INTO `ptracker` VALUES (1, '../stats.php', '2005-11-11', 'localhost', '127.0.0.1', '', 'Win');
INSERT INTO `ptracker` VALUES (2, '../ffffff', '2005-11-11', 'localhost', '127.0.0.1', '', 'Win');
INSERT INTO `ptracker` VALUES (3, '../stats.php', '2005-11-11', 'localhost', '127.0.0.1', '', 'Win');