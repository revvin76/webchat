<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$component = new OssnEntities;
$images_root_dir = ossn_route()->www . 'images/';
$groupimages_dir = ossn_route()->www . 'images/groups/';
$userimages_dir = ossn_route()->www . 'images/users/';

if (!is_dir($images_root_dir)) {
	mkdir($images_root_dir);
}

if (!is_dir($groupimages_dir)) {
	mkdir($groupimages_dir);
}

if (!is_dir($userimages_dir)) {
	mkdir($userimages_dir);
}
	
$query1 ="CREATE TABLE IF NOT EXISTS WebChat_groupmembers (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  groupid int(6) UNSIGNED NOT NULL,
  userid int(6) UNSIGNED NOT NULL
);";

$query2 ="CREATE TABLE IF NOT EXISTS WebChat_groups (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(60) DEFAULT NULL,
  owner int(6) UNSIGNED NOT NULL,
  deleted int(6) UNSIGNED DEFAULT 0,
  photo varchar(60) DEFAULT NULL
);";

$query3 ="CREATE TABLE IF NOT EXISTS WebChat_groupsphotos (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  groupid int(6) UNSIGNED NOT NULL,
  filename varchar(60) NOT NULL
);";

$query4 ="CREATE TABLE IF NOT EXISTS WebChat_messagedata (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  userid int(6) UNSIGNED NOT NULL,
  groupid int(6) UNSIGNED NOT NULL,
  messageid int(6) UNSIGNED NOT NULL,
  delivered int(6) UNSIGNED NOT NULL DEFAULT 0,
  viewed int(6) UNSIGNED NOT NULL DEFAULT 0,
  deleted int(6) UNSIGNED NOT NULL DEFAULT 0
);";

$query5 ="CREATE TABLE IF NOT EXISTS WebChat_messages (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  groupid int(6) UNSIGNED NOT NULL,
  message_from int(6) UNSIGNED NOT NULL,
  message varchar(999) NOT NULL,
  preview varchar(9999) DEFAULT NULL,
  type int(6) NOT NULL DEFAULT 0,
  time timestamp NOT NULL DEFAULT current_timestamp(),
  deleted timestamp NULL DEFAULT NULL
);";

$query6 ="CREATE TABLE IF NOT EXISTS WebChat_thumbnails (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  owner int(6) UNSIGNED NOT NULL,
  groupid int(6) DEFAULT NULL,
  photo varchar(999) DEFAULT NULL
);";;

$component->statement($query1);
$component->execute();
$component->statement($query2);
$component->execute();
$component->statement($query3);
$component->execute();
$component->statement($query4);
$component->execute();
$component->statement($query5);
$component->execute();
$component->statement($query6);
$component->execute();
