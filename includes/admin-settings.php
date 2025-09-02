<?php
function fcl_settings_menu() {
    add_options_page('FormCraft Settings', 'FormCraft Settings', 'manage_options', 'formcraft-settings', 'fcl_settings_page');
}
add_action('admin_menu', 'fcl_settings_menu');

function fcl_settings_page() {
    ?>
    <div class="wrap">
        <h2>FormCraft Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('fcl_settings_group');
            do_settings_sections('formcraft-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function fcl_register_settings() {
    register_setting('fcl_settings_group', 'fcl_admin_email');
    add_settings_section('fcl_main_section', 'Main Settings', null, 'formcraft-settings');
    add_settings_field('fcl_admin_email', 'Admin Email', 'fcl_email_field', 'formcraft-settings', 'fcl_main_section');
}
add_action('admin_init', 'fcl_register_settings');

function fcl_email_field() {
    $value = get_option('fcl_admin_email', '');
    echo '<input type="email" name="fcl_admin_email" value="' . esc_attr($value) . '" />';
}
