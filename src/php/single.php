<?php get_header(); ?>

<main class="wrapper">
  <article id="post-<?php the_ID(); ?>">
    <section class="entry-content">
      <?php
        the_content(
          sprintf(__( 'Continue reading %s' ),
            the_title( '<span class="screen-reader-text">', '</span>', false )
          )
        );
      ?>
    </section>
  </article>

  <section>
    <?php wpb_posts_nav(); ?>
  </section>

</main>

<?php get_footer(); ?>
