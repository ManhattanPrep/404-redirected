<?php
/*
Plugin Name: 404 Redirected - Manhattan Prep Fork
Plugin URI: http://www.weberz.com/plugins/404-redirected/
Original URI: https://github.com/ManhattanPrep/404-redirected
Description: Improvements and modifications made to weberz's (rrolfe) 404 Redirected Plugin.
Version: 1.4 Forked @ 1.3.2
Author: Manhattan Prep
Author URI: http://www.manhattanprep.com
Original Plugin URI: http://www.weberz.com/plugins/404-redirected/
Original Author: Weberz Hosting
Original Author URI: http://www.weberz.com

Copyright 2009  Weberz Hosting  (email: rob@weberz.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Constants
define('WBZ404_URL', plugin_dir_url(__FILE__) );
define('WBZ404_PATH', plugin_dir_path(__FILE__) );
define('WBZ404_NAME', plugin_basename( __FILE__ ) );
define('WBZ404_VERSION', '1.3.2');
define('WBZ404_HOME', 'http://www.weberz.com/plugins/404-redirected/');
define('WBZ404_TRANS', 'wbz404_redirected');

//URL Types
define('WBZ404_MANUAL', 1);
define('WBZ404_AUTO', 2);
define('WBZ404_CAPTURED', 3);
define('WBZ404_IGNORED', 4);

//Redirect Types
define('WBZ404_POST', 1);
define('WBZ404_CAT', 2);
define('WBZ404_TAG', 3);
define('WBZ404_EXTERNAL', 4);

require WBZ404_PATH."includes/functions.php";
require WBZ404_PATH."includes/frontend.php";
if (is_admin()) {
	require WBZ404_PATH."includes/admin.php";
}
?>
