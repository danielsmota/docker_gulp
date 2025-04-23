<?php

/**
 * Template Name: Página Padrão
 * Description: Template padrão para páginas.
 */

get_header(); ?>

<main class="site-main">
    <div class="wrapper">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Páginas:', 'seu-tema'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                </article><!-- #post-## -->

        <?php endwhile;
        else :
            echo '<p>' . __('Desculpe, nada encontrado.', 'seu-tema') . '</p>';
        endif;
        ?>

    </div><!-- .container -->
</main><!-- #primary -->

<?php //get_sidebar(); 
?>

<?php get_footer(); ?>