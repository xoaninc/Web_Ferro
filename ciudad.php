<?php
/*
Template Name: Ciudad
*/
get_header();
$city_slug = get_post_field('post_name', get_the_ID());
echo '<section class="ciudad-infografias">';
echo '<h2>Infografías de ' . esc_html(get_the_title()) . '</h2>';
$infografia_args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'category_name' => $city_slug . ',infografia'
);
$infografia_query = new WP_Query($infografia_args);
if ($infografia_query->have_posts()) {
    echo '<ul class="ciudad-lista">';
    while ($infografia_query->have_posts()) {
        $infografia_query->the_post();
        echo '<li><a href="' . get_permalink() . '"><strong>' . get_the_title() . '</strong></a></li>';
    }
    echo '</ul>';
    wp_reset_postdata();
} else {
    echo '<p>No hay infografías para esta ciudad.</p>';
}
echo '</section>';
get_footer();
