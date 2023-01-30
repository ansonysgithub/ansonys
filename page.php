<?php get_header(); ?>

<main>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile;
        else : ?>
            <p>There are no posts or pages here</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>