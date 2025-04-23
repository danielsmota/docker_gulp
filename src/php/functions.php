<?php

add_action('wp_enqueue_scripts', function () {
    $themeUrl = get_template_directory_uri();

    // add the style.css file to the html head
    // wp_enqueue_style( 'style.min.css', get_stylesheet_uri() );

    // add javascript to the bottom of the theme
    wp_enqueue_script('main-js', $themeUrl . '/scripts/main-min.js', array(), '1.0', true, 'async');
    wp_enqueue_script('darkmode-js', $themeUrl . '/scripts/darkmode-min.js', array(), '1.0', true, 'async');
    wp_enqueue_script('menu-js', $themeUrl . '/scripts/menu-min.js', array(), '1.0', true, 'async');
});

add_action('wp_print_styles', 'wps_deregister_styles', 100);
function wps_deregister_styles()
{
    wp_dequeue_style('wp-block-library');
}

//- Menu
add_action('after_setup_theme', 'wpt_setup');
if (! function_exists('wpt_setup')): function wpt_setup()
    {
        register_nav_menus(
            array(
                'principal' => 'Principal'
            )
        );
    }
endif;

//- Remove links from images
add_filter('the_content', 'attachment_image_link_remove_filter');

function attachment_image_link_remove_filter($content)
{
    $content =
        preg_replace(
            array(
                '{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}',
                '{ wp-image-[0-9]*" /></a>}'
            ),
            array('<img', '" />'),
            $content
        );
    return $content;
}

add_theme_support('post-thumbnails');

function wpb_posts_nav()
{
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    $next_thumb = get_the_post_thumbnail_url($next_post);
    $prev_thumb = get_the_post_thumbnail_url($prev_post);

    if ($next_post || $prev_post) : ?>
        <div class="posts__nav">
            <?php if (! empty($prev_post)) : ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="nav__item">
                    <div class="nav__thumbnail" style="background-image: url('<?php echo $prev_thumb ?>')"></div>
                </a>
            <?php endif; ?>

            <?php if (! empty($next_post)) : ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="nav__item">
                    <div class="nav__thumbnail" style="background-image: url('<?php echo $next_thumb ?>')"></div>
                </a>
            <?php endif; ?>
        </div>
<?php endif;
}

add_filter('automatic_updater_disabled', '__return_false');

// Core Updates via Filter
add_filter('auto_update_core', '__return_true');

//disable development updates 
add_filter('allow_dev_auto_core_updates', '__return_false');

//disable minor updates
add_filter('allow_minor_auto_core_updates', '__return_true');

//disable major updates      
add_filter('allow_major_auto_core_updates', '__return_true');
