<?php
add_action('wp_ajax_fcl_submit_form', 'fcl_handle_ajax');
add_action('wp_ajax_nopriv_fcl_submit_form', 'fcl_handle_ajax');


function fcl_handle_ajax() {
    if (!empty($_POST['fcl_honey'])) {
        wp_die('Spam detected.');
    }

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    do_action('fcl_before_send', $name, $email, $message);

    $to = get_option('fcl_admin_email', get_bloginfo('admin_email'));
    $subject = "New Contact Message";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";

    wp_mail($to, $subject, $body);

    do_action('fcl_after_send', $name);

    echo "Thank you, $name. Your message was sent!";
    wp_die(); // ✅ This is essential
error_log("Form submitted by: $name <$email>");


}
