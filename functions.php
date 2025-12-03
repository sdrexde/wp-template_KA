<?php
/**
 * Kälte Apel WordPress Theme Functions
 */

// Theme Setup
function kaelte_apel_theme_setup() {
    // Add theme support for various WordPress features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'kaelte-apel'),
    ));
}
add_action('after_setup_theme', 'kaelte_apel_theme_setup');

// Enqueue styles and scripts
function kaelte_apel_scripts() {
    // Main stylesheet
    wp_enqueue_style('kaelte-apel-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fontawesome/css/all.min.css', array(), '6.0.0');
    
    // Custom JavaScript files
    wp_enqueue_script('kaelte-apel-slider', get_template_directory_uri() . '/js/slider.js', array(), '1.0.0', true);
    wp_enqueue_script('kaelte-apel-snow', get_template_directory_uri() . '/js/snow.js', array(), '1.0.0', true);
    wp_enqueue_script('kaelte-apel-menu', get_template_directory_uri() . '/js/menu.js', array(), '1.0.0', true);
    wp_enqueue_script('kaelte-apel-cookies', get_template_directory_uri() . '/js/cookie-banner.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'kaelte_apel_scripts');

// Custom post types
function kaelte_apel_custom_post_types() {
    // Leistungen Post Type
    register_post_type('leistungen', array(
        'labels' => array(
            'name' => 'Leistungen',
            'singular_name' => 'Leistung',
            'add_new' => 'Neue Leistung',
            'add_new_item' => 'Neue Leistung hinzufügen',
            'edit_item' => 'Leistung bearbeiten',
            'new_item' => 'Neue Leistung',
            'view_item' => 'Leistung anzeigen',
            'search_items' => 'Leistungen durchsuchen',
            'not_found' => 'Keine Leistungen gefunden',
            'not_found_in_trash' => 'Keine Leistungen im Papierkorb'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-tools',
        'rewrite' => array('slug' => 'leistungen')
    ));
    
    // Testimonials Post Type
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => 'Kundenstimmen',
            'singular_name' => 'Kundenstimme',
            'add_new' => 'Neue Kundenstimme',
            'add_new_item' => 'Neue Kundenstimme hinzufügen',
            'edit_item' => 'Kundenstimme bearbeiten',
            'new_item' => 'Neue Kundenstimme',
            'view_item' => 'Kundenstimme anzeigen',
            'search_items' => 'Kundenstimmen durchsuchen',
            'not_found' => 'Keine Kundenstimmen gefunden',
            'not_found_in_trash' => 'Keine Kundenstimmen im Papierkorb'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-testimonial'
    ));
}
add_action('init', 'kaelte_apel_custom_post_types');

// Custom meta fields for testimonials
function kaelte_apel_testimonial_meta() {
    add_meta_box(
        'testimonial_author',
        'Autor der Kundenstimme',
        'kaelte_apel_testimonial_author_callback',
        'testimonials',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kaelte_apel_testimonial_meta');

function kaelte_apel_testimonial_author_callback($post) {
    wp_nonce_field('kaelte_apel_testimonial_author_nonce', 'testimonial_author_nonce');
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    echo '<label for="testimonial_author">Autor:</label>';
    echo '<input type="text" id="testimonial_author" name="testimonial_author" value="' . esc_attr($author) . '" size="50" />';
}

function kaelte_apel_save_testimonial_meta($post_id) {
    if (!isset($_POST['testimonial_author_nonce']) || !wp_verify_nonce($_POST['testimonial_author_nonce'], 'kaelte_apel_testimonial_author_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['post_type']) && 'testimonials' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    
    if (isset($_POST['testimonial_author'])) {
        update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
    }
}
add_action('save_post', 'kaelte_apel_save_testimonial_meta');

// Customizer options
function kaelte_apel_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => 'Hero Bereich',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Ihre Experten für Kälte- und Klimatechnik',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => 'Hero Titel',
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Zuverlässige Lösungen für ganz Deutschland – jetzt Angebot sichern!',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Hero Untertitel',
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Slider Images
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("slider_image_$i", array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "slider_image_$i", array(
            'label' => "Slider Bild $i",
            'section' => 'hero_section',
        )));
    }
    
    // Contact Information
    $wp_customize->add_section('contact_info', array(
        'title' => 'Kontaktinformationen',
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default' => '039291 491 44',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label' => 'Telefonnummer',
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@kälte-apel.de',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => 'E-Mail Adresse',
        'section' => 'contact_info',
        'type' => 'email',
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Stadtfeld 19a, 39240 Calbe (Saale), Deutschland',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => 'Adresse',
        'section' => 'contact_info',
        'type' => 'textarea',
    ));
    
    // Social Media Links
    $wp_customize->add_section('social_media', array(
        'title' => 'Social Media',
        'priority' => 40,
    ));
    
    $social_networks = array(
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'tiktok' => 'TikTok',
        'linkedin' => 'LinkedIn'
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("social_$network", array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("social_$network", array(
            'label' => "$label URL",
            'section' => 'social_media',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'kaelte_apel_customize_register');

// Contact form handler
function kaelte_apel_handle_contact_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kaelte_apel_contact_form'])) {
        // Verify nonce
        if (!wp_verify_nonce($_POST['contact_nonce'], 'kaelte_apel_contact_form')) {
            wp_die('Sicherheitsfehler');
        }
        
        // Sanitize input
        $anrede = sanitize_text_field($_POST['anrede']);
        $vorname = sanitize_text_field($_POST['vorname']);
        $nachname = sanitize_text_field($_POST['nachname']);
        $telefon = sanitize_text_field($_POST['telefon']);
        $nachricht = sanitize_textarea_field($_POST['nachricht']);
        $strasse = sanitize_text_field($_POST['strasse']);
        $hausnummer = sanitize_text_field($_POST['hausnummer']);
        $plz = sanitize_text_field($_POST['plz']);
        $ort = sanitize_text_field($_POST['ort']);
        
        // Validate required fields
        $errors = array();
        if (empty($anrede)) $errors[] = 'Anrede ist erforderlich';
        if (empty($vorname)) $errors[] = 'Vorname ist erforderlich';
        if (empty($nachname)) $errors[] = 'Nachname ist erforderlich';
        if (empty($telefon)) $errors[] = 'Telefonnummer ist erforderlich';
        if (empty($nachricht)) $errors[] = 'Nachricht ist erforderlich';
        
        if (empty($errors)) {
            // Prepare email
            $to = get_option('admin_email');
            $subject = 'Neue Kontaktanfrage von ' . $vorname . ' ' . $nachname;
            $message = "Anrede: $anrede\n";
            $message .= "Name: $vorname $nachname\n";
            $message .= "Telefon: $telefon\n";
            $message .= "Nachricht:\n$nachricht\n\n";
            
            if (!empty($strasse) || !empty($hausnummer) || !empty($plz) || !empty($ort)) {
                $message .= "Adresse:\n";
                if (!empty($strasse)) $message .= "Straße: $strasse\n";
                if (!empty($hausnummer)) $message .= "Hausnummer: $hausnummer\n";
                if (!empty($plz)) $message .= "PLZ: $plz\n";
                if (!empty($ort)) $message .= "Ort: $ort\n";
            }
            
            $headers = array('Content-Type: text/plain; charset=UTF-8');
            
            // Send email
            if (wp_mail($to, $subject, $message, $headers)) {
                wp_redirect(add_query_arg('contact_sent', 'success', get_permalink()));
                exit;
            } else {
                wp_redirect(add_query_arg('contact_sent', 'error', get_permalink()));
                exit;
            }
        } else {
            wp_redirect(add_query_arg('contact_errors', urlencode(implode('|', $errors)), get_permalink()));
            exit;
        }
    }
}
add_action('wp_loaded', 'kaelte_apel_handle_contact_form');

// Add admin menu for theme options
function kaelte_apel_admin_menu() {
    add_theme_page(
        'Kälte Apel Einstellungen',
        'Theme Einstellungen', 
        'manage_options',
        'kaelte-apel-settings',
        'kaelte_apel_settings_page'
    );
}
add_action('admin_menu', 'kaelte_apel_admin_menu');

function kaelte_apel_settings_page() {
    ?>
    <div class="wrap">
        <h1>Kälte Apel Theme Einstellungen</h1>
        <p>Verwenden Sie den <a href="<?php echo admin_url('customize.php'); ?>">Customizer</a>, um die Theme-Einstellungen zu bearbeiten.</p>
        <h2>Anleitung</h2>
        <ul>
            <li>Gehen Sie zu <strong>Design > Customizer</strong></li>
            <li>Bearbeiten Sie dort die Hero-Bilder, Kontaktdaten und Social Media Links</li>
            <li>Erstellen Sie unter <strong>Leistungen</strong> neue Dienstleistungen</li>
            <li>Fügen Sie unter <strong>Kundenstimmen</strong> Testimonials hinzu</li>
        </ul>
    </div>
    <?php
}

// Widget areas
function kaelte_apel_widgets_init() {
    register_sidebar(array(
        'name'          => 'Footer Widgets',
        'id'            => 'footer-widgets',
        'description'   => 'Widgets für den Footer-Bereich',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'kaelte_apel_widgets_init');
?>