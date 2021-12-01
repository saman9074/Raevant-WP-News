<?php

/*
 *
 * add menu item in admin
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	function CPW_Admin_Add_Menu() {
		add_menu_page
		(
			__('Raevant Blog App','RBAPP'),
			__('Raevant Blog App','RBAPP'),
			'manage_options',
			'RBAPP_Settings',
			'RBAPP_Admin_Menu_General_CallBack'
		);
		add_submenu_page(
			'RBAPP_Settings',
			__('Send Notification','RBAPP'),
			__('Send Notification','RBAPP'),
			'manage_options',
			'RBAPP_Notification_Links',
			'RBAPP_Admin_Menu_Notification_CallBack'
		);

        add_submenu_page(
			'RBAPP_Settings',
			__('Categories','RBAPP'),
			__('Categories','RBAPP'),
			'manage_options',
			'RBAPP_Categories',
			'RBAPP_Admin_Menu_Categories_CallBack'
		);

        add_submenu_page(
			'RBAPP_Settings',
			__('Settings','RBAPP'),
			__('Settings','RBAPP'),
			'manage_options',
			'RBAPP_Settings',
			'RBAPP_Admin_Menu_General_CallBack'
		);
		
	}


	function RBAPP_Admin_Menu_General_CallBack() {
		// require_once CPW_INC . 'admin/api/coinmarketcap.php';
		 wp_enqueue_style( 'RBAPP_style_admin' );
		 if ( isset( $_POST['saveSettings'] ) ) {
		 	var_dump($_POST);
		 
		 	$apiProvider = $_POST['api_provider'];
		 	$apiKey      = $_POST['apikey'];
		 	$NewPostNotifState     = $_POST['RBAPP_npn'];
		 	$UpdatePostNotifState     = $_POST['RBAPP_upn'];		
			update_option( 'RBAPP_api_provider', $apiProvider );
			update_option( 'RBAPP_apikey', $apiKey );
			update_option( 'RBAPP_npn', $NewPostNotifState );
			update_option( 'RBAPP_upn', $UpdatePostNotifState );
		 	echo '<div class="RBAPP_success">'.__('Settings Saved!','RBAPP').'</div>';
		}
		define( 'RBAPP_SETTING_DATA_New',
			[
				'1' => get_option( 'RBAPP_api_provider' ),
				'2' => get_option( 'RBAPP_apikey' ),
				'3' => get_option( 'RBAPP_npn' ),
				'4' => get_option( 'RBAPP_upn' )
			]
		);
		require_once Rapp_PLUGIN_PATH . 'admin/template/settings.php';
	}

	add_action( 'admin_menu', 'CPW_Admin_Add_Menu' );


	function CPW_getCryptoNameFromDB( $symbol ) {
		global $wpdb;
		$CPW_Result_Crypto = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "crypto_price_shortcode WHERE symbol = '" . $symbol . "'" );

		return $CPW_Result_Crypto->cryptoname;
	}

	function CPW_Admin_Menu_Links_CallBack() {
		global $wpdb;
		wp_enqueue_style( 'cpw_style_admin' );
		if ( isset( $_POST['saveSettings'] ) ) {
			//var_dump($_POST);
			$CPW_Type         = $_POST['type'];
			$CPW_Coin_Splited = explode( ",", CPW_SETTING_DATA['3'] );
			foreach ( $CPW_Coin_Splited as $CPW_coin ) {
				$CPW_coin       = strtoupper( $CPW_coin );
				$coinNameSymbol = CPW_getCryptoNameFromDB( $CPW_coin );
				$table_name     = $wpdb->base_prefix . 'crypto_price_shortcode';
				if ( $CPW_Type == "Coinmarketcap" ) {
					$wpdb->update( $table_name,
						array( 'redirect_links' => 'https://coinmarketcap.com/currencies/' . $coinNameSymbol ),
						array( 'symbol' => $CPW_coin )
					);
				} else if ( $CPW_Type == "Tradingview" ) {
					$wpdb->update( $table_name,
						array( 'redirect_links' => 'https://www.tradingview.com/symbols/' . $CPW_coin . strtoupper( get_option( 'CPW_currency' ) ) ),
						array( 'symbol' => $CPW_coin )
					);
				} else if ( $CPW_Type == "Tradingview Technicals" ) {
					$wpdb->update( $table_name,
						array( 'redirect_links' => 'https://www.tradingview.com/symbols/' . $CPW_coin . strtoupper( get_option( 'CPW_currency' ) ) . '/technicals/' ),
						array( 'symbol' => $CPW_coin )
					);
				} else {
					$wpdb->update( $table_name,
						array( 'redirect_links' => get_site_url() . '/' . $CPW_coin ),
						array( 'symbol' => $CPW_coin )
					);
				}
			}

			//echo $apiProvider . $apiKey . $symbols;
			update_option( 'CPW_type_link', $CPW_Type );


			echo '<div class="cpw_success">'.__('Settings Saved!','CPW').'</div>';
		}
		require_once CPW_INC . 'admin/template/links.php';
	}



    function RBAPP_Admin_Menu_Categories_CallBack() {
		require_once Rapp_PLUGIN_PATH . 'admin/template/categories.php';
	}