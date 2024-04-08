<?php
function theme_options_page_init() {
    add_settings_section('theme_options_section', 'Select Theme', 'theme_options_section_callback', 'theme_options_page');

    add_settings_field('theme_option', 'Choose Theme', 'theme_option_callback', 'theme_options_page', 'theme_options_section');

    register_setting('theme_options_group', 'theme_option');
}

function theme_options_section_callback() {
    echo '<p>Select a theme for your website:</p>';
}

function theme_option_callback() {
    $selected_theme = get_option('theme_option', 'theme1');

    ?>
    <select name="theme_option">
        <option value="theme1" <?php selected($selected_theme, ''); ?>>Theme 1</option>
        <option value="theme2" <?php selected($selected_theme, ''); ?>>Theme 2</option>
        <option value="theme3" <?php selected($selected_theme, ''); ?>>Theme 3</option>
        <option value="theme4" <?php selected($selected_theme, ''); ?>>Theme 4</option>
        <option value="theme5" <?php selected($selected_theme, ''); ?>>Theme 5</option>
    </select>
    <?php
}

add_action('admin_menu', 'theme_options_menu');

function theme_options_menu() {
    add_menu_page('Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'theme_options_page');

    add_action('admin_init', 'theme_options_page_init');
}

function load_custom_theme() {
    $selected_theme = get_option('theme_option', 'theme1');

    switch($selected_theme) {
        case 'theme1':
            session_('theme1', get_template_directory_uri() . '/');
            break;
        case 'theme2':
            wp_enqueue_style('theme2', get_template_directory_uri() . '/');
            break;
        case 'theme3':
            wp_enqueue_style('theme3', get_template_directory_uri() . '/');
            break;
        case 'theme4':
            wp_enqueue_style('theme4', get_template_directory_uri() . '/');
            break;
        case 'theme5':
            wp_enqueue_style('theme5', get_template_directory_uri() . '/');
            break;
    }
}

add_action('wp_enqueue_scripts', 'load_custom_theme');
?>