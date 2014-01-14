<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */

function createDbTables($tablesPrefix, $siteRootUrl, $language, $urlRewriting)
{

    $directoryOpeningDate = date("Y-m-d");

    $createTablesSql = "

CREATE TABLE `adcriterias` (
  `adCriterionId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `htmlContent` text NOT NULL,
  PRIMARY KEY (`adCriterionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `ads` (
  `adId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `adCriterionId` mediumint(8) unsigned NOT NULL,
  `page` varchar(64) NOT NULL,
  `place` varchar(64) NOT NULL,
  PRIMARY KEY (`adId`),
  KEY `adCriterionId` (`adCriterionId`),
  KEY `page` (`page`,`place`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `allopasscodes` (
  `code` char(8) NOT NULL,
  `ip` char(15) NOT NULL,
  `useDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `bannedemails` (
  `banId` mediumint(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `dateBanned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`banId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `bannedips` (
  `banId` mediumint(8) NOT NULL AUTO_INCREMENT,
  `remoteIp` varchar(15) NOT NULL,
  `dateBanned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`banId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `bannedsites` (
  `banId` mediumint(8) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) NOT NULL,
  `dateBanned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`banId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `bannedtags` (
  `banId` mediumint(8) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `dateBanned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`banId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `cachegoogledetails` (
  `cachePageRankID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(64) NOT NULL,
  `pageRank` tinyint(2) unsigned NOT NULL,
  `backlinksCount` int(11) unsigned NOT NULL,
  `indexedPagesCount` int(11) unsigned NOT NULL,
  `generationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cachePageRankID`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `captchacodes` (
  `publicCode` varchar(32) NOT NULL,
  `privateCode` varchar(4) NOT NULL,
  `generationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`publicCode`),
  KEY `generationDate` (`generationDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `categories` (
  `categoryId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parentCategoryId` mediumint(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `imageSrc` varchar(255) DEFAULT NULL,
  `possibleTender` enum('0','1') NOT NULL,
  `validatedSitesCount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forbidden` enum('0','1') NOT NULL DEFAULT '0',
  `urlName` varchar(128) NOT NULL,
  `navigationName` varchar(128) NOT NULL,
  `headerDescription` varchar(255) NOT NULL,
  `metaDescription` text NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `searchEngineSettings` text,
  PRIMARY KEY (`categoryId`),
  KEY `name` (`name`),
  KEY `parentCategoryId` (`parentCategoryId`,`position`),
  KEY `urlName` (`urlName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `categoryparents` (
  `parentId` mediumint(8) unsigned NOT NULL,
  `childId` mediumint(8) unsigned NOT NULL,
  `depth` tinyint(2) unsigned NOT NULL,
  KEY `childId` (`childId`,`depth`),
  KEY `parentId` (`parentId`,`depth`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `comments` (
  `commentId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `remoteIp` varchar(15) NOT NULL,
  `siteId` mediumint(8) unsigned NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  `validated` enum('0','1') NOT NULL DEFAULT '0',
  `rating` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`commentId`),
  KEY `siteId` (`siteId`,`remoteIp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `custommessages` (
  `messageId` varchar(20) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `userText` text NOT NULL,
  `userDefined` enum('0','1') NOT NULL DEFAULT '1',
  `type` enum('email','custom') NOT NULL DEFAULT 'email',
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `extrafieldcategories` (
  `categoryId` mediumint(8) unsigned NOT NULL,
  `fieldId` mediumint(8) unsigned NOT NULL,
  KEY `categoryId` (`categoryId`),
  KEY `fieldId` (`fieldId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `extrafieldoptions` (
  `fieldId` mediumint(8) unsigned NOT NULL,
  `value` smallint(5) unsigned NOT NULL,
  `label` varchar(128) NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldId`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `extrafields` (
  `fieldId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` enum('text','textarea','select','radio','checkbox','range','url','file') NOT NULL,
  `required` enum('0','1') NOT NULL,
  `description` text,
  `inSearchEngine` enum('0','1') NOT NULL DEFAULT '0',
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `suffix` varchar(128) DEFAULT NULL,
  `config` text,
  PRIMARY KEY (`fieldId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `extrafieldvalues` (
  `itemId` mediumint(8) unsigned NOT NULL,
  `fieldId` mediumint(8) unsigned NOT NULL,
  `value` smallint(5) unsigned DEFAULT NULL,
  `text` text,
  KEY `itemId` (`itemId`,`fieldId`),
  KEY `value` (`value`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `hits` (
  `hitId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `remoteIp` char(15) NOT NULL,
  `siteId` mediumint(8) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hitId`),
  KEY `siteId` (`siteId`,`remoteIp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `keywords` (
  `keywordId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(64) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`keywordId`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `keywordsofsites` (
  `keywordId` mediumint(8) unsigned NOT NULL,
  `siteId` mediumint(8) unsigned NOT NULL,
  KEY `siteId` (`siteId`),
  KEY `keywordId` (`keywordId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `newsletteremails` (
  `emailId` mediumint(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`emailId`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `otherreferrersites` (
  `referrerSiteId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `referrerTimes` mediumint(8) NOT NULL,
  PRIMARY KEY (`referrerSiteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `packages` (
  `packageId` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `allopassId` varchar(32) DEFAULT NULL,
  `allopassNumber` tinyint(4) DEFAULT NULL,
  `priority` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `imageSrc` varchar(64) DEFAULT NULL,
  `siteDescriptionMaxLength` int(11) NOT NULL DEFAULT '500',
  `maxKeywordsCountPerSite` tinyint(4) NOT NULL DEFAULT '5',
  `backLinkMandatory` enum('0','1') NOT NULL,
  `siteDescriptionHtmlEnabled` enum('0','1') NOT NULL,
  `siteDescriptionHtmlAllowedTags` text NOT NULL,
  `siteDescriptionHtmlAllowedCssProperties` text NOT NULL,
  `siteDescriptionMinLength` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`packageId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `paymentprocessors` (
  `processorId` varchar(32) NOT NULL,
  `displayName` varchar(64) NOT NULL,
  `active` enum('0','1') NOT NULL,
  `currency` char(3) NOT NULL,
  `testMode` enum('0','1') NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`processorId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `payments` (
  `paymentId` int(11) NOT NULL AUTO_INCREMENT,
  `processorId` varchar(64) NOT NULL,
  `packageId` mediumint(9) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `ip` char(15) NOT NULL,
  `userId` mediumint(9) unsigned DEFAULT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('unpaid','pending','paid','denied') NOT NULL DEFAULT 'unpaid',
  `used` enum('0','1') NOT NULL DEFAULT '0',
  `currency` char(3) NOT NULL,
  `siteId` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`paymentId`),
  KEY `userId` (`userId`),
  KEY `createDate` (`createDate`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `photos` (
  `photoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemId` mediumint(8) unsigned NOT NULL,
  `src` varchar(32) NOT NULL,
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tempId` varchar(32) DEFAULT NULL,
  `altText` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`photoId`),
  KEY `tempId` (`tempId`),
  KEY `itemId` (`itemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `refusals` (
  `moderatorId` mediumint(8) unsigned NOT NULL,
  `refusedSitesCount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `moderatorId` (`moderatorId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `rewrites` (
  `originalUrl` varchar(128) NOT NULL,
  `rewrittedUrl` varchar(128) NOT NULL,
  PRIMARY KEY (`originalUrl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `searchtags` (
  `tagId` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(128) NOT NULL,
  `searchTimes` int(11) NOT NULL DEFAULT '1',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagId`),
  KEY `tag` (`tag`),
  KEY `searchTimes` (`searchTimes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `settings` (
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `siteadditionalcategories` (
  `categoryId` mediumint(8) unsigned NOT NULL,
  `siteId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`categoryId`,`siteId`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `siteproblems` (
  `problemId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteId` mediumint(8) unsigned NOT NULL,
  `type` enum('spam','badCategory','other') NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`problemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `sites` (
  `siteId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteTitle` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visitsCount` int(11) NOT NULL DEFAULT '0',
  `votesAverage` float(10,1) NOT NULL DEFAULT '0.0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imageSrc` varchar(100) DEFAULT NULL,
  `problemExists` smallint(6) NOT NULL DEFAULT '0',
  `webmasterId` mediumint(8) NOT NULL DEFAULT '0',
  `status` enum('waiting','validated','banned') NOT NULL,
  `categoryId` mediumint(8) NOT NULL,
  `referrerTimes` int(11) NOT NULL DEFAULT '0',
  `proposalForKeywords` text,
  `proposalForCategory` text,
  `rssTitle` text NOT NULL,
  `returnBond` text NOT NULL,
  `priority` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `reversePriority` tinyint(4) NOT NULL DEFAULT '0',
  `webmasterEmail` text,
  `webmasterName` text,
  `moderatorId` mediumint(8) NOT NULL DEFAULT '0',
  `rssFeedOfSite` text NOT NULL,
  `votesCount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `commentsCount` mediumint(8) NOT NULL DEFAULT '0',
  `name` text,
  `httpCode` mediumint(3) unsigned DEFAULT NULL,
  `backlinkExists` enum('0','1') DEFAULT NULL,
  `countryCode` char(2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zipCode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `faxNumber` varchar(255) DEFAULT NULL,
  `packageId` mediumint(9) unsigned DEFAULT NULL,
  `siteType` enum('basic','premium') NOT NULL DEFAULT 'basic',
  `paymentProcessorName` varchar(64) DEFAULT NULL,
  `paymentStatus` enum('pending','paid','denied') DEFAULT NULL,
  `newsletterActive` enum('0','1') NOT NULL DEFAULT '0',
  `emailConfirmed` enum('0','1') NOT NULL DEFAULT '0',
  `lng` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `ascreen` enum('0','1') NOT NULL DEFAULT '0',
  `searchPartnership` enum('0','1') NOT NULL DEFAULT '0',
  `ip` varchar(15) DEFAULT NULL,
  `firstGalleryImageSrc` varchar(100) DEFAULT NULL,
  `photosCount` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `haveExtraFields` enum('0','1') NOT NULL DEFAULT '0',
  `haveKeywords` enum('0','1') NOT NULL DEFAULT '0',
  `pageRank` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `descriptionDisplayMethod` enum('text','html','htmlAdmin') NOT NULL DEFAULT 'text',
  `isDuplicateContent` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`siteId`),
  KEY `visitsCount` (`visitsCount`),
  KEY `votesAverage` (`votesAverage`,`votesCount`),
  KEY `pageRank` (`pageRank`),
  KEY `referrerTimes` (`referrerTimes`),
  KEY `webmasterId` (`webmasterId`),
  KEY `url` (`url`),
  KEY `categoryId` (`categoryId`,`status`,`reversePriority`,`creationDate`),
  KEY `status` (`status`,`creationDate`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `siteTitle` (`siteTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `tasks` (
  `taskId` varchar(32) NOT NULL,
  `status` enum('init','active','pause','stop','finish','next') NOT NULL DEFAULT 'active',
  `livePingTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `parsedItems` mediumint(8) NOT NULL DEFAULT '0',
  `totalItems` mediumint(8) NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  PRIMARY KEY (`taskId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `userId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role` varchar(32) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `verifications` (
  `code` varchar(32) NOT NULL,
  `itemId` varchar(32) NOT NULL,
  `type` enum('newsletterEmailAdd','newsletterEmailDel','userEmail','siteEmail') NOT NULL,
  `data` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`),
  KEY `itemId` (`itemId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `visits` (
  `ip` char(15) NOT NULL,
  `type` enum('ref','vis','tag') NOT NULL,
  `id` int(11) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `ts` (`ts`),
  KEY `ip` (`ip`,`id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

";

$dataSql = <<<SQL
INSERT INTO `custommessages` (`messageId`, `title`, `description`, `userText`, `userDefined`, `type`) VALUES
('validateSite', 'Your site is validated', 'Your site [site name] is validated in the category [name of the category].<br /><br />\r\n\r\nYou can see your site at this address <a href="[url site details]">See your site</a>.<br /><br />\r\n\r\nThank you for subbmited your site in our directory <a href="[url of your directory]">[name of directory]</a>', 'When you validate a site', '0', 'email'),
('refuseSite', 'Your site is rejected', 'Your site [site name] is rejected in the category [name of the category].<br />\r\nIt does not correspond to the criteria for listing in our directory.<br /><br />\r\n\r\nAfter modifying your site, do not hesitate to come to resubmit in our directory <a href="[url of your directory]">[name of directory]</a>.', 'For mail received by the webmaster if the site is refused', '0', 'email'),
('banSite', 'Your site is banned ', 'Your site [site name] is banned in our directory.<br /><br />\r\n\r\nThank you for subbmited your site in our directory <a href="[url of your directory]">[name of directory]</a>', 'For mail received by the webmaster if the site is banned', '0', 'email'),
('submitSite', 'A new website has just been submitted ', 'Information to the new site:<br />\r\nName: [site name]<br />\r\nURL: [url site]<br />\r\nDescription: [description of the site]<br />\r\nCategory: [name of the category]\r\n\r\n', 'Received by administrator the directory when a site is submitted', '0', 'email'),
('directoryDescription', 'Title description 1 for a better ranking in search engines if you want', 'description 1 for a better ranking in search engines if you want.', '', '0', 'custom'),
('directoryCondition', '', 'Regulation and condition of submission of websites. <br />\r\n<br />\r\n<br />\r\ndddd\r\n<br />\r\n<br />', '', '0', 'custom'),
('webmasterSubmitSite', 'Your site has been successfully submitted ', 'Information on your site:<br />\r\nName: [site name]<br />\r\nURL: [url site]<br />\r\nDescription: [description of the site]<br />\r\nYour site has been submitted in the category [name of the category]<br /><br />\r\n\r\nThank you for submitting your site in our directory <a href="[url of your directory]">[name of directory]</a>\r\n', 'Email received by the webmaster when he submitt a site', '0', 'email'),
('newsletterEmailAdd', 'Confirm your newsletter registration', 'Confirm your registration by clicking on the link below.<br /><br />\r\n\r\n<a href="[confirm link]">Confirm</a><br /><br />\r\n\r\n<a href="[url of your directory]">[name of directory]</a>\r\n', 'Email received by the user who add his email to newsletter', '0', 'email'),
('newsletterEmailDel', 'Confirm your newsletter unsubscribe', 'Confirm your unsubscribe by clicking on the link below.<br /><br />\r\n\r\n<a href="[confirm link]">Confirm your unsubscribe</a><br /><br />\r\n\r\n\r\n<a href="[url of your directory]">[name of directory]</a>\r\n', 'Email received by the user who delete his email from newsletter', '0', 'email'),
('siteEmail', 'Confirm submission of your site', 'To confirm the submission of your site, thank you to click on the link below.<br /><br />\r\n\r\n\r\n<a href="[confirm link]">Confirm your site submission</a><br /><br />\r\n\r\n\r\n<a href="[url of your directory]">[name of directory]</a>', 'Email received by the user who submit site and confirm email is ON.', '0', 'email'),
('userEmail', 'Confirm your registration', 'To confirm your registration, thank you to click on the link below<br /><br />\r\n\r\n<a href="[confirm link]">Confirm your registration</a><br /><br />\r\n\r\n<a href="[url of your directory]">[name of directory]</a>', 'Email received by the user who register to confirm his email.', '0', 'email'),
('newsletterFooter', '', '<br /><br />\r\n<a href="[unsubscribe link]">\r\nClick here to unsubscribe me\r\n</a>', 'Newsletter footer', '0', 'email'),
('newComment', 'New commment was posted in your directory', 'New commment was posted in your directory.<br /><br />\r\n\r\n<a href="[url of your directory]">[url of your directory]</a>', 'Emails recived when new comment was posted', '0', 'email'),
('newSiteProblem', 'New site problem was posted in your directory', 'New site problem was posted in your directory.<br /><br />\r\n\r\n<a href="[url of your directory]">[url of your directory]</a>', 'Emails recived when new site problem was posted', '0', 'email'),
('webmasterContact', 'Webmaster contact', 'A user want contact you<br /><br />\r\n\r\nHis message : [message]<br /><br />\r\n\r\nHis email <b>[sender email]<b/><br /><br />\r\nThank you, <a href="[url of your directory]">[name of directory]</a>\r\n\r\n', 'Webmaster contact', '0', 'email');


INSERT INTO `refusals` (`moderatorId`, `refusedSitesCount`) VALUES
(0, 0);

INSERT INTO `paymentprocessors` (`processorId`, `displayName`, `active`, `currency`, `testMode`, `email`) VALUES
('Allopass', 'Allopass', '0', 'EUR', '1', ''),
('PayPal', 'PayPal', '0', 'EUR', '1', '');


INSERT INTO `settings` (`key`, `value`) VALUES
('selectionPeriod', '1'),
('selectionSitesCount', '4'),
('selectionSiteIds', ''),
('selectionGenerationDate', ''),
('siteNoveltyPeriod', '30'),
('maxTopNotesCount', '20'),
('maxTopHitsCount', '20'),
('maxTopRankCount', '20'),
('maxTopReferrersCount', '20'),
('topReferrersLastResetDate', ''),
('sitesPerPageInCategory', '20'),
('sitesPerPageInKeywords', '20'),
('sitesPerPageInSearch', '20'),
('commentsEnabled', '0'),
('urlRewriting', '1'),
('notationsEnabled', '1'),
('hitsEnabled', '1'),
('topRankEnabled', '1'),
('topReferrersEnabled', '1'),
('categoriesImages', '1'),
('sitesImages', '1'),
('rssNewsEnabled', '0'),
('rssCategoriesEnabled', '0'),
('siteTitle', 'Arfooo directory title'),
('language', '$language'),
('countOfSubcategoriesUnderCategory', '2'),
('maxCategoriesCountPerSite', '1'),
('maxKeywordsCountPerSite', '5'),
('categoriesInLeftMenuEnabled', '1'),
('keywordsEnabled', '0'),
('cacheSiteImagesEnabled', '1'),
('deletionPeriodOfTopReferrers', '30'),
('registrationOfWebmastersEnabled', '0'),
('inscriptionsOfSitesEnabled', '1'),
('automaticSiteValidation', '0'),
('inscriptionCheckHttpResponseCode', '0'),
('sendEmailsOnInscriptionAndApproval', '1'),
('siteDescriptionMaxLength', '400'),
('metaTagScannerEnabled', '1'),
('informWebmastersForAdminDecisions', '1'),
('showingPagerankEnabled', '1'),
('showingBacklinksCountEnabled', '1'),
('showingIndexedPagesCountEnabled', '1'),
('wayForPagerankExtraction', '1'),
('pageRankCachingEnabled', '1'),
('pageRankCacheExpiration', '90'),
('statisticsEnabled', '1'),
('displayValidatedSitesCount', '1'),
('displayWaitingSitesCount', '1'),
('displayRefusedSitesCount', '1'),
('displayAllCategoriesCount', '1'),
('displayKeywordsCount', '1'),
('displayWebmastersCount', '1'),
('captchaEnabledOnWebmasterRegistration', '1'),
('captchaEnabledOnSiteInscription', '1'),
('captchaEnabledOnComments', '1'),
('captchaEnabledOnContactForm', '1'),
('additionalServerUrl', ''),
('siteRootUrl', '$siteRootUrl'),
('siteDescription', 'Arfooo directory description'),
('thumbsGeneratorUrl', ''),
('templateName', 'arfooo'),
('directoryOpeningDate', '$directoryOpeningDate'),
('dateFormat', 'd-m-Y'),
('automaticCommentValidation', '0'),
('backLinkMandatory', '0'),
('showRandomSitesInDetails', '1'),
('randomSitesInDetailsCount', '5'),
('randomSitesInDetailsDescriptionLength', '100'),
('minSiteDescriptionLength', '100'),
('rssSitesEnabled', '0'),
('countryFlagsEnabled', '0'),
('similarSiteKeywordMatch', '0'),
('googleMapEnabled', '0'),
('googleMapZoom', '3'),
('remoteRssParsingEnabled', '0'),
('companyInfoEnabled', '0'),
('sitesSortyBy', 'creationDate'),
('numberOfItemsForRssParsing', '5'),
('numberOfCharactersForRssParsing', '150'),
('numberOfCharactersForItemDescription', '120'),
('magpieRssCacheMaxAgeDays', '1'),
('availableSiteTypes', 'basic'),
('numberOfTagInTagCloud', '10'),
('minNumberOfTagInTagCloud', '2'),
('tagCloudEnabled', '0'),
('backLinkHtmlCode1Enabled', '1'),
('backLinkHtmlCode2Enabled', '1'),
('backLinkHtmlCode1Text', ''),
('backLinkHtmlCode1Url', ''),
('backLinkHtmlCode2Text', ''),
('firstGalleryImageForThumbEnabled', '1'),
('maxNewsCount', '20'),
('displayBannedSitesCount', '1'),
('newsletterEnabled', '1'),
('emailConfirmationEnabled', '0'),
('allCategoriesPageEnabled', '1'),
('contactPageEnabled', '1'),
('ascreenEnabled', '0'),
('informWebmastersForAdminValidateDecision', '1'),
('informWebmastersForAdminRefuseDecision', '1'),
('informWebmastersForAdminBanDecision', '1'),
('sendEmailsOnComment', '1'),
('sendEmailsOnSiteProblem', '1'),
('advancedSearchEnabled', '1'),
('searchEngineLikeMethodEnabled', '1'),
('searchEngineWordDefaultOperator', 'AND'),
('urlMandatory', '0'),
('itemGalleryImagesMaxCount', '10'),
('itemGalleryImageMaxWeight', '1000'),
('mediumThumbWidth', '220'),
('mediumThumbHeight', '165'),
('smallThumbWidth', '120'),
('smallThumbHeight', '90'),
('microThumbWidth', '60'),
('microThumbHeight', '45'),
('imageWatermarkEnabled', '0'),
('searchEngineSearchIn', 'siteTitle|description|url'),
('supportedUrlSchemes', 'http'),
('searchEngineLikeMethodWordMinLength', '2'),
('searchEngineLikeMethodWordMaxLength', '3'),
('partnershipSearchingEnabled', '1'),
('itemGalleryImagesEnabled', '0'),
('advancedUrlRewritingEnabled', '1'),
('httpGzipCompressionEnabled', '0'),
('maxSubpagesCountPerSite', '1'),
('templateCompileCheckEnabled', '1'),
('templateWhiteSpaceFilterEnabled', '1'),
('referrersSavingEnabled', '1'),
('siteDetailsCacheEnabled', '0'),
('watermarkImageSrc', ''),
('imageWatermarkPosition', 'b,l'),
('siteDetailsCacheLifeTime', '3600'),
('advancedUrlRewritingParentsEnabled', '1'),
('errorHandlerSaveToFileEnabled', '1'),
('errorHandlerDisplayErrorEnabled', '1'),
('newsEnabled', '1'),
('sitesInParentCategoriesEnabled', '0'),
('siteDescriptionHtmlEnabled', '0'),
('siteDescriptionHtmlAllowedTags', 'a[href|title|target], br, b, p, ul, ol, li, table[cellspacing|cellpadding|border], tbody, tr, td[colspan|rowspan], strong, span, em, *[style], *[class], img[src]'),
('siteDescriptionHtmlAllowedCssProperties', 'text-align, color, background-color, font-family, font-size, border, text-decoration, padding-left, height, width, font-weight'),
('campaignFilters', ''),
('siteDescriptionHtmlEnabledAdmin', '0'),
('siteDescriptionHtmlAllowedTagsAdmin', 'a[href|title|target], br, b, p, ul, ol, li, table[cellspacing|cellpadding|border], tbody, tr, td[colspan|rowspan], strong, span, em, *[style], *[class], img[src]'),
('siteDescriptionHtmlAllowedCssPropertiesAdmin', 'text-align, color, background-color, font-family, font-size, border, text-decoration, padding-left, height, width, font-weight'),
('duplicateContentCheckerEnabled', '0'),
('duplicateContentCheckerPhrasesToCheckCount', '3'),
('duplicateContentCheckerWordsInPhraseCount', '6'),
('duplicateContentCheckerAllowableDuplicatedPhrasesCount', '0');

SQL;

     $tableStats = array();

     foreach(explode(";", $createTablesSql) as $sql)
     {
        $sql = trim($sql);
        if(empty($sql))continue;
        preg_match("#CREATE TABLE `(.*?)`#", $sql, $match);
        $tableName = $match[1];

        if(executeQueryWithPrefix($sql, $tablesPrefix))
        {
            $message = "";
            $created = true;
        }
        else
        {
            $message = mysql_error();
            $created = false;
        }

        $tableStats[$tableName]['message'] = $message;
        $tableStats[$tableName]['created'] = $created;
    }

    foreach(explode(";", $dataSql) as $sql)
    {
        executeQueryWithPrefix($sql, $tablesPrefix);
    }

    return $tableStats;

}

?>
