CREATE TABLE IF NOT EXISTS `#__vmmdatabase_details` (

  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `app_url` varchar(100)  DEFAULT '',
  `app_user` varchar(50)  DEFAULT '',
  `app_pass` varchar(100)  DEFAULT '',
  `app_key` json,
  `all_notes` tinytext,
  `prj_url` varchar(255)  DEFAULT '',
  `prj_customer` varchar(255)  DEFAULT '',
  `prj_hosting_url` varchar(255)  DEFAULT '',
  `prj_hosting_user` varchar(255)  DEFAULT '',
  `prj_hosting_pass` varchar(255)  DEFAULT '',
  `prj_ftp_adress` varchar(255)  DEFAULT '',
  `prj_ftp_user` varchar(255)  DEFAULT '',
  `prj_ftp_pass` varchar(255)  DEFAULT '',
  `prj_myadmin_url` varchar(255)  DEFAULT '',
  `prj_myadmin_user` varchar(255)  DEFAULT '',
  `prj_myadmin_pass` varchar(255)  DEFAULT '',
  `prj_sql_dbname` varchar(255)  DEFAULT '',
  `prj_sql_user` varchar(255)  DEFAULT '',
  `prj_sql_pass` varchar(255)  DEFAULT '',
  `prj_cms_url` varchar(255)  DEFAULT '',
  `prj_cms_user` varchar(255)  DEFAULT '',
  `prj_cms_pass` varchar(255)  DEFAULT '',
  `mtn_mysiteguru` boolean  DEFAULT FALSE,
  `mtn_pagebuilder` varchar(255)  DEFAULT FALSE,
  `mtn_last_backup` datetime  DEFAULT CURRENT_TIMESTAMP,
  `mtn_backup_type` tinytext ,
  `mtn_cms_version` varchar(30)  DEFAULT '',
  `mtn_php_version` varchar(20)  DEFAULT '',
  `mtn_update_interval` varchar(20)  DEFAULT '',
  `mtn_last_update` datetime  DEFAULT CURRENT_TIMESTAMP,


  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `access` int(10) unsigned NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD KEY `idx_access` (`access`);

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `catid` int(11) NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `state` tinyint(3) NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD KEY `idx_catid` (`catid`);

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `published` tinyint(1) NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `publish_up` datetime AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `publish_down` datetime AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD KEY `idx_state` (`published`);

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `language` char(7) NOT NULL DEFAULT '*' AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD KEY `idx_language` (`language`);

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN  `ordering` int(11) NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN `checked_out` int(10) unsigned NOT NULL DEFAULT 0 AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD COLUMN `checked_out_time` datetime AFTER `title`;

ALTER TABLE `#__vmmdatabase_details` ADD KEY `idx_checkout` (`checked_out`);
