<?php
// Template Name: Institute Page
get_header();
$fields = get_fields();
?>

<main>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1>1. <?php echo $fields['title']; ?></h1>
                <hr>
                <img src="<?php echo $fields['image'] ?>" alt="about-us">
                <?php the_content(); ?>
            <?php endwhile;
        else : ?>
            <p>There are no posts or pages here</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>