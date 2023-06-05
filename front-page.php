<?php get_header(); ?>

<main class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile;
    else : ?>
        <p>There are no posts or pages here</p>
    <?php endif; ?>

    <div class="product-list">
        <h2>My products: </h2>

        <select name="category-product" id="category-product" class="form-control">
            <option value="">All categories</option>
            <?php
            foreach (get_terms('category-product') as $category) :
            ?>
                <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="row" id="category_results">
            <?php
            $args = array(
                'post_type' => 'product',
                'post_per_page' => 12,
                'order' => 'ASC',
                'orderby' => 'title'
            );

            $products = new WP_Query($args);

            while ($products->have_posts()) : $products->the_post();
            ?>
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
            wp_reset_postdata();
            ?>
        </div>

        <div class="row">
            <h3>Lastests news</h3>
            <div class="lastest-posts" id="lastest-posts">

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>