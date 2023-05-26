<?php get_header(); ?>

<main class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php $taxonomy = get_the_terms(get_the_ID(), 'category-product'); ?>

            <h1>This is the product: <?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile;
    else : ?>
        <p>There are no posts or pages here</p>
    <?php endif; ?>

    <?php $args = array(
        'post_type' => 'product',
        'post_per_page' => 6,
        'order' => 'ASC',
        'orderby' => 'title',
        'tax_query' => array(
            array(
                'taxonomy' => 'category-product',
                'field' => 'slug',
                'terms' => $taxonomy[0]->slug
            )
        )
    );

    $products = new WP_Query($args);
    ?>

    <div class="row text-center">
        <div class="col-md-12">
            <h3>Related products</h3>
        </div>
        <?php if ($products->have_posts()) : while ($products->have_posts()) : $products->the_post(); ?>
                <div class="col-md-4 my-3">
                    <div class="card">
                        <?php the_post_thumbnail('large'); ?>
                        <div class="card-body">
                            <h4><?php the_title(); ?></h4>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p>There are no posts or pages here</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>