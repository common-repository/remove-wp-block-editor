<?php
	/****************************
		* Scripts Control
	****************************/
	
	if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>') && !class_exists('rwbe_wpblock_editor')) {
		
		class rwbe_wpblock_editor {
			function __construct() {
				
				global $rwbe_foo;
				if(isset($rwbe_foo['rwbe_removeall']) && !(isset($rwbe_foo['rwbe_dashboard']))){
					add_filter('use_block_editor_for_post', '__return_false', 10);
					add_filter('use_block_editor_for_post_type', '__return_false', 10);
				}
				
				if(!(isset($rwbe_foo['rwbe_removeall'])) && isset($rwbe_foo['rwbe_dashboard'])){
					$this->rwbe_dashboard_remove();
				}
				
				if(isset($rwbe_foo['rwbe_removeall']) && isset($rwbe_foo['rwbe_dashboard'])){
					add_filter('use_block_editor_for_post', '__return_false', 10);
					add_filter('use_block_editor_for_post_type', '__return_false', 10);
					$this->rwbe_dashboard_remove();
				}
				if(isset($rwbe_foo['rwbe_cpt'])){
					$this->rwbe_cpt_remove();
				}
			}
			
			
			public function rwbe_dashboard_remove()
			{
				remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
			}
			public function rwbe_cpt_remove()
			{
				/*
					* Remove new wp block editor for all the post types except post
				*/
				
				if(isset($rwbe_foo['rwbe_cpt'])){
					function rwbe_can_edit_post_type( $can_edit, $post_type ) {
						$gutenberg_supported_types = array( 'post' );
						if ( ! in_array( $post_type, $gutenberg_supported_types, true ) ) {
							$can_edit = false;
						}
						return $can_edit;
					}
					add_filter( 'gutenberg_can_edit_post_type', 'rwbe_can_edit_post_type', 10, 2 );
				}
			}
		}
		$rwbe_disableGutenberg = new rwbe_wpblock_editor(); 
		
	}
?>