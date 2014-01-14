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

$rewrites = array(
// TOP- PAGES
'#^/top-notes.html$#' => '/site/topNotes',
'#^/top-hits.html$#' => '/site/topHits',
'#^/top-referrers.html$#' => '/site/topReferrers', 
'#^/top-rank.html$#' => '/site/topRank',
'#^/top-rank-([0-9]+).html$#' => '/site/topRank/\1',

// WEBMASTER PAGES
'#^/webmaster-submit-website.html$#' => '/webmaster/submitWebsite',
'#^/webmaster-login.html$#' => '/webmaster/logIn',
'#^/webmaster-lost-password.html$#' => '/webmaster/lostPassword',
'#^/webmaster-change-password.html$#' => '/webmaster/changePassword',
'#^/webmaster-management.html$#' => '/webmaster/manage',
'#^/webmaster-logoff.html$#' => '/webmaster/logoff',
'#^/webmaster-delete-site-([0-9]+).html$#' => '/webmaster/deleteSite/\1',
'#^/webmaster-edit-site-([0-9]+).html$#' => '/webmaster/editSite/\1',

// SITE DETAILS PAGE
'#^/(.*)-s([0-9]+).html$#' => '/site/details/\2/\1',

// INDEX PAGE
'#^/index.html$#' => '/index.php',

// CONTACT FORM
'#^/contact.html$#' => '/contact',

// NEWS PAGE
'#^/nouveautes.html$#' => '/site/news',

// ALL CATEGORIES PAGE
'#^/allcategories.html$#' => '/category/showAll',

// RSS FLUX NEWS
'#^/rss-nouveautes.xml$#' => '/rss/news',

// RSS FLUX CATEGORY
'#^/rss-c([0-9]+).xml$#' => '/rss/category/\1',

// RSS FLUX Site
'#^/rss-s([0-9]+).xml$#' => '/rss/site/\1',

// VOTE FORM
'#^/vote_s([0-9]+).html$#' => '/vote/popup/\1',

// COMMENT FORM
'#^/comment_s([0-9]+).html$#' => '/comment/popup/\1',

// PROBLEM REPORTING FORM
'#^/problem_reporting_s([0-9]+).html$#' => '/site/problemPopup/\1',

// KEYWORDS
'#^/mots-([A-Z0-9]).html$#' => '/keyword/show/\1',
'#^/mots-(.*)-m([0-9]+)-p([0-9]+).html$#' => '/site/keyword/\2/\1/\3',

// SEARCH
//'#^/search-p([0-9]+).html$#' => '/site/search/\1',

'#^/webmaster-submit-off.html$#' => '/webmaster/submitDisabled',
'#^/tag-(.*)-t([0-9]+)-p([0-9]+).html$#' => '/site/tag/\2/\1/\3',
'#^/webmaster-choose-method.html$#' => '/webmaster/chooseSiteType',
'#^/payment-select-payment-options.html$#' => '/payment/selectPaymentOptions',
'#^/payment-make-payment.html$#' => '/payment/makePayment',
'#^/payment-process-payment.html$#' => '/payment/processPayment',
'#^/webmaster-submit-website-free.html$#' => '/webmaster/submitWebsite/basic',
'#^/webmaster-submit-website-privileged.html$#' => '/webmaster/submitWebsite/premium',
'#^/webmaster-loading.html$#' => '/webmaster/loading',

// CATEGORIES PAGE
'#^/(.*)-c([0-9]+)-p([0-9]+).html$#' => '/site/category/\2/\1/\3'
);

$reverseRewrites = array (
  '#^/category/showAll$#' => '/allcategories.html',
  '#^/comment/popup/(.*)$#' => '/comment_s\1.html',
  '#^/contact$#' => '/contact.html',
  '#^/index.php$#' => '/index.html',
  '#^/keyword/show/(.*)$#' => '/mots-\1.html',
  '#^/rss/category/(.*)$#' => '/rss-c\1.xml',
  '#^/rss/site/(.*)$#' => '/rss-s\1.xml',
  '#^/rss/news$#' => '/rss-nouveautes.xml',
  '#^/site/details/(.*?)/(.*)$#' => '/\2-s\1.html',
  '#^/site/keyword/(.*?)/(.*?)/(.*)$#' => '/mots-\2-m\1-p\3.html',
  '#^/site/news$#' => '/nouveautes.html',
  '#^/site/problemPopup/(.*)$#' => '/problem_reporting_s\1.html',
  '#^/site/topHits$#' => '/top-hits.html',
  '#^/site/topNotes$#' => '/top-notes.html',
  '#^/site/topRank$#' => '/top-rank.html',
  '#^/site/topRank/(.*)$#' => '/top-rank-\1.html',
  '#^/site/topReferrers$#' => '/top-referrers.html',
  '#^/vote/popup/(.*)$#' => '/vote_s\1.html',
  '#^/webmaster/deleteSite/(.*)$#' => '/webmaster-delete-site-\1.html',
  '#^/webmaster/editSite/(.*)$#' => '/webmaster-edit-site-\1.html',
  '#^/webmaster/logIn$#' => '/webmaster-login.html',
  '#^/webmaster/logoff$#' => '/webmaster-logoff.html',
  '#^/webmaster/lostPassword$#' => '/webmaster-lost-password.html',
  '#^/webmaster/changePassword$#' => '/webmaster-change-password.html',
  '#^/webmaster/manage$#' => '/webmaster-management.html',
  '#^/webmaster/submitWebsite$#' => '/webmaster-submit-website.html',
  '#^/webmaster/submitDisabled$#' => '/webmaster-submit-off.html',
  '#^/site/tag/(.*?)/(.*?)/(.*)$#' => '/tag-\2-t\1-p\3.html',
  '#^/webmaster/chooseSiteType$#' => '/webmaster-choose-method.html',
  '#^/webmaster/submitWebsite/basic$#' => '/webmaster-submit-website-free.html',
  '#^/webmaster/submitWebsite/premium$#' => '/webmaster-submit-website-privileged.html',
  '#^/webmaster/loading$#' => '/webmaster-loading.html',
  '#^/payment/selectPaymentOptions$#' => '/payment-select-payment-options.html',
  '#^/payment/makePayment$#' => '/payment-make-payment.html',
  '#^/payment/processPayment$#' => '/payment-process-payment.html'
);

if(Config::get("advancedUrlRewritingEnabled"))
{
    $reverseRewrites += array('#^/site/category/(.*?)/(.*?)/1$#' => '/\2/',   
                                   '#^/site/category/(.*?)/(.*?)/(.*)$#' => '/\2-p\3/');
}
else
{
    $reverseRewrites += array('#^/site/category/(.*)/(.*)/(.*)$#' => '/\2-c\1-p\3.html');
}
