<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'nathaliemota-style', get_stylesheet_directory_uri() . '/style.css'); 
    wp_enqueue_script( 'nathaliemota-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1.1', true);
}

add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
}

   function nathaliemota_supports() {
       add_theme_support('title-tag');
       add_theme_support('post-thumbnails');
       add_theme_support('menus');
       add_action('after_setup_theme', 'nathaliemota_supports');
    }
add_action('init','nathaliemota_supports');

   function enregistre_mon_menu() {
    register_nav_menu( 'header', __( 'Header' ) );
    register_nav_menu( 'footer', __( 'Footer' ) );
}
add_action( 'init', 'enregistre_mon_menu' );


add_action( 'wp_ajax_nathaliemota_load_thumbnails', 'nathaliemota_load_thumbnails' );
add_action( 'wp_ajax_nopriv_nathaliemota_load_thumbnails', 'nathaliemota_load_thumbnails' );

function nathaliemota_load_thumbnails() {
  
	// Vérification de sécurité
  	if( 
		! isset( $_REQUEST['nonce'] ) or 
       	! wp_verify_nonce( $_REQUEST['nonce'], 'nathaliemota_load_thumbnails' ) 
    ) {
    	wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
  	}
    
    // On vérifie que l'identifiant a bien été envoyé
    if( ! isset( $_POST['postid'] ) ) {
    	wp_send_json_error( "L'identifiant de l'article est manquant.", 400 );
  	}

  	// Récupération des données du formulaire
  	$post_id = intval( $_POST['postid'] );
    
	// Vérifier que l'article est publié, et public
	if( get_post_status( $post_id ) !== 'publish' ) {
    	wp_send_json_error( "Vous n'avez pas accès aux commentaires de cet article.", 403 );
	}

  	// Utilisez sanitize_text_field() pour les chaines de caractères.
  	// exemple : 
    $name = sanitize_text_field( $_POST['name'] );

  	// Requête des commentaires
  	$comments = get_comments([
    	'post_id' => $post_id,
    	'status' => 'approve'
  	]);

  	// Préparer le HTML des commentaires
  	$html = wp_list_comments([
    	'per_page' => -1,
    	'avatar_size' => 76,
    	'echo' => false,
  	], $comments );

  	// Envoyer les données au navigateur
	wp_send_json_success( $html );
}   


   
