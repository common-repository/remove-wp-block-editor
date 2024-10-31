<?php
	/*
		Plugin Name: Remove WP Block Editor
		Plugin URI:https://wordpresshowtos.blogspot.com/2019/05/remove-wp-block-editor.html
		Description: A plugin to remove wp new block editor from pages and posts
		Author: Zeeshan Aslam Durrani
		Version: 1.0
		Author URI: https://wordpresshowtos.blogspot.com
		Text Domain: remove-wp-block-editor
		Domin Path: Languages
		License: GPLV2
		
		Copyright 2015 ZEESHANASLAMDURRANI (email : zeeshanaslamdurrani@gmail.com)
		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
		GNU General Public License for more details.
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
	*/
	
	/*******************
		* Global Variables 
	*******************/
	
	$rwbe_prefix = 'rwbe';
	$rwbe_plugin_name = 'Remove Block Editor Editor';
	global $rwbe_foo;
	$rwbe_foo = get_option( 'rwbe_onez' );
	
	
	/*******************
		* includes 
	*******************/
	
	$dir = plugin_dir_path( __FILE__ );
	include($dir.'includes/rwbe-options-page.php'); // this page 
	
	/**********************
	    * Add settings page
	**********************/
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'rwbe_add_plugin_page_settings_link');
	
	function rwbe_add_plugin_page_settings_link( $links ) {
		$links[] = '<a href="' .
		admin_url( 'options-general.php?page=rwbe' ) .
		'">' . __('Settings') . '</a>';
		return $links;
	}
	
	/*****************
		* Translation
	******************/
	
	load_plugin_textdomain('remove-wp-block-editor', false, basename(dirname( __FILE__ ) ) . '/languages' );
	
	
	
	
?>
