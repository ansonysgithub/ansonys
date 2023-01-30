<?php get_header(); ?>
<div class="container my-4">
    <div class="row">
        <div class="col-12 text-center">
            <?php the_archive_title('<h1>', '</h1>'); ?>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-sm-12 my-3">
                    <div class="card">
                        <?php the_post_thumbnail('large'); ?>
                        <div class="card-body">
                            <span><?php the_title(); ?></span>
                            <h3><?php the_excerpt(); ?></h3>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p>There are no posts or pages here</p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>