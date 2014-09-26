CREATE TABLE IF NOT EXISTS `affect` (
  `dwPID` int(10) unsigned NOT NULL DEFAULT '0',
  `bType` smallint(5) unsigned NOT NULL DEFAULT '0',
  `bApplyOn` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `lApplyValue` int(11) NOT NULL DEFAULT '0',
  `dwFlag` int(10) unsigned NOT NULL DEFAULT '0',
  `lDuration` int(11) NOT NULL DEFAULT '0',
  `lSPCost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dwPID`,`bType`,`bApplyOn`,`lApplyValue`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `banword` (
  `word` varchar(24) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `change_empire` (
  `change_count` int(11) NOT NULL DEFAULT '0',
  `account_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`change_count`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL DEFAULT '',
  `sp` smallint(6) NOT NULL DEFAULT '1000',
  `master` int(10) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(2) DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  `skill_point` tinyint(2) NOT NULL DEFAULT '0',
  `skill` tinyblob,
  `win` int(11) NOT NULL DEFAULT '0',
  `draw` int(11) NOT NULL DEFAULT '0',
  `loss` int(11) NOT NULL DEFAULT '0',
  `ladder_point` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `guild_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(8) DEFAULT NULL,
  `notice` tinyint(4) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aaa` (`notice`,`id`,`guild_id`),
  KEY `guild_id` (`guild_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `guild_grade` (
  `guild_id` int(11) NOT NULL DEFAULT '0',
  `grade` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(8) NOT NULL DEFAULT '',
  `auth` set('ADD_MEMBER','REMOVE_MEMEBER','NOTICE','USE_SKILL') DEFAULT NULL,
  PRIMARY KEY (`guild_id`,`grade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guild_member` (
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `guild_id` int(10) unsigned NOT NULL DEFAULT '0',
  `grade` tinyint(2) DEFAULT NULL,
  `is_general` tinyint(1) NOT NULL DEFAULT '0',
  `offer` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`guild_id`,`pid`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guild_war` (
  `id_from` int(11) NOT NULL DEFAULT '0',
  `id_to` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_from`,`id_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guild_war_bet` (
  `login` varchar(24) NOT NULL DEFAULT '',
  `gold` int(10) unsigned NOT NULL DEFAULT '0',
  `guild` int(11) NOT NULL DEFAULT '0',
  `war_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`war_id`,`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guild_war_reservation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guild1` int(10) unsigned NOT NULL DEFAULT '0',
  `guild2` int(10) unsigned NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `warprice` int(10) unsigned NOT NULL DEFAULT '0',
  `initscore` int(10) unsigned NOT NULL DEFAULT '0',
  `started` tinyint(1) NOT NULL DEFAULT '0',
  `bet_from` int(10) unsigned NOT NULL DEFAULT '0',
  `bet_to` int(10) unsigned NOT NULL DEFAULT '0',
  `winner` int(11) NOT NULL DEFAULT '-1',
  `power1` int(11) NOT NULL DEFAULT '0',
  `power2` int(11) NOT NULL DEFAULT '0',
  `handicap` int(11) NOT NULL DEFAULT '0',
  `result1` int(11) NOT NULL DEFAULT '0',
  `result2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `highscore` (
  `pid` int(11) DEFAULT NULL,
  `board` varchar(0) CHARACTER SET latin1 DEFAULT NULL,
  `value` varchar(0) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `horse_name` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(24) CHARACTER SET latin1 NOT NULL DEFAULT 'NONAME',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) unsigned NOT NULL DEFAULT '0',
  `window` enum('INVENTORY','EQUIPMENT','SAFEBOX','MALL','ITEM_DS') NOT NULL DEFAULT 'INVENTORY',
  `pos` smallint(5) unsigned NOT NULL DEFAULT '0',
  `count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vnum` int(11) unsigned NOT NULL DEFAULT '0',
  `socket0` int(10) unsigned NOT NULL DEFAULT '0',
  `socket1` int(10) unsigned NOT NULL DEFAULT '0',
  `socket2` int(10) unsigned NOT NULL DEFAULT '0',
  `socket3` int(10) unsigned NOT NULL DEFAULT '0',
  `socket4` int(10) unsigned NOT NULL DEFAULT '0',
  `socket5` int(10) unsigned NOT NULL DEFAULT '0',
  `attrtype0` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue0` smallint(6) NOT NULL DEFAULT '0',
  `attrtype1` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue1` smallint(6) NOT NULL DEFAULT '0',
  `attrtype2` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue2` smallint(6) NOT NULL DEFAULT '0',
  `attrtype3` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue3` smallint(6) NOT NULL DEFAULT '0',
  `attrtype4` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue4` smallint(6) NOT NULL DEFAULT '0',
  `attrtype5` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue5` smallint(6) NOT NULL DEFAULT '0',
  `attrtype6` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue6` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_id_idx` (`owner_id`),
  KEY `item_vnum_index` (`vnum`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `item_attr` (
  `apply` enum('MAX_HP','MAX_SP','CON','INT','STR','DEX','ATT_SPEED','MOV_SPEED','CAST_SPEED','HP_REGEN','SP_REGEN','POISON_PCT','STUN_PCT','SLOW_PCT','CRITICAL_PCT','PENETRATE_PCT','ATTBONUS_HUMAN','ATTBONUS_ANIMAL','ATTBONUS_ORC','ATTBONUS_MILGYO','ATTBONUS_UNDEAD','ATTBONUS_DEVIL','STEAL_HP','STEAL_SP','MANA_BURN_PCT','DAMAGE_SP_RECOVER','BLOCK','DODGE','RESIST_SWORD','RESIST_TWOHAND','RESIST_DAGGER','RESIST_BELL','RESIST_FAN','RESIST_BOW','RESIST_FIRE','RESIST_ELEC','RESIST_MAGIC','RESIST_WIND','REFLECT_MELEE','REFLECT_CURSE','POISON_REDUCE','KILL_SP_RECOVER','EXP_DOUBLE_BONUS','GOLD_DOUBLE_BONUS','ITEM_DROP_BONUS','POTION_BONUS','KILL_HP_RECOVER','IMMUNE_STUN','IMMUNE_SLOW','IMMUNE_FALL','SKILL','BOW_DISTANCE','ATT_GRADE_BONUS','DEF_GRADE_BONUS','MAGIC_ATT_GRADE','MAGIC_DEF_GRADE','CURSE_PCT','MAX_STAMINA','ATT_BONUS_TO_WARRIOR','ATT_BONUS_TO_ASSASSIN','ATT_BONUS_TO_SURA','ATT_BONUS_TO_SHAMAN','NORMAL_HIT_DEFEND_BONUS','SKILL_DEFEND_BONUS','NOUSE1','NOUSE2''NOUSE3','NOUSE4','NOUSE5','NOUSE6','NOUSE7','NOUSE8','NOUSE9','NOUSE10','NOUSE11','NOUSE12','NOUSE13','NOUSE14','RESIST_WARRIOR','RESIST_ASSASSIN','RESIST_SURA','RESIST_SHAMAN') NOT NULL DEFAULT 'MAX_HP',
  `prob` varchar(100) NOT NULL DEFAULT '',
  `lv1` varchar(100) NOT NULL DEFAULT '',
  `lv2` varchar(100) NOT NULL DEFAULT '',
  `lv3` varchar(100) NOT NULL DEFAULT '',
  `lv4` varchar(100) NOT NULL DEFAULT '',
  `lv5` varchar(100) NOT NULL DEFAULT '',
  `weapon` varchar(100) NOT NULL DEFAULT '',
  `body` varchar(100) NOT NULL DEFAULT '',
  `wrist` varchar(100) NOT NULL DEFAULT '',
  `foots` varchar(100) NOT NULL DEFAULT '',
  `neck` varchar(100) NOT NULL DEFAULT '',
  `head` varchar(100) NOT NULL DEFAULT '',
  `shield` varchar(100) NOT NULL DEFAULT '',
  `ear` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `item_attr` (`apply`, `prob`, `lv1`, `lv2`, `lv3`, `lv4`, `lv5`, `weapon`, `body`, `wrist`, `foots`, `neck`, `head`, `shield`, `ear`) VALUES
('MAX_HP', '35', '500', '500', '100', '1500', '3000', '0', '5', '5', '5', '5', '0', '0', '0'),
('MAX_SP', '35', '10', '20', '30', '50', '80', '0', '0', '5', '5', '5', '0', '0', '0'),
('CON', '11', '8', '10', '10', '12', '12', '5', '0', '0', '0', '0', '0', '5', '0'),
('INT', '11', '8', '10', '10', '15', '12', '5', '0', '0', '0', '0', '0', '5', '0'),
('STR', '11', '8', '10', '10', '12', '12', '5', '0', '0', '0', '0', '0', '5', '0'),
('DEX', '11', '8', '10', '10', '12', '12', '5', '0', '0', '0', '0', '0', '5', '0'),
('ATT_SPEED', '8', '5', '7', '10', '12', '15', '0', '0', '0', '5', '0', '5', '0', '0'),
('MOV_SPEED', '18', '4', '8', '10', '15', '30', '0', '0', '0', '5', '0', '0', '0', '5'),
('CAST_SPEED', '8', '4', '8', '10', '15', '30', '5', '5', '0', '0', '0', '0', '0', '0'),
('HP_REGEN', '65', '4', '8', '12', '20', '30', '0', '0', '0', '0', '5', '5', '0', '0'),
('SP_REGEN', '65', '4', '8', '12', '20', '30', '0', '0', '0', '0', '5', '5', '0', '0'),
('POISON_PCT', '8', '1', '2', '3', '5', '8', '5', '0', '0', '0', '0', '5', '0', '0'),
('STUN_PCT', '18', '1', '2', '3', '5', '8', '5', '0', '0', '5', '5', '0', '0', '0'),
('SLOW_PCT', '35', '1', '2', '3', '5', '8', '5', '0', '0', '5', '0', '0', '0', '0'),
('CRITICAL_PCT', '18', '1', '2', '3', '5', '10', '5', '0', '0', '5', '5', '0', '0', '0'),
('PENETRATE_PCT', '30', '1', '2', '3', '5', '10', '5', '0', '5', '0', '5', '0', '0', '0'),
('ATTBONUS_HUMAN', '10', '1', '2', '3', '10', '12', '5', '0', '5', '0', '0', '5', '5', '5'),
('ATTBONUS_ANIMAL', '35', '2', '4', '6', '10', '20', '5', '0', '5', '0', '0', '5', '5', '5'),
('ATTBONUS_ORC', '35', '2', '4', '6', '10', '20', '5', '0', '5', '0', '0', '5', '5', '5'),
('ATTBONUS_MILGYO', '35', '2', '4', '6', '10', '20', '5', '0', '5', '0', '0', '5', '5', '5'),
('ATTBONUS_UNDEAD', '35', '2', '4', '6', '10', '20', '5', '0', '5', '0', '0', '5', '5', '5'),
('ATTBONUS_DEVIL', '35', '2', '4', '6', '10', '20', '5', '0', '5', '0', '0', '5', '5', '5'),
('STEAL_HP', '50', '1', '2', '3', '5', '10', '0', '5', '5', '0', '0', '0', '0', '0'),
('STEAL_SP', '50', '1', '2', '3', '5', '10', '0', '5', '0', '0', '5', '5', '0', '0'),
('MANA_BURN_PCT', '18', '1', '2', '3', '5', '10', '0', '0', '5', '0', '0', '0', '0', '5'),
('BLOCK', '10', '2', '4', '6', '10', '15', '0', '0', '0', '0', '0', '0', '5', '0'),
('DODGE', '10', '2', '4', '6', '10', '15', '0', '0', '0', '5', '0', '5', '0', '0'),
('RESIST_SWORD', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_TWOHAND', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_DAGGER', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_BELL', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_FAN', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_BOW', '18', '2', '4', '6', '10', '15', '0', '5', '0', '5', '5', '0', '0', '5'),
('RESIST_FIRE', '18', '2', '4', '6', '10', '15', '0', '5', '5', '0', '0', '5', '0', '0'),
('RESIST_ELEC', '18', '2', '4', '6', '10', '15', '0', '5', '5', '0', '0', '5', '0', '0'),
('RESIST_MAGIC', '25', '2', '4', '6', '10', '15', '0', '5', '5', '0', '0', '5', '0', '0'),
('RESIST_WIND', '18', '2', '4', '6', '10', '15', '0', '5', '5', '0', '0', '5', '0', '0'),
('REFLECT_MELEE', '18', '1', '2', '3', '6', '10', '0', '5', '0', '0', '0', '0', '5', '0'),
('POISON_REDUCE', '18', '1', '2', '3', '4', '5', '0', '0', '0', '0', '0', '0', '0', '5'),
('EXP_DOUBLE_BONUS', '10', '2', '4', '6', '8', '20', '0', '0', '0', '5', '5', '0', '5', '0'),
('GOLD_DOUBLE_BONUS', '10', '2', '4', '6', '8', '20', '0', '0', '0', '5', '5', '0', '5', '0'),
('ITEM_DROP_BONUS', '7', '2', '4', '6', '8', '20', '0', '0', '5', '0', '0', '0', '0', '5'),
('IMMUNE_STUN', '3', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '0'),
('IMMUNE_SLOW', '3', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '0'),
('ATT_GRADE_BONUS', '1', '10', '15', '15', '25', '50', '0', '5', '0', '0', '0', '0', '0', '0');

CREATE TABLE IF NOT EXISTS `item_attr_rare` (
  `apply` enum('MAX_HP','MAX_SP','CON','INT','STR','DEX','ATT_SPEED','MOV_SPEED','CAST_SPEED','HP_REGEN','SP_REGEN','POISON_PCT','STUN_PCT','SLOW_PCT','CRITICAL_PCT','PENETRATE_PCT','ATTBONUS_HUMAN','ATTBONUS_ANIMAL','ATTBONUS_ORC','ATTBONUS_MILGYO','ATTBONUS_UNDEAD','ATTBONUS_DEVIL','STEAL_HP','STEAL_SP','MANA_BURN_PCT','DAMAGE_SP_RECOVER','BLOCK','DODGE','RESIST_SWORD','RESIST_TWOHAND','RESIST_DAGGER','RESIST_BELL','RESIST_FAN','RESIST_BOW','RESIST_FIRE','RESIST_ELEC','RESIST_MAGIC','RESIST_WIND','REFLECT_MELEE','REFLECT_CURSE','POISON_REDUCE','KILL_SP_RECOVER','EXP_DOUBLE_BONUS','GOLD_DOUBLE_BONUS','ITEM_DROP_BONUS','POTION_BONUS','KILL_HP_RECOVER','IMMUNE_STUN','IMMUNE_SLOW','IMMUNE_FALL','SKILL','BOW_DISTANCE','ATT_GRADE_BONUS','DEF_GRADE_BONUS','MAGIC_ATT_GRADE','MAGIC_DEF_GRADE','CURSE_PCT','MAX_STAMINA','ATT_BONUS_TO_WARRIOR','ATT_BONUS_TO_ASSASSIN','ATT_BONUS_TO_SURA','ATT_BONUS_TO_SHAMAN','ATT_BONUS_TO_MONSTER','NORMAL_HIT_DEFEND_BONUS','SKILL_DEFEND_BONUS','NOUSE2''NOUSE3','NOUSE4','NOUSE5','NOUSE6','NOUSE7','NOUSE8','NOUSE9','NOUSE10','NOUSE11','NOUSE12','NOUSE13','NOUSE14','RESIST_WARRIOR','RESIST_ASSASSIN','RESIST_SURA','RESIST_SHAMAN') NOT NULL DEFAULT 'MAX_HP',
  `prob` varchar(100) NOT NULL DEFAULT '',
  `lv1` varchar(100) NOT NULL DEFAULT '',
  `lv2` varchar(100) NOT NULL DEFAULT '',
  `lv3` varchar(100) NOT NULL DEFAULT '',
  `lv4` varchar(100) NOT NULL DEFAULT '',
  `lv5` varchar(100) NOT NULL DEFAULT '',
  `weapon` varchar(100) NOT NULL DEFAULT '',
  `body` varchar(100) NOT NULL DEFAULT '',
  `wrist` varchar(100) NOT NULL DEFAULT '',
  `foots` varchar(100) NOT NULL DEFAULT '',
  `neck` varchar(100) NOT NULL DEFAULT '',
  `head` varchar(100) NOT NULL DEFAULT '',
  `shield` varchar(100) NOT NULL DEFAULT '',
  `ear` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `item_attr_rare` (`apply`, `prob`, `lv1`, `lv2`, `lv3`, `lv4`, `lv5`, `weapon`, `body`, `wrist`, `foots`, `neck`, `head`, `shield`, `ear`) VALUES
('MAX_HP', '1', '200', '300', '300', '400', '500', '5', '5', '5', '5', '5', '5', '5', '5'),
('ATT_BONUS_TO_MONSTER', '1', '1', '2', '3', '4', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
('', '1', '1', '2', '3', '4', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
('', '1', '1', '2', '3', '4', '5', '5', '5', '5', '5', '5', '5', '5', '5');


CREATE TABLE IF NOT EXISTS `item_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `login` varchar(30) NOT NULL DEFAULT '',
  `vnum` int(6) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `given_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `taken_time` datetime DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `why` varchar(128) DEFAULT NULL,
  `socket0` int(11) NOT NULL DEFAULT '0',
  `socket1` int(11) NOT NULL DEFAULT '0',
  `socket2` int(11) NOT NULL DEFAULT '0',
  `mall` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid_idx` (`pid`),
  KEY `given_time_idx` (`given_time`),
  KEY `taken_time_idx` (`taken_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `item_proto` (
  `vnum` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varbinary(200) NOT NULL DEFAULT 'Noname                  ',
  `locale_name` varbinary(24) NOT NULL DEFAULT 'Noname                  ',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `subtype` tinyint(2) NOT NULL DEFAULT '0',
  `weight` tinyint(3) DEFAULT '0',
  `size` tinyint(3) DEFAULT '0',
  `antiflag` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '0',
  `wearflag` int(11) DEFAULT '0',
  `immuneflag` set('PARA','CURSE','STUN','SLEEP','SLOW','POISON','TERROR') NOT NULL DEFAULT '',
  `gold` int(11) DEFAULT '0',
  `shop_buy_price` int(10) unsigned NOT NULL DEFAULT '0',
  `refined_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `refine_set` smallint(11) unsigned NOT NULL DEFAULT '0',
  `refine_set2` smallint(5) unsigned NOT NULL DEFAULT '0',
  `magic_pct` tinyint(4) NOT NULL DEFAULT '0',
  `limittype0` tinyint(4) DEFAULT '0',
  `limitvalue0` int(11) DEFAULT '0',
  `limittype1` tinyint(4) DEFAULT '0',
  `limitvalue1` int(11) DEFAULT '0',
  `applytype0` tinyint(4) DEFAULT '0',
  `applyvalue0` int(11) DEFAULT '0',
  `applytype1` tinyint(4) DEFAULT '0',
  `applyvalue1` int(11) DEFAULT '0',
  `applytype2` tinyint(4) DEFAULT '0',
  `applyvalue2` int(11) DEFAULT '0',
  `value0` int(11) DEFAULT '0',
  `value1` int(11) DEFAULT '0',
  `value2` int(11) DEFAULT '0',
  `value3` int(11) DEFAULT '0',
  `value4` int(11) DEFAULT '0',
  `value5` int(11) DEFAULT '0',
  `socket0` tinyint(4) DEFAULT '-1',
  `socket1` tinyint(4) DEFAULT '-1',
  `socket2` tinyint(4) DEFAULT '-1',
  `socket3` tinyint(4) DEFAULT '-1',
  `socket4` tinyint(4) DEFAULT '-1',
  `socket5` tinyint(4) DEFAULT '-1',
  `specular` tinyint(4) NOT NULL DEFAULT '0',
  `socket_pct` tinyint(4) NOT NULL DEFAULT '0',
  `addon_type` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vnum`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `land` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map_index` int(11) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `guild_id` int(10) unsigned NOT NULL DEFAULT '0',
  `guild_level_limit` tinyint(4) NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `enable` enum('YES','NO') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `lotto_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `server` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `marriage` (
  `is_married` tinyint(4) NOT NULL DEFAULT '0',
  `pid1` int(10) unsigned NOT NULL DEFAULT '0',
  `pid2` int(10) unsigned NOT NULL DEFAULT '0',
  `love_point` int(11) DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid1`,`pid2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `messenger_list` (
  `account` varchar(14) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `companion` varchar(14) NOT NULL DEFAULT '',
  PRIMARY KEY (`account`,`companion`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `mob_proto` (
  `vnum` int(11) NOT NULL DEFAULT '0',
  `name` varchar(24) NOT NULL DEFAULT 'Noname',
  `locale_name` varbinary(24) NOT NULL DEFAULT 'Noname',
  `rank` tinyint(2) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `battle_type` tinyint(1) NOT NULL DEFAULT '0',
  `level` smallint(3) NOT NULL DEFAULT '1',
  `size` enum('SMALL','MEDIUM','BIG') NOT NULL DEFAULT 'SMALL',
  `ai_flag` set('AGGR','NOMOVE','COWARD','NOATTSHINSU','NOATTCHUNJO','NOATTJINNO','ATTMOB','BERSERK','STONESKIN','GODSPEED','DEATHBLOW','REVIVE') DEFAULT NULL,
  `mount_capacity` tinyint(2) NOT NULL DEFAULT '0',
  `setRaceFlag` set('ANIMAL','UNDEAD','DEVIL','HUMAN','ORC','MILGYO','INSECT','FIRE','ICE','DESERT') NOT NULL DEFAULT '',
  `setImmuneFlag` set('STUN','SLOW','FALL','CURSE','POISON','TERROR') NOT NULL DEFAULT '',
  `empire` tinyint(4) NOT NULL DEFAULT '0',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `on_click` tinyint(4) NOT NULL DEFAULT '0',
  `st` smallint(5) unsigned NOT NULL DEFAULT '0',
  `dx` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ht` smallint(5) unsigned NOT NULL DEFAULT '0',
  `iq` smallint(5) unsigned NOT NULL DEFAULT '0',
  `damage_min` smallint(5) unsigned NOT NULL DEFAULT '0',
  `damage_max` smallint(5) unsigned NOT NULL DEFAULT '0',
  `max_hp` int(10) unsigned NOT NULL DEFAULT '0',
  `regen_cycle` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `regen_percent` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `gold_min` int(11) NOT NULL DEFAULT '0',
  `gold_max` int(11) NOT NULL DEFAULT '0',
  `exp` int(10) unsigned NOT NULL DEFAULT '0',
  `def` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attack_speed` smallint(6) unsigned NOT NULL DEFAULT '100',
  `move_speed` smallint(6) unsigned NOT NULL DEFAULT '100',
  `aggressive_hp_pct` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `aggressive_sight` smallint(10) unsigned NOT NULL DEFAULT '0',
  `attack_range` smallint(5) unsigned NOT NULL DEFAULT '0',
  `drop_item` int(10) unsigned NOT NULL DEFAULT '0',
  `resurrection_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `enchant_curse` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enchant_slow` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enchant_poison` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enchant_stun` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enchant_critical` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enchant_penetrate` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `resist_sword` tinyint(4) NOT NULL DEFAULT '0',
  `resist_twohand` tinyint(4) NOT NULL DEFAULT '0',
  `resist_dagger` tinyint(4) NOT NULL DEFAULT '0',
  `resist_bell` tinyint(4) NOT NULL DEFAULT '0',
  `resist_fan` tinyint(4) NOT NULL DEFAULT '0',
  `resist_bow` tinyint(4) NOT NULL DEFAULT '0',
  `resist_fire` tinyint(4) NOT NULL DEFAULT '0',
  `resist_elect` tinyint(4) NOT NULL DEFAULT '0',
  `resist_magic` tinyint(4) NOT NULL DEFAULT '0',
  `resist_wind` tinyint(4) NOT NULL DEFAULT '0',
  `resist_poison` tinyint(4) NOT NULL DEFAULT '0',
  `dam_multiply` float DEFAULT NULL,
  `summon` int(11) DEFAULT NULL,
  `drain_sp` int(11) DEFAULT NULL,
  `mob_color` int(10) unsigned DEFAULT NULL,
  `polymorph_item` int(10) unsigned NOT NULL DEFAULT '0',
  `skill_level0` tinyint(3) unsigned DEFAULT NULL,
  `skill_vnum0` int(10) unsigned DEFAULT NULL,
  `skill_level1` tinyint(3) unsigned DEFAULT NULL,
  `skill_vnum1` int(10) unsigned DEFAULT NULL,
  `skill_level2` tinyint(3) unsigned DEFAULT NULL,
  `skill_vnum2` int(10) unsigned DEFAULT NULL,
  `skill_level3` tinyint(3) unsigned DEFAULT NULL,
  `skill_vnum3` int(10) unsigned DEFAULT NULL,
  `skill_level4` tinyint(3) unsigned DEFAULT NULL,
  `skill_vnum4` int(10) unsigned DEFAULT NULL,
  `sp_berserk` tinyint(4) NOT NULL DEFAULT '0',
  `sp_stoneskin` tinyint(4) NOT NULL DEFAULT '0',
  `sp_godspeed` tinyint(4) NOT NULL DEFAULT '0',
  `sp_deathblow` tinyint(4) NOT NULL DEFAULT '0',
  `sp_revive` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `monarch` (
  `empire` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned DEFAULT NULL,
  `user` varchar(30) COLLATE latin1_german1_ci NOT NULL,
  `windate` datetime DEFAULT NULL,
  `money` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`empire`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `monarch_candidacy` (
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `user` varchar(16) CHARACTER SET big5 DEFAULT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `windate` datetime DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `monarch_election` (
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `selectedpid` int(10) unsigned DEFAULT '0',
  `electiondata` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `myshop_pricelist` (
  `owner_id` int(11) unsigned NOT NULL DEFAULT '0',
  `item_vnum` int(11) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `list_id` (`owner_id`,`item_vnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_id` int(11) NOT NULL DEFAULT '0',
  `vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `map_index` int(11) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `x_rot` float NOT NULL DEFAULT '0',
  `y_rot` float NOT NULL DEFAULT '0',
  `z_rot` float NOT NULL DEFAULT '0',
  `life` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `object_proto` (
  `vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT '',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `materials` varchar(64) NOT NULL DEFAULT '',
  `upgrade_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `upgrade_limit_time` int(10) unsigned NOT NULL DEFAULT '0',
  `life` int(11) NOT NULL DEFAULT '0',
  `reg_1` int(11) NOT NULL DEFAULT '0',
  `reg_2` int(11) NOT NULL DEFAULT '0',
  `reg_3` int(11) NOT NULL DEFAULT '0',
  `reg_4` int(11) NOT NULL DEFAULT '0',
  `npc` int(10) unsigned NOT NULL DEFAULT '0',
  `group_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `dependent_group` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vnum`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `pcbang_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pcbang_id` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '000.000.000.000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`),
  KEY `pcbang_id` (`pcbang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(12) NOT NULL DEFAULT 'NONAME',
  `job` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `voice` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dir` tinyint(2) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `z` int(11) NOT NULL DEFAULT '0',
  `map_index` int(11) NOT NULL DEFAULT '0',
  `exit_x` int(11) NOT NULL DEFAULT '0',
  `exit_y` int(11) NOT NULL DEFAULT '0',
  `exit_map_index` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '0',
  `mp` int(11) NOT NULL DEFAULT '0',
  `stamina` smallint(6) NOT NULL DEFAULT '0',
  `random_hp` int(11) unsigned NOT NULL DEFAULT '0',
  `random_sp` int(11) unsigned NOT NULL DEFAULT '0',
  `playtime` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `level_step` tinyint(1) NOT NULL DEFAULT '0',
  `st` smallint(3) NOT NULL DEFAULT '0',
  `ht` smallint(3) NOT NULL DEFAULT '0',
  `dx` smallint(3) NOT NULL DEFAULT '0',
  `iq` smallint(3) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  `stat_point` smallint(3) NOT NULL DEFAULT '0',
  `skill_point` smallint(3) NOT NULL DEFAULT '0',
  `quickslot` tinyblob,
  `ip` varchar(16) DEFAULT '0.0.0.0',
  `part_main` smallint(6) NOT NULL DEFAULT '0',
  `part_base` tinyint(4) NOT NULL DEFAULT '0',
  `part_hair` smallint(4) NOT NULL DEFAULT '0',
  `skill_group` tinyint(4) NOT NULL DEFAULT '0',
  `skill_level` blob,
  `alignment` int(11) NOT NULL DEFAULT '0',
  `last_play` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `change_name` tinyint(1) NOT NULL DEFAULT '0',
  `mobile` varchar(12) DEFAULT '',
  `sub_skill_point` smallint(3) NOT NULL DEFAULT '0',
  `stat_reset_count` tinyint(4) NOT NULL DEFAULT '0',
  `horse_hp` smallint(4) NOT NULL DEFAULT '0',
  `horse_stamina` smallint(4) NOT NULL DEFAULT '0',
  `horse_level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `horse_hp_droptime` int(10) unsigned NOT NULL DEFAULT '0',
  `horse_riding` tinyint(1) NOT NULL DEFAULT '0',
  `horse_skill_point` smallint(3) NOT NULL DEFAULT '0',
  `orgname` varchar(12) NOT NULL DEFAULT 'NONAME',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `account_id_idx` (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `player_deleted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(12) NOT NULL DEFAULT 'NONAME',
  `job` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `voice` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dir` tinyint(2) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `z` int(11) NOT NULL DEFAULT '0',
  `map_index` int(11) NOT NULL DEFAULT '0',
  `exit_x` int(11) NOT NULL DEFAULT '0',
  `exit_y` int(11) NOT NULL DEFAULT '0',
  `exit_map_index` int(11) NOT NULL DEFAULT '0',
  `hp` smallint(4) NOT NULL DEFAULT '0',
  `mp` smallint(4) NOT NULL DEFAULT '0',
  `stamina` smallint(6) NOT NULL DEFAULT '0',
  `random_hp` smallint(5) unsigned NOT NULL DEFAULT '0',
  `random_sp` smallint(5) unsigned NOT NULL DEFAULT '0',
  `playtime` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `level_step` tinyint(1) NOT NULL DEFAULT '0',
  `st` smallint(3) NOT NULL DEFAULT '0',
  `ht` smallint(3) NOT NULL DEFAULT '0',
  `dx` smallint(3) NOT NULL DEFAULT '0',
  `iq` smallint(3) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  `stat_point` smallint(3) NOT NULL DEFAULT '0',
  `skill_point` smallint(3) NOT NULL DEFAULT '0',
  `quickslot` tinyblob,
  `ip` varchar(16) DEFAULT '0.0.0.0',
  `part_main` smallint(6) NOT NULL DEFAULT '0',
  `part_base` tinyint(4) NOT NULL DEFAULT '0',
  `part_hair` smallint(4) NOT NULL DEFAULT '0',
  `skill_group` tinyint(4) NOT NULL DEFAULT '0',
  `skill_level` blob,
  `alignment` int(11) NOT NULL DEFAULT '0',
  `last_play` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `change_name` tinyint(1) NOT NULL DEFAULT '0',
  `mobile` varchar(12) DEFAULT '',
  `sub_skill_point` smallint(3) NOT NULL DEFAULT '0',
  `stat_reset_count` tinyint(4) NOT NULL DEFAULT '0',
  `horse_hp` smallint(4) NOT NULL DEFAULT '0',
  `horse_stamina` smallint(4) NOT NULL DEFAULT '0',
  `horse_level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `horse_hp_droptime` int(10) unsigned NOT NULL DEFAULT '0',
  `horse_riding` tinyint(1) NOT NULL DEFAULT '0',
  `horse_skill_point` smallint(3) NOT NULL DEFAULT '0',
  `orgname` varchar(12) NOT NULL DEFAULT 'NONAME',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `account_id_idx` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `player_index` (
  `id` int(11) NOT NULL DEFAULT '0',
  `pid1` int(11) NOT NULL DEFAULT '0',
  `pid2` int(11) NOT NULL DEFAULT '0',
  `pid3` int(11) NOT NULL DEFAULT '0',
  `pid4` int(11) NOT NULL DEFAULT '0',
  `empire` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid1_key` (`pid1`),
  KEY `pid2_key` (`pid2`),
  KEY `pid3_key` (`pid3`),
  KEY `pid4_key` (`pid4`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `quest` (
  `dwPID` int(10) unsigned NOT NULL DEFAULT '0',
  `szName` varchar(32) NOT NULL DEFAULT '',
  `szState` varchar(64) NOT NULL DEFAULT '',
  `lValue` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dwPID`,`szName`,`szState`),
  KEY `pid_idx` (`dwPID`),
  KEY `name_idx` (`szName`),
  KEY `state_idx` (`szState`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `refine_proto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vnum0` int(10) unsigned NOT NULL DEFAULT '0',
  `count0` smallint(6) NOT NULL DEFAULT '0',
  `vnum1` int(10) unsigned NOT NULL DEFAULT '0',
  `count1` smallint(6) NOT NULL DEFAULT '0',
  `vnum2` int(10) unsigned NOT NULL DEFAULT '0',
  `count2` smallint(6) NOT NULL DEFAULT '0',
  `vnum3` int(10) unsigned NOT NULL DEFAULT '0',
  `count3` smallint(6) NOT NULL DEFAULT '0',
  `vnum4` int(10) unsigned NOT NULL DEFAULT '0',
  `count4` smallint(6) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `src_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `result_vnum` int(10) unsigned NOT NULL DEFAULT '0',
  `prob` smallint(6) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `safebox` (
  `account_id` int(10) unsigned NOT NULL DEFAULT '0',
  `size` tinyint(6) unsigned NOT NULL DEFAULT '0',
  `password` varchar(6) NOT NULL DEFAULT '',
  `gold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `shop` (
  `vnum` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT 'Noname',
  `npc_vnum` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `shop_class` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

CREATE TABLE IF NOT EXISTS `shop_item` (
  `shop_vnum` int(11) NOT NULL DEFAULT '0',
  `item_vnum` int(11) NOT NULL DEFAULT '0',
  `count` tinyint(4) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY `vnum_unique` (`shop_vnum`,`item_vnum`,`count`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `skill_proto` (
  `dwVnum` int(11) NOT NULL DEFAULT '0',
  `szName` varbinary(32) NOT NULL DEFAULT '',
  `bType` tinyint(4) NOT NULL DEFAULT '0',
  `bLevelStep` tinyint(4) NOT NULL DEFAULT '0',
  `bMaxLevel` tinyint(4) NOT NULL DEFAULT '0',
  `bLevelLimit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `szPointOn` varchar(100) NOT NULL DEFAULT '0',
  `szPointPoly` varchar(100) NOT NULL DEFAULT '',
  `szSPCostPoly` varchar(100) NOT NULL DEFAULT '',
  `szDurationPoly` varchar(100) NOT NULL DEFAULT '',
  `szDurationSPCostPoly` varchar(100) NOT NULL DEFAULT '',
  `szCooldownPoly` varchar(100) NOT NULL DEFAULT '',
  `szMasterBonusPoly` varchar(100) NOT NULL DEFAULT '',
  `szAttackGradePoly` varchar(100) NOT NULL DEFAULT '',
  `setFlag` set('ATTACK','USE_MELEE_DAMAGE','COMPUTE_ATTGRADE','SELFONLY','USE_MAGIC_DAMAGE','USE_HP_AS_COST','COMPUTE_MAGIC_DAMAGE','SPLASH','GIVE_PENALTY','USE_ARROW_DAMAGE','PENETRATE','IGNORE_TARGET_RATING','ATTACK_SLOW','ATTACK_STUN','HP_ABSORB','SP_ABSORB','ATTACK_FIRE_CONT','REMOVE_BAD_AFFECT','REMOVE_GOOD_AFFECT','CRUSH','ATTACK_POISON','TOGGLE','DISABLE_BY_POINT_UP','CRUSH_LONG') DEFAULT NULL,
  `setAffectFlag` enum('YMIR','INVISIBILITY','SPAWN','POISON','SLOW','STUN','DUNGEON_READY','FORCE_VISIBLE','BUILDING_CONSTRUCTION_SMALL','BUILDING_CONSTRUCTION_LARGE','BUILDING_UPGRADE','MOV_SPEED_POTION','ATT_SPEED_POTION','FISH_MIDE','JEONGWIHON','GEOMGYEONG','CHEONGEUN','GYEONGGONG','EUNHYUNG','GWIGUM','TERROR','JUMAGAP','HOSIN','BOHO','KWAESOK','MANASHIELD','MUYEONG','REVIVE_INVISIBLE','FIRE','GICHEON','JEUNGRYEOK') NOT NULL DEFAULT 'YMIR',
  `szPointOn2` varchar(100) NOT NULL DEFAULT 'NONE',
  `szPointPoly2` varchar(100) NOT NULL DEFAULT '',
  `szDurationPoly2` varchar(100) NOT NULL DEFAULT '',
  `setAffectFlag2` enum('YMIR','INVISIBILITY','SPAWN','POISON','SLOW','STUN','DUNGEON_READY','FORCE_VISIBLE','BUILDING_CONSTRUCTION_SMALL','BUILDING_CONSTRUCTION_LARGE','BUILDING_UPGRADE','MOV_SPEED_POTION','ATT_SPEED_POTION','FISH_MIDE','JEONGWIHON','GEOMGYEONG','CHEONGEUN','GYEONGGONG','EUNHYUNG','GWIGUM','TERROR','JUMAGAP','HOSIN','BOHO','KWAESOK','MANASHIELD') NOT NULL DEFAULT 'YMIR',
  `szPointOn3` varchar(100) NOT NULL DEFAULT 'NONE',
  `szPointPoly3` varchar(100) NOT NULL DEFAULT '',
  `szDurationPoly3` varchar(100) NOT NULL DEFAULT '',
  `szGrandMasterAddSPCostPoly` varchar(100) NOT NULL DEFAULT '',
  `prerequisiteSkillVnum` int(11) NOT NULL DEFAULT '0',
  `prerequisiteSkillLevel` int(11) NOT NULL DEFAULT '0',
  `eSkillType` enum('NORMAL','MELEE','RANGE','MAGIC') NOT NULL DEFAULT 'NORMAL',
  `iMaxHit` tinyint(4) NOT NULL DEFAULT '0',
  `szSplashAroundDamageAdjustPoly` varchar(100) NOT NULL DEFAULT '1',
  `dwTargetRange` int(11) NOT NULL DEFAULT '1000',
  `dwSplashRange` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dwVnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sms_pool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL DEFAULT '0',
  `sender` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `receiver` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `mobile` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `sent` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `msg` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sent_idx` (`sent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `string` (
  `name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `text` text CHARACTER SET latin1,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
