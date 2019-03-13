
# SQL Dump for wgrealestate module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net


# Table structure for table `wgrealestate_objects` 

CREATE TABLE `wgrealestate_objects` (
  `obj_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `obj_title` varchar(200) NOT NULL,
  `obj_dealt_id` int(10) NOT NULL DEFAULT '0',
  `obj_objcat_id` int(10) NOT NULL DEFAULT '0',
  `obj_ctry` varchar(100) NOT NULL DEFAULT '',
  `obj_postalcode` varchar(100) NOT NULL DEFAULT '',
  `obj_city` varchar(100) NOT NULL DEFAULT '',
  `obj_address` varchar(100) NOT NULL DEFAULT '',
  `obj_geo_lng` varchar(100) NOT NULL DEFAULT '',
  `obj_geo_lat` varchar(100) NOT NULL DEFAULT '',
  `obj_geo_placeid` varchar(100) NOT NULL DEFAULT '',
  `obj_seller_id` int(10) NOT NULL DEFAULT '0',
  `obj_descr` text NOT NULL,
  `obj_infos` text NOT NULL,
  `obj_misc` text NOT NULL,
  `obj_location` text NOT NULL,
  `obj_views` int(10) NOT NULL DEFAULT '0',
  `obj_contacts` int(10) NOT NULL DEFAULT '0',
  `obj_state` int(1) NOT NULL DEFAULT '0',
  `obj_datecreate` int(10) NOT NULL DEFAULT '0',
  `obj_datestate` int(10) NOT NULL DEFAULT '0',
  `obj_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_attributes` 

CREATE TABLE `wgrealestate_attributes` (
  `att_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `att_objid` int(10) NOT NULL DEFAULT '0',
  `att_attdefid` int(10) NOT NULL DEFAULT '0',
  `att_attcatid` int(10) NOT NULL DEFAULT '0',
  `att_info` text NOT NULL,
  `att_value` varchar(100) NOT NULL DEFAULT '',
  `att_weight` int(1) NOT NULL DEFAULT '0',
  `att_datecreate` int(10) NOT NULL DEFAULT '0',
  `att_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_objcategories` 

CREATE TABLE `wgrealestate_objcategories` (
  `objcat_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `objcat_name` varchar(100) NOT NULL DEFAULT '',
  `objcat_valid` varchar(1) NOT NULL DEFAULT '',
  `objcat_datecreate` int(10) NOT NULL DEFAULT '0',
  `objcat_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`objcat_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_attdefaults` 

CREATE TABLE `wgrealestate_attdefaults` (
  `attdef_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `attdef_parent` int(10) NOT NULL DEFAULT '0',
  `attdef_name` varchar(100) NOT NULL DEFAULT '',
  `attdef_dealtid` int(1) NOT NULL DEFAULT '0',
  `attdef_attcatid` int(10) DEFAULT '0',
  `attdef_type` int(1) NOT NULL DEFAULT '0',
  `attdef_index` int(1) NOT NULL DEFAULT '0',
  `attdef_weight` int(10) DEFAULT '0',
  `attdef_valid` int(1) NOT NULL DEFAULT '0',
  `attdef_datecreate` int(10) NOT NULL DEFAULT '0',
  `attdef_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attdef_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_attcategories` 

CREATE TABLE `wgrealestate_attcategories` (
  `attcat_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `attcat_name` varchar(200) NOT NULL DEFAULT '',
  `attcat_info` varchar(200) NOT NULL DEFAULT '',
  `attcat_show` int(1) NOT NULL DEFAULT '0',
  `attcat_weight` int(10) NOT NULL DEFAULT '0',
  `attcat_valid` int(1) NOT NULL DEFAULT '0',
  `attcat_datecreate` int(10) NOT NULL DEFAULT '0',
  `attcat_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attcat_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_costs` 

CREATE TABLE `wgrealestate_costs` (
  `cost_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `cost_obj_id` int(10) NOT NULL DEFAULT '0',
  `cost_costt_id` int(10) NOT NULL DEFAULT '0',
  `cost_perc` float NOT NULL DEFAULT '0',
  `cost_base` float NOT NULL DEFAULT '0',
  `cost_value` float NOT NULL DEFAULT '0',
  `cost_info` text NOT NULL,
  `cost_weight` int(10) NOT NULL DEFAULT '0',
  `cost_datecreate` int(10) NOT NULL DEFAULT '0',
  `cost_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cost_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_cost_types` 

CREATE TABLE `wgrealestate_cost_types` (
  `costt_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `costt_text` varchar(100) NOT NULL DEFAULT '',
  `costt_dealt_id` int(10) NOT NULL DEFAULT '0',
  `costt_perc` float NOT NULL,
  `costt_fixed` float NOT NULL,
  `costt_info` varchar(100) NOT NULL,
  `costt_index` int(1) NOT NULL DEFAULT '0',
  `costt_valid` int(1) NOT NULL DEFAULT '0',
  `costt_datecreate` int(10) NOT NULL DEFAULT '0',
  `costt_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`costt_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_images` 

CREATE TABLE `wgrealestate_images` (
  `img_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `img_obj_id` int(10) NOT NULL DEFAULT '0',
  `img_title` varchar(200) NOT NULL,
  `img_info` text NOT NULL,
  `img_name` varchar(200) NOT NULL DEFAULT '0',
  `img_cat` int(10) NOT NULL DEFAULT '0',
  `img_width` int(10) NOT NULL DEFAULT '0',
  `img_height` int(140) NOT NULL DEFAULT '0',
  `img_size` int(10) NOT NULL DEFAULT '0',
  `img_weight` int(10) NOT NULL DEFAULT '0',
  `img_datecreate` int(10) NOT NULL DEFAULT '0',
  `img_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_files` 

CREATE TABLE `wgrealestate_files` (
  `file_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `file_obj_id` int(10) NOT NULL DEFAULT '0',
  `file_title` varchar(100) NOT NULL,
  `file_info` varchar(200) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` int(10) NOT NULL DEFAULT '0',
  `file_weight` int(10) NOT NULL DEFAULT '0',
  `file_datecreate` int(10) NOT NULL DEFAULT '0',
  `file_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB;


# Table structure for table `wgrealestate_sellers` 

CREATE TABLE `wgrealestate_sellers` (
  `seller_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `seller_name` varchar(200) NOT NULL DEFAULT '',
  `seller_ctry` varchar(10) NOT NULL DEFAULT '',
  `seller_postal_code` varchar(100) NOT NULL DEFAULT '',
  `seller_city` varchar(100) NOT NULL DEFAULT '',
  `seller_address` varchar(100) NOT NULL DEFAULT '',
  `seller_phone` varchar(100) NOT NULL DEFAULT '',
  `seller_mail` varchar(100) NOT NULL DEFAULT '',
  `seller_cat` int(1) NOT NULL DEFAULT '0',
  `seller_public` int(1) NOT NULL DEFAULT '0',
  `seller_datecreate` int(10) NOT NULL DEFAULT '0',
  `seller_submitter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB;
