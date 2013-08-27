<?php

define('DS', 'DIRECTORY_SEPERATOR');
define('SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'acct_lite');
define('LIB_PATH', SITE_ROOT.DS.'inc');

require_once ('database.class.php');
require_once ('databaseObject.class.php');
require_once ('budget.class.php');
require_once ('category.class.php');
require_once ('tag.class.php');
require_once ('item.class.php');
require_once ('user.class.php');
require_once ('session.class.php');
require_once ('email.class.php');
require_once ('overheadItem.class.php');
require_once ('overheadSplit.class.php');
