<?php

function init_template()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(
        array(
            'top_menu' => 'Main menu'
        )
    );
}

add_action('after_setup_theme', 'init_template');

function assets()
{
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', '', '4.4.1', 'all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', '', '1.0', 'all');

    wp_enqueue_style('styles', get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.0', 'all');

    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', '', '1.16.0', true);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery', 'popper'), '4.4.1', true);

    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', '', '1.0', true);
    wp_localize_script('custom', 'as', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'apiurl' => home_url('wp-json/news/v1/')
    ));
}

add_action('wp_enqueue_scripts', 'assets');

function sidebar()
{
    register_sidebar(
        array(
            'name' => 'Footer',
            'id' => 'footer',
            'description' => 'Widgets for the footer section',
            'before_title' => '<p>',
            'after_title' => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>'
        )
    );
}

add_action('widgets_init', 'sidebar');

function products_type()
{
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'menu_name' => 'Products'
    );

    $args = array(
        'label' => 'Products',
        'description' => 'Products of Ansonys.com',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true
    );

    register_post_type('product', $args);
}

add_action('init', 'products_type');

function a_register_taxonomy()
{
    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Product Categories',
            'singular_name' => 'Product Category'
        ),
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'category-product')
    );

    register_taxonomy('category-product', array('product'), $args);
}

add_action('init', 'a_register_taxonomy');

function an_filter_products()
{
    $args = array(
        'post_type' => 'product',
        'post_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title'
    );

    if ($_POST['category']) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category-product',
                'field' => 'slug',
                'terms' => $_POST['category']
            )
        );
    }

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        $return = array();
        while ($products->have_posts()) {
            $products->the_post();
            $return[] = array(
                'image' => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link' => get_the_permalink(),
                'title' => get_the_title()
            );
        }

        wp_send_json($return);
    } else {
        wp_send_json_error('There are no products');
    }
}

add_action('wp_ajax_nopriv_an_filter_products', 'an_filter_products');
add_action('wp_ajax_an_filter_products', 'an_filter_products');

function news_lastest_api($data)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $data['post_per_page'],
        'order'     => 'ASC',
        'orderby' => 'title'
    );
    $news = new WP_Query($args);

    if ($news->have_posts()) {
        while ($news->have_posts()) {
            $news->the_post();
            $response[] = array(
                'image' => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link' => get_permalink(),
                'title' => get_the_title()
            );
        }
    } else {
        return null;
    }

    return $response;
}

add_action('rest_api_init', function () {
    register_rest_route(
        'news/v1',
        '/latest/(?P<post_per_page>\d+)',
        array(
            'methods' => 'GET',
            'callback' => 'news_lastest_api'
        )
    );
});
