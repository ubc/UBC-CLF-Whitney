<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       UBC CLF Whitney webfont
 * Plugin URI:        http://clf.ubc.ca
 * Description:       Add CLF Whitney webfont CSS request. <strong>Note: Required registration</strong>. Please sign up on <a href="http://brand.ubc.ca/font-request-form/" target="_blank">UBC Brand</a> website.
 * Version:           1.1
 * Author:            Michael Kam & Flynn O'Connor
 * Author URI:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ubc-clf-whitney
 */

class UBC_CLF_Whitney {


	/**
	 * Initialize ourselves
	 *
	 * @since 1.0.0
	 *
	 * @param null
	 * @return null
	 */

	public function init() {

		// Add our actions/filters
		$this->add_actions();

	}//end init()




	/**
	 * Add our hooks
	 *
	 * @since 1.0.0
	 *
	 * @param null
	 * @return null
	 */

	public function add_actions() {

		// Add custom UBC CLF Whitney
		add_action( 'init', array( $this, 'init__add_clf_whitney' ) );

		// Add new settings panels
		add_action( 'admin_init', array( $this, 'register_settings' ) );

	}//end add_actions()




	/**
	 * Method which enqueue styles
	 *
	 * @since 1.0.0
	 *
	 * @param null
	 * @return null
	 */

	public function init__add_clf_whitney() {

		$font_source = get_option( 'ubc_font_source', 'production' ); // Default to 'production' if not set

		if ( $font_source === 'development' ) {
			wp_enqueue_style( 'ubc-clf-whitney', 'https://cloud.typography.com/6804272/697806/css/fonts.css' );
		} else {
			wp_enqueue_style( 'ubc-clf-whitney', 'https://cloud.typography.com/6804272/781004/css/fonts.css' );
		}

	}//end init__add_clf_whitney()


	/**
	 * Method for registering new settings panel;
	 *
	 * @since 1.0.1
	 *
	 * @return void
	 */
	public function register_settings() {
		register_setting( 'reading', 'ubc_font_source' );

		add_settings_section(
			'ubf_settings_section',
			'Font Source Environment',
			array( $this, 'settings_section_callback' ),
			'reading'
		);

		add_settings_field(
			'ubf_font_source_field',
			'Select Environment',
			array( $this, 'font_source_field_callback' ),
			'reading',
			'ubf_settings_section'
		);
	}

	public function settings_section_callback() {
		echo '<p>Select whether the website is for development/testing or production purposes.</p>';
	}

	public function font_source_field_callback() {
		$font_source = get_option( 'ubc_font_source' );
		?>
		<input type="radio" id="production" name="ubc_font_source" value="production" <?php checked( $font_source, 'production' ); ?>>
		<label for="production">Production</label><br>
		<input type="radio" id="development" name="ubc_font_source" value="development" <?php checked( $font_source, 'development' ); ?>>
		<label for="development">Development</label>
		<?php
	}

}//end class



add_action( 'plugins_loaded', 'plugins_loaded__init_ubcclfwhitney' );

function plugins_loaded__init_ubcclfwhitney() {

	$clf_whitney = new UBC_CLF_Whitney();
	$clf_whitney->init();

}//end plugins_loaded__init_ubcclfwhitney()

