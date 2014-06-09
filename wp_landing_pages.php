<?php
/*
Plugin Name: WP Landing Pages
Plugin URI: http://www.etechy101.com/wp-landing-pages-plugin
Description: Create lead pages instantly. Integrate with any auto responder with just a few clicks.
Author: HozyAli
Version: 1.3
Author URI: https://plus.google.com/u/0/+HuzaifaAli/posts
Text Domain: wplp
Domain Path: /languages
*/
$llp_PluginName = 'WPLP';
$llp_PluginPrefix = 'llp_';
define($llp_PluginPrefix . 'Currency', '$');
$llp_upload_dir = wp_upload_dir();
define('llp_PATH', plugin_dir_path(__FILE__));
define('llp_URL', plugins_url('/wp-landing-pages'));
$llp_db_prefix = $wpdb->prefix;
function llp_Activation_register(){
	global $wpdb;
	$table_name = $wpdb->prefix . "llp_templates";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."llp_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_name` varchar(255) DEFAULT NULL,
  `tmp_status` int(11) DEFAULT NULL,
  `tmp_preview` text,
  `tmp_file` text,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
INSERT INTO `".$wpdb->prefix."llp_templates` (`id`, `tmp_name`, `tmp_status`, `tmp_preview`, `tmp_file`, `date_added`) VALUES
(1, 'Free Report Reveals', 1, 'tmp_1.jpg', 'template1', NULL),
(3, 'Free Access', 1, 'tmp_3.jpg', 'template3', NULL),
(4, 'Free Report', 1, 'tmp_4.jpg', 'template4', NULL),
(5, 'Free Presentation / Video', 1, 'tmp_5.jpg', 'template5', NULL),
(6, 'Video / Cart Button', 1, 'tmp_6.jpg', 'template6', NULL);";
		//reference to upgrade.php file
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
register_activation_hook( __FILE__, 'llp_Activation_register' );
function llp_AdminMenu() {
    global $llp_PluginPrefix, $llp_PluginName;
    $llp_home = add_menu_page($llp_PluginName . " Configuration", $llp_PluginName, 'edit_themes', $llp_PluginName . "Home", 'llp_home');
    $llp_templates = add_submenu_page($llp_PluginName . "Home", "Templates", "Templates", 'edit_themes', $llp_PluginPrefix . "templates", 'llp_get_templates');
}
add_action('admin_menu', 'llp_AdminMenu');
add_filter('template_redirect', 'check_for_template');
function check_for_template() {
    global $wp_query, $post, $wpdb;
    $do = $_REQUEST['do'];
    $llp_tpl_id = $_REQUEST['tpl_id'];
    $chk_llp_temp = get_post_meta($post->ID, 'llp_tpl_id', true);
    if (is_user_logged_in()) {
        if ($do == 'create') {
            $get_llp_tpl = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "llp_templates WHERE id='" . $llp_tpl_id . "' AND tmp_status='1'");
            if (!empty($get_llp_tpl)) {
                include llp_PATH . 'llp_tpl/' . $get_llp_tpl->tmp_file . '/index.php';
                exit();
            }
        } elseif ($do == 'edit') {
            $get_llp_tpl = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "llp_templates WHERE id='" . $chk_llp_temp . "' AND tmp_status='1'");
            if (!empty($get_llp_tpl)) {
                include llp_PATH . '/llp_tpl/' . $get_llp_tpl->tmp_file . '/index.php';
                exit();
            }
        } elseif ($chk_llp_temp != "") {
            $get_llp_tpl = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "llp_templates WHERE id='" . $chk_llp_temp . "' AND tmp_status='1'");
            if (!empty($get_llp_tpl)) {
                include llp_PATH . '/llp_tpl/' . $get_llp_tpl->tmp_file . '/index.php';
                exit();
            }
        }
    } elseif ($chk_llp_temp != "") {
        $get_llp_tpl = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "llp_templates WHERE id='" . $chk_llp_temp . "' AND tmp_status='1'");
        if (!empty($get_llp_tpl)) {
            include llp_PATH . '/llp_tpl/' . $get_llp_tpl->tmp_file . '/index.php';
            exit();
        }
    }
}
function llp_home() {
    global $wpdb;
    include 'llp_home.php';
}
function llp_get_templates() {
    global $wpdb, $llp_db_prefix;
    $do = $_REQUEST['do'];
    include 'llp_get_templates.php';
}
function llp_load_scripts($hook) {
    wp_enqueue_script('llp_ajax', plugin_dir_url(__FILE__) . 'js/llp_ajax.js', array('jquery'));
    wp_localize_script('llp_ajax', 'llp_vars', array(
        'llp_nonce' => wp_create_nonce('llp_nonce')
    ));
}
add_action('admin_enqueue_scripts', 'llp_load_scripts');
add_action('wp_enqueue_scripts', 'llp_load_scripts');
function llp_ajax_process() {
    if (!isset($_REQUEST['llp_nonce']) || !wp_verify_nonce(($_REQUEST['llp_nonce']), 'llp_nonce'))
        die('Permission denied...');
    $do = $_REQUEST['do'];
    $llp_create_page = $_POST['llp_create_page'];
    if ($do == 'llp_create_page') {
        $llp_tpl_id = $_POST['llp_tpl_id'];
        $llp_post = array(
            'post_title' => $llp_create_page,
            'post_type' => 'page',
            'post_content' => 'This page is created by WP Landing Pages.',
            'post_status' => 'publish'
        );
        // Insert the post into the database
        $insert_post = wp_insert_post($llp_post);
        update_post_meta($insert_post, 'llp_tpl_id', $llp_tpl_id);
        echo $insert_post;
    }
    if ($do == 'llp_save_meta') {
        $llp_id = $_POST['llp_id'];
        $llp_metafield = $_POST['llp_metafield'];
        $llp_metavalue = $_POST['llp_metavalue'];
        $llp_image_link = $_POST['llp_image_link'];
        $llp_link_a = $_POST['llp_link_a'];
        $llp_link_a_open = $_POST['llp_link_a_open'];
        $llp_data_type = $_POST['llp_data_type'];
        if ($llp_data_type == 'form') {
            update_post_meta($llp_id, $llp_metafield, $_POST);
        } else {
            update_post_meta($llp_id, $llp_metafield, $llp_metavalue);
        }
        if ($llp_image_link != "") {
            if ($llp_image_link == "null") {
                update_post_meta($llp_id, $llp_metafield . '_image_link', '');
            } else {
                update_post_meta($llp_id, $llp_metafield . '_image_link', $llp_image_link);
            }
        }
        if ($llp_link_a != "") {
            if ($llp_link_a == "null") {
                update_post_meta($llp_id, $llp_metafield . '_link_a', '');
            } else {
                update_post_meta($llp_id, $llp_metafield . '_link_a', $llp_link_a);
            }
        }
        if ($llp_link_a_open != "") {
            update_post_meta($llp_id, $llp_metafield . '_link_a_open', $llp_link_a_open);
        }
        if ($llp_data_type == 'form') {
            echo get_permalink($llp_id).'?do=edit';
        } else {
            echo 1;
        }
    }
    if ($do == 'llp_upload_image') {
        $result = array(
            'pass' => '',
            'error' => ''
        );
        // Set the allowed file extensions
        $fileTypes = array('png', 'jpg', 'jpeg', 'gif', 'bmp'); // Allowed file extensions
        if (!empty($_FILES)) {
            $fileParts = pathinfo($_FILES['upload_image']['name']);
            // Validate the filetype
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                // Save the file
                $uploadedfile = $_FILES['upload_image'];
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                if ($movefile) {
                    $result['pass'] = $movefile['url'];
                } else {
                    $result['error'] = "Some error occured please try again.";
                }
            } else {
                // The file type wasn't allowed
                $result['error'] = 'Invalid image type.';
            }
        }
        echo json_encode($result);
    }
    die();
}
add_action('wp_ajax_update_llp_options', 'llp_ajax_process');
add_action('media_buttons_context', 'add_my_custom_button');
function add_my_custom_button($context) {
    global $post, $wp_rewrite;
    $chk_llp_temp = get_post_meta($post->ID, 'llp_tpl_id', true);
    if ($chk_llp_temp != "") {
        if ($wp_rewrite->permalink_structure == '') {
            $output = '<a target="_blank" title="Edit Template" class="button" href="' . get_permalink($post->ID) . '&do=edit">Edit Template</a>';
        } else {
            $output = '<a target="_blank" title="Edit Template" class="button" href="' . get_permalink($post->ID) . '?do=edit">Edit Template</a>';
        }
    }
    return $output;
}
?>