<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'nathaliemota-style', get_stylesheet_directory_uri() . '/style.css'); 
    wp_enqueue_script( 'nathaliemota-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ));
}

/*****LIBRAIRIE FONTAWESOME*****/
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
}

/****AJOUT DU TITRE DE LA PAGE, DES IMAGES MISES EN AVANT*****/
function nathaliemota_supports() {
       add_theme_support('title-tag');
       add_theme_support('post-thumbnails');
       add_theme_support('menus');
       add_action('after_setup_theme', 'nathaliemota_supports');
    }
add_action('init','nathaliemota_supports');


/*****AJOUT DU HEADER ET DU FOOTER PERSONNALISES*****/
   function enregistre_mon_menu() {
    register_nav_menu( 'header', __( 'Header' ) );
    register_nav_menu( 'footer', __( 'Footer' ) );
}
add_action( 'init', 'enregistre_mon_menu' );


/*****LIGHTBOX*****/
function enqueue_lightbox_scripts() {
    wp_enqueue_style('nathaliemota', get_stylesheet_uri());
    wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('jquery');
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');

// Enqueue script with nonce
function my_enqueue_scripts() {
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() .'/assets/js/script.js', array('jquery'), null, true);

    // Pass nonce to JavaScript
    wp_localize_script('my-ajax-script', 'my_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');



function nathaliemota_load_filter() {
    // Vérification de sécurité
    if (
        ! isset($_REQUEST['nonce']) ||
        ! wp_verify_nonce($_REQUEST['nonce'], 'nathaliemota_nonce')
    ) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    $categorie_photo = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format_photo = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : '';

    $args = [
        'post_type' => 'photographie',
        'posts_per_page' => 8,
    ];

    if ($categorie_photo) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie_photo',
            'field' => 'slug',
            'terms' => $categorie_photo,
        ];
    }

    if ($format_photo) {
        $args['tax_query'][] = [
            'taxonomy' => 'format_photo',
            'field' => 'slug',
            'terms' => $format_photo,
        ];
    }

    if ($orderby) {
        $args['order'] = $orderby === 'asc' ? 'ASC' : 'DESC';
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'annee_photo';
    }

    $ajaxposts = new WP_Query($args);
    $response = '';

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) {
            $ajaxposts->the_post();
            ob_start();
            get_template_part('templates-parts/photo-block');
            $response .= ob_get_clean();
        }
    } else {
        $response = 'Photos non trouvées';
    }

    echo $response;
    wp_die();
}
add_action('wp_ajax_nathaliemota_load_filter', 'nathaliemota_load_filter');
add_action('wp_ajax_nopriv_nathaliemota_load_filter', 'nathaliemota_load_filter');


/****BOUTON LOAD MORE*****/
function load_more_photos() {
    // Vérification de la variable page
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    error_log('Loading page: ' . $paged); // Ajout d'un log pour le debug

    $args = array(
        'post_type' => 'photographie',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    $query = new WP_Query($args);
    $response = '';

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ob_start();
            get_template_part('templates-parts/photo-block');
            $response .= ob_get_clean();
        endwhile;
    else:
        $response = 'Pas de photos supplémentaires';
    endif;

    wp_reset_postdata();
    echo $response;
    exit;
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');




   
