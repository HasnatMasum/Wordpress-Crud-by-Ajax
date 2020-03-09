<?php
/**
 * Plugin Name:       SA CRUD
 * Plugin URI:        http://themespassion.com/
 * Description:       Wordpress Crud plugin for Staff Asia.
 * Version:           1.0
 * Author:            Hasnat Masum
 * Author URI:        http://themespassion.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sa-crud
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ){
    exit;
}
require_once(plugin_dir_path( __FILE__ ) .'assets/inc/sa_crud_ajax.php');


 function sacrud_load_text_domain(){
     load_plugin_textdomain('sa-crud', false, dirname(__FILE__) . "/languages");
 }
 add_action('plugins_loaded', 'sacrud_load_text_domain');


//Create Database Table by activation hook
function sacrud_plugin_activate(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';
    $sql = "CREATE TABLE {$table_name}(
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(250),
            email VARCHAR(250),
            age int(11),
            PRIMARY KEY (id)
    );";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

}

register_activation_hook(__FILE__,"sacrud_plugin_activate");

//Drop Database Table by deactivation hook
function sacrud_plugin_deactivate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}
register_deactivation_hook( __FILE__, "sacrud_plugin_deactivate" );

//Enqueue Style
function enqueue_custom_script(){
    wp_enqueue_script('sacrud-main', plugin_dir_url(__FILE__) . 'assets/js/main.js', array('jquery'), '1.0', true);
    $ajaxurl = admin_url('admin-ajax.php');
    wp_localize_script( 'sacrud-main', 'sacrud_ajax', array( 'ajaxurl' => $ajaxurl ));
}
add_action('admin_enqueue_scripts','enqueue_custom_script');

add_action('admin_enqueue_scripts',function($hook){
    if('toplevel_page_sacrud' == $hook){
        wp_enqueue_style('sacrud-style', plugin_dir_url(__FILE__) . 'assets/css/sa-crud.css');
    }
});



 // Menu page adding
 function persons_menu_page_add(){
    add_menu_page(
        __('SA CRUD','sa-crud'),
        __('SA CRUD','sa-crud'),
        'manage_options',
        'sacrud',
        'personinfo_display_form'
    );
    
    add_submenu_page(
        'sacrud', 
        'crud-app',
        __('View Person','sa-crud'), 
        'manage_options', 
        'view-person', 
        'person_submenu_output' );
 }
 add_action('admin_menu', 'persons_menu_page_add');

 function personinfo_display_form(){
    global $wpdb;
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $wpdb->delete("{$wpdb->prefix}persons",['id'=>sanitize_key($_GET['pid'])]);  
        $_GET['pid'] = null;
    }
    
    $did = $_GET['action'];
    $id = $_GET['pid'] ? $_GET['pid'] : 0;
	$id = sanitize_key( $id );
	if ( $id ) {
		$result = $wpdb->get_row( "select * from {$wpdb->prefix}persons WHERE id='{$id}'" );
	
        require_once(plugin_dir_path( __FILE__ ) .'assets/templates/personinfo_update.php');

    }else{
        require_once(plugin_dir_path( __FILE__ ) .'assets/templates/personinfo_insert.php');
    }
   
 }

 function person_submenu_output(){
    require_once(plugin_dir_path( __FILE__ ) .'assets/templates/persons_data_display.php');
 }
