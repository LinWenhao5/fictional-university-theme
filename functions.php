<?php
function add_theme_scripts()
{
    wp_enqueue_script('js-bundle', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('costom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style.css', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_feature()
{
    register_nav_menu('headerMenu', 'Header Menu');
    register_nav_menu('FooterMenuOne', 'Footer Menu One');
    register_nav_menu('FooterMenuTwo', 'Footer Menu Two');
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'add_feature');

function university_adjust_posts($query)
{
    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query())
    {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query())
    {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numric'
            )
          ));
    }
}

add_action('pre_get_posts', 'university_adjust_posts');
?>