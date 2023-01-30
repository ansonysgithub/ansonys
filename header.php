<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4">
                <div class="logo">
                    <a href="<?php echo site_url() ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-8">
                <nav>
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'top_menu',
                            'menu_class' => 'main-menu',
                            'container_class' => 'main-menu'
                        )
                    ) ?>
                </nav>
            </div>
        </div>
    </div>
</header>

<body>