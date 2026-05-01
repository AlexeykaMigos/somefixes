<?php
function cinnamon_scripts() {
    wp_enqueue_style( 'cinnamon-style', get_stylesheet_uri() );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', array(), null );
    wp_enqueue_script( 'cinnamon-script', get_template_directory_uri() . '/script.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'cinnamon_scripts' );

function cinnamon_menus() {
    register_nav_menus( array(
        'header-menu' => 'Главное меню',
        'footer-menu' => 'Меню в подвале',
    ) );
}
add_action( 'init', 'cinnamon_menus' );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_action('wp_ajax_send_kitten_mail', 'send_kitten_mail');
add_action('wp_ajax_nopriv_send_kitten_mail', 'send_kitten_mail');

function send_kitten_mail() {
    $to = 'mjjjjkgg@mail.ru';
    $subject = 'New Request from Cinnamon Desire';
    $message = "Name: " . $_POST['user_name'] . "\n" .
               "Email: " . $_POST['user_email'] . "\n" .
               "Message: " . $_POST['user_message'];
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if(wp_mail($to, $subject, $message, $headers)) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
    wp_die();
}

add_action( 'rest_api_init', function() {
    register_rest_field( 'post', 'featured_image_url', array(
        'get_callback' => function( $post_array ) {
            $img_id = get_post_thumbnail_id( $post_array['id'] );
            return $img_id ? wp_get_attachment_url( $img_id ) : false;
        }
    ));
});

if ( ! function_exists( 'cd_control_get_settings' ) ) {
    function cd_control_get_settings() {
        return array();
    }
}

function cinnamon_setting( $path, $default = '' ) {
    if ( function_exists( 'cd_control_get' ) ) {
        return cd_control_get( $path, $default );
    }

    return $default;
}

function cinnamon_price( $value ) {
    $value = trim( (string) $value );
    if ( '' === $value ) {
        return '';
    }

    return '$' . ltrim( $value, '$' );
}

function cinnamon_gender_class( $sex ) {
    return 'female' === strtolower( (string) $sex ) ? 'female' : 'male';
}

function cinnamon_gender_symbol( $sex ) {
    return 'female' === strtolower( (string) $sex ) ? '♀' : '♂';
}

function cinnamon_tags( $tags ) {
    $items = array_filter( array_map( 'trim', explode( ',', (string) $tags ) ) );
    foreach ( $items as $item ) {
        echo '<span class="p-tag">' . esc_html( $item ) . '</span>';
    }
}
?>
