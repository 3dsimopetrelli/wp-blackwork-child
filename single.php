<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php while (have_posts()) : the_post(); ?>

            <?php if (function_exists('elementor_theme_do_location') && elementor_theme_do_location('single')) : ?>

                
                
            <?php else : ?>

                            
    
            <?php endif; ?>

        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>
