<?php
/**
 * Header Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ihre Experten für Kälte- und Klimatechnik Umgebung Calbe, Schönebeck, Staßfurt, Magdeburg, Sachsen-Anhalt und ganz Deutschland. Zuverlässige Lösungen für Installation, Wartung und Reparatur. Klimaanlage Angebot mit Installation">
    <meta name="keywords" content="Kälte Apel, Kältetechnik, Klimatechnik, Wärmepumpen, Wartung, Installation, Deutschland, Kälteanlage, Service kälteanlagen">
    <meta name="author" content="Kälte Apel">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta-Tags für Social Media -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:description" content="Kälte Apel bietet professionelle Lösungen für Kälte- und Klimatechnik in ganz Deutschland. Jetzt kostenloses Angebot anfordern!">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>">
    
    <!-- Twitter Card Meta-Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="Kälte Apel bietet professionelle Lösungen für Kälte- und Klimatechnik in ganz Deutschland. Jetzt kostenloses Angebot anfordern!">
    <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>">
    
    <!-- Canonical Tag -->
    <link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">
    
    <!-- hreflang-Tag für Sprache/Region -->
    <link rel="alternate" hreflang="de-DE" href="<?php echo esc_url(get_permalink()); ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/img/favicon.ico'); ?>" type="image/x-icon">
    
    <!-- Schema.org Strukturierte Daten -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Kälte Apel",
        "url": "<?php echo esc_url(home_url()); ?>",
        "logo": "<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+49-<?php echo str_replace(' ', '-', get_theme_mod('contact_phone', '039291-491-44')); ?>",
            "contactType": "customer service",
            "email": "<?php echo esc_attr(get_theme_mod('contact_email', 'info@kaelte-apel.de')); ?>",
            "areaServed": "DE",
            "availableLanguage": "German"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Stadtfeld 19a",
            "addressLocality": "Calbe (Saale)",
            "postalCode": "39240",
            "addressCountry": "DE"
        }
    }
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Cookie-Banner HTML -->
<div id="cookie-banner" class="cookie-banner" role="alert" aria-live="polite">
    <div class="cookie-content">
        <p>Wir verwenden Cookies, um unsere Website optimal zu gestalten und zu verbessern. Durch die Nutzung stimmen Sie der Verwendung von Cookies zu. Weitere Informationen finden Sie in unserer <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">Datenschutzerklärung</a>.</p>
        <div class="cookie-buttons">
            <button id="accept-cookies" class="cookie-button accept">Akzeptieren</button>
            <button id="decline-cookies" class="cookie-button decline">Ablehnen</button>
        </div>
    </div>
</div>

<a href="#main" class="skip-link">Zum Hauptinhalt springen</a>

<header>
    <div class="logo">
        <?php 
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>" width="280" height="70" alt="<?php bloginfo('name'); ?> Logo, hier erhalten Sie eine Klimaanlage mit Einbau">
            </a>
            <?php
        }
        ?>
    </div>
    
    <nav aria-label="Hauptnavigation" class="main-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class'     => '',
            'container'      => false,
            'fallback_cb'    => 'kaelte_apel_default_menu',
            'walker'         => new Kaelte_Apel_Walker_Nav_Menu(),
        ));
        ?>
    </nav>
    
    <button class="menu-toggle" aria-label="Menü ein-/ausklappen" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
</header>

<main id="main">

<?php
// Custom Walker for Navigation Menu
class Kaelte_Apel_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menus in this design
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menus in this design
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes .'>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= '<canvas class="snow-canvas" id="snow-canvas-' . $item->ID . '" aria-hidden="true"></canvas>';
        $item_output .= $args->after ?? '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

// Fallback menu if no menu is set
function kaelte_apel_default_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a><canvas class="snow-canvas" id="snow-canvas-0" aria-hidden="true"></canvas></li>';
    echo '<li><a href="#leistungen">Leistungen</a><canvas class="snow-canvas" id="snow-canvas-1" aria-hidden="true"></canvas></li>';
    echo '<li><a href="#ueber-uns">Über uns</a><canvas class="snow-canvas" id="snow-canvas-2" aria-hidden="true"></canvas></li>';
    echo '<li><a href="#kundenstimmen">Kundenstimmen</a><canvas class="snow-canvas" id="snow-canvas-3" aria-hidden="true"></canvas></li>';
    echo '<li><a href="#kontakt">Kontakt</a><canvas class="snow-canvas" id="snow-canvas-4" aria-hidden="true"></canvas></li>';
    echo '</ul>';
}
?>