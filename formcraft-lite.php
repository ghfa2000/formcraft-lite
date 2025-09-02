<?php
/*
Plugin Name: FormCraft Lite
Description: A modular contact form plugin.
Version: 1.0
Author: Gehad Mohamed
*/

define('FCL_PATH', plugin_dir_path(__FILE__));
define('FCL_URL', plugin_dir_url(__FILE__));

include_once FCL_PATH . 'includes/form-handler.php';
include_once FCL_PATH . 'includes/admin-settings.php';

function fcl_enqueue_assets() {
    wp_enqueue_style('fcl-style', FCL_URL . 'assets/style.css');
    wp_enqueue_script('fcl-script', FCL_URL . 'assets/script.js', [], false, true);
    wp_localize_script('fcl-script', 'fcl_ajax', ['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'fcl_enqueue_assets');

function fcl_render_form($atts, $content = null) {
    $form_html = '<form method="post" class="fcl-form">';
    $form_html .= '<input type="text" name="fcl_honey" style="display:none">'; // Honeypot
    $form_html .= do_shortcode($content);
    $form_html .= '</form>';
    return $form_html;
}
add_shortcode('formcraft_form', 'fcl_render_form');

function fcl_input_text($atts) {
    $name = esc_attr($atts['name'] ?? '');
    $placeholder = esc_attr($atts['placeholder'] ?? '');
    return "<input type='text' name='$name' placeholder='$placeholder' required>";
}
add_shortcode('text', 'fcl_input_text');

function fcl_input_email($atts) {
    $name = esc_attr($atts['email'] ?? '');
    $placeholder = esc_attr($atts['placeholder'] ?? '');
    return "<input type='email' name='$name' placeholder='$placeholder' required>";
}
add_shortcode('email', 'fcl_input_email');

function fcl_textarea($atts) {
    $name = esc_attr($atts['name'] ?? '');
    $placeholder = esc_attr($atts['placeholder'] ?? '');
    return "<textarea name='$name' placeholder='$placeholder' required></textarea>";
}
add_shortcode('textarea', 'fcl_textarea');

function fcl_submit_button($atts, $content = null) {
    $label = esc_html($content ?? 'Send');
    return "<input type='submit' name='fcl_submit' value='$label'>";
}
add_shortcode('submit', 'fcl_submit_button');
