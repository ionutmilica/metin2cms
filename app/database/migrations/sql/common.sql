CREATE TABLE IF NOT EXISTS `gmlist` (
  `mID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mAccount` varchar(16) NOT NULL DEFAULT '',
  `mName` varchar(16) NOT NULL DEFAULT '',
  `mContactIP` varchar(16) NOT NULL DEFAULT '',
  `mServerIP` varchar(16) NOT NULL DEFAULT 'ALL',
  `mAuthority` enum('IMPLEMENTOR','HIGH_WIZARD','GOD','LOW_WIZARD','PLAYER') DEFAULT 'PLAYER',
  PRIMARY KEY (`mID`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii;