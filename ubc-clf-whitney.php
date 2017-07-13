<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       UBC CLF Whitney webfont
 * Plugin URI:        http://clf.ubc.ca
 * Description:       Add CLF Whitney webfont CSS request. <strong>Note: Required registration</strong>. Please sign up on <a href="http://brand.ubc.ca/font-request-form/" target="_blank">UBC Brand</a> website.
 * Version:           1.0
 * Author:            Michael Kam
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:		  ubc-clf-whitney
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

	}/* init() */



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

	}/* add_actions() */



	/**
	 * Method which enqueue styles
	 *
	 * @since 1.0.0
	 *
	 * @param null
	 * @return null
	 */

	public function init__add_clf_whitney() {

        // Add UBC CLF Whitney subscription CSS request
		wp_register_style( 'ubc-clf-whitney', '//cloud.typography.com/6804272/781004/css/fonts.css' );
        wp_enqueue_style( 'ubc-clf-whitney' );

	}/* init__add_clf_whitney() */



}/* class UBC_CLF_Whitney */


add_action( 'plugins_loaded', 'plugins_loaded__init_ubcclfwhitney' );

function plugins_loaded__init_ubcclfwhitney() {

	$clf_whitney = new UBC_CLF_Whitney();
	$clf_whitney->init();

}/* plugins_loaded__init_ubcclfwhitney() */
