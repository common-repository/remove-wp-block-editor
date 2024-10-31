<?php
	
	add_action( 'admin_menu', 'rwbe_mymenu' );
	add_action( 'admin_init', 'rwbe_mymenu_init' );
	
	
	function rwbe_mymenu () { 
		
		add_menu_page( __( 'Remove Block Editor', 'rwbe' ), __( 'Remove Editor', 'rwbe' ), 'manage_options', 'rwbe', 'rwbe_options_page', 'dashicons-tickets-alt' );
		
	}
	
	
	function rwbe_mymenu_init() { 
		//registering three groups for three sections
		
		register_setting('rwbe_onez', 'rwbe_onez');
		
		add_settings_section(
		'rwbe_settings_section', 
		__( 'Disable Block Editor', 'rwbe' ), 
		'rwbe_onez_section_callback', 
		'rwbe_onez'
		);
		
		add_settings_field( 
		'rwbe_removeall', 
		__( 'Disable WP block editor completely', 'rwbe' ), 
		'rwbe_removeall_render',
		'rwbe_onez', 
		'rwbe_settings_section' 
		);
		
		add_settings_field( 
		'rwbe_dashboard', 
		__( 'Remove the try WP new block editor panel from the dashboard', 'rwbe' ), 
		'rwbe_dashboard_render', 
		'rwbe_onez', 
		'rwbe_settings_section' 
	    );
		
		add_settings_field( 
		'rwbe_cpt', 
		__( 'Disable WP block editor for all custom post types except posts', 'rwbe' ), 
		'rwbe_cpt_render', 
		'rwbe_onez', 
		'rwbe_settings_section' 
		);
		//second sections
		add_settings_section(
		'rwbe_contactus_section', 
		__( 'Contact Us', 'rwbe' ), 
		'rwbe_twoz_section_callback', 
		'rwbe_twoz'
		);
		$rwbe_dir = plugin_dir_path( __FILE__ );
		include($rwbe_dir.'rwbe-scripts.php');
	} // end of sections initialisations
	
	// First Section Callback
	function rwbe_onez_section_callback(  ) { 
		
		echo __( 'Here you can disable WP block editor and enable wp classic editor', 'rwbe' );
		
	}
	
	
	
	//Second Section Callback
	function rwbe_twoz_section_callback() {
		echo __('We can be reached through email, skype or phone below are the details','rwbe');
	?>
	<h3> Email : zeeshanaslamdurrani@gmail.com </h3>
	<h3> Skype Id: zeeshanaslamdurrani1 </h3>
	<h3> Phone   : +92 3345603647 <//h3>
	<?php
	}
	
	///Section rwbe_onez First field
	function rwbe_removeall_render(  ) 
	{ 
		
		$options = get_option( 'rwbe_onez',false );
		if ( ! isset( $options['rwbe_removeall'] )  )
		$options['rwbe_removeall'] = 0;
	?>
	<input type='checkbox' name='rwbe_onez[rwbe_removeall]' <?php checked( $options['rwbe_removeall'], 1 ); ?> value='1'>
	<?php
	} // end of first field 
	
	
	function rwbe_dashboard_render(  ) { 
		
		$options = get_option( 'rwbe_onez', false );
		if ( ! isset( $options['rwbe_dashboard'] )  )
		$options['rwbe_dashboard'] = 0;
	?>
	<input type='checkbox' name='rwbe_onez[rwbe_dashboard]' <?php checked( $options['rwbe_dashboard'], 1 ); ?> value='1'>
	<?php
		
	}
	
	
	function rwbe_cpt_render() { 
		$options = get_option( 'rwbe_onez', false );
		if ( ! isset( $options['rwbe_cpt'] )  )
		$options['rwbe_cpt'] = 0;
	?>
	<input type='checkbox' name='rwbe_onez[rwbe_cpt]' <?php checked( $options['rwbe_cpt'], 1 ); ?> value='1'>
	<?php	
		
	}
	
	//RENDER OPTIONS PAGE
	function rwbe_options_page() { 
		
	ob_start();?>
	<div class="wrap">
		<h2>Disable WP Block Editor</h2>
		
		<div id="icon-themes" class="icon32"></div>  
		<?php settings_errors(); ?>  
		
		<?php  
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'Settings';  
		?>  
		
		
		<h2 class="nav-tab-wrapper">  
			<a href="?page=rwbe&tab=Settings" class="nav-tab <?php echo $active_tab == 'Settings' ? 'nav-tab-active' : ''; ?>">Settings</a>  
			<a href="?page=rwbe&tab=Contact_Us" class="nav-tab <?php echo $active_tab == 'Contact_Us' ? 'nav-tab-active' : ''; ?>">Contact Us</a>
		</h2>  
		<form action='options.php' method='post'>
			
			<?php
				
				
				if( $active_tab == 'Settings' ) {
					settings_fields( 'rwbe_onez' );
					do_settings_sections( 'rwbe_onez' );
					
				}
				elseif ( $active_tab == 'Contact_Us' )
				{
					settings_fields('rwbe_twoz');
					do_settings_sections('rwbe_twoz');
				}
				
				submit_button();
			?>
			
		</form>
	</div>	
	
	<?php echo ob_get_clean();?>
	<?php
	}
?>