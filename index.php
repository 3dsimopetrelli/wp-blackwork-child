<?php
/**
 * Template Name: Blog 
 */

 get_header();?>
 
 
 
 
 
 
 
<section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
<div class="elementor-container elementor-column-gap-default">
	
<?php

// Loop through the posts
if (have_posts()) {
  echo '<div class="blog-grid">'; // Apri il contenitore della griglia
  while (have_posts()) {
    the_post();
    $post_categories = get_the_category();
?>

    <div class="blog-post">
      <div class="post-content">
        <?php if (has_post_thumbnail()) : ?>
          <div class="featured-image">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('full'); /* Usa "full" per visualizzare l'immagine larga quanto la colonna */ ?>
            </a>
          </div>
          <div class="post-category post-category-with-image">
            <a href="<?php echo get_category_link($post_categories[0]->term_id); ?>">
              <?php echo $post_categories[0]->name; ?>
            </a>
          </div>
        <?php endif; ?>
        <h2 class="post-title <?php echo has_post_thumbnail() ? 'post-title-with-image' : 'post-title-no-image'; ?>">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <?php if (!has_post_thumbnail()) : ?>
          <div class="post-category post-category-no-image">
            <a href="<?php echo get_category_link($post_categories[0]->term_id); ?>">
              <?php echo $post_categories[0]->name; ?>
            </a>
          </div>
          <div class="post-excerpt">
            <?php the_excerpt(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

<?php
  } // end while
  echo '</div>'; // Chiudi il contenitore della griglia
} // end if





?> 

</div>
</section>


<?php get_footer(); ?> 
