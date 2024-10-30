
File: Wordpress Breadcrumb Navigator Plugin 0.1 (Beta)
License: GNU/GPL (http://www.gnu.org/licenses/gpl.txt)
Date: January 18 2006
Author: Michael Stepanov
Email: stepanov.michael@gmail.com
Website: http://stepanoff.org

---------------------------------------------------------


Description:

  Generates a menu with parent pages according to current one a.k.a 'Breadcrumb menu'.

Installation:
	(1) Unzip archive with Breadcrumb Navigator plugin.
	
  	(2) Copy 'breadcrumb_menu.php' to your /wp-content/plugins folder.
  	
	(3) Activate the plugin via admin interface. 
  
  	(4) Add the following to your theme's page.php right after content div
	starts before page title:
   		
		<?php build_pages_navigation(); ?>

Important Notes:

  (1) Tested on wordpress version 1.5

------------------------------------------------------------------------

Changelog:

0.2 Jan 23 2006
	- fixed a bug with getting page ID in case of using permalinks.

0.1 Jan 18 2006
 	- initial release of Breadcrumb Navigator plugin.
