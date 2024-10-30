<?php   
/*

Plugin Name: Breadcrumb Navigator
Plugin URI: http://stepanoff.org/
Description: This plugin builds Breadcrumb Navigation menu of pages related with current one.
Author: Michael Stepanov
Version: 0.02
Author URI: http://stepanoff.org


Copyright 2006  Michael Stepanov (email: stepanov.michael.@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
ut WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.


*/

//
// Build an array which contains a list of all parent pages for current one.
// No any input parameters needed
//
function get_list_page_parents() {
	global $page_id, $wp_query, $id;

	if(!$page_id)
		$page_id = $id;
	
	if(!$page_id && is_page()) {

		$page_id = $wp_query->post->post_ID;
	}
	
	$current_page = $page_id;
	
	$page_list = array();
	
	while(has_parent($page_id)) {
		$page = get_page($page_id);
		
		$page_list[] = array(	'title' => $page->post_title, 
								'link' 	=> $page_id == $current_page ? '' : get_page_link($page_id), 
								'id' 	=> $page_id);
		$page_id = $page->post_parent;
	}
	
	return $page_list;	
}

//
// Pass page ID as parameter. Return a parent page ID for specified one. 
//
function get_parent($id) {
	$page = get_page($id);
	return $page->post_parent;
}

//
// Check if parent page exists for specified ID.
//
function has_parent($id) {
	$page = get_page($id);

	return $page->post_parent ? $page->post_parent : $page->ID;
}

//
// Build HTML presentation of breadcrumb navigation
//
function build_pages_navigation () {	
	$list_pages = get_list_page_parents();		

	$menu = "<a href=" . get_settings('home') .">Home</a>";

	foreach(array_reverse($list_pages) as $item) {

	/*
		<img src="<?php echo get_theme_root_uri(); ?>/<?php echo get_current_theme(); ?>/images/delimiter.jpg">

		TODO: Add possibility to display some specified image as menu items delimiter.
	*/	
	
		$menu .= "&nbsp;&gt;&nbsp";
		
		if($item['link']) {
			$menu .= '<a href="' . $item["link"] .'">' . $item["title"] . '</a>';
		} else { 	
			$menu .= $item["title"]; 
		}
	}
}

//
// Add CSS items to display breadcrumb menu
//
function breadcrumb_css() {
	print <<<END
	<style type='text/css'>

	.page_navigation {
		padding: 5px;
	}

	.page_navigation img {
		padding: 0 7px;
	}
	</style>
END;

}

//
// Include CSS to the WP header
// TODO: Add filter to display breadcrumb menu without changing a page template!
//
add_action('wp_head', 'breadcrumb_css');

?>
