<?php get_header(); ?>

<main class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1>This is the product: <?php the_title(); ?></h1>
            <?php the_content(); ?>
            <?php get_template_part('template-parts/post', 'navigation'); ?>
        <?php endwhile;
    else : ?>
        <p>There are no posts or pages here</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>