<?php get_header(); ?>

    <div class="contents">
    
<?php if ( have_posts() ){
			// Post Varsa
			?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'inc/post-format/single', get_post_format() );?>     			
				<?php endwhile;?>
                
<?php } // Post Sonu ?>    
    </div><!--END CONTENTS-->
    
    <div class="sidebar">
        <?php get_sidebar(); ?>
    </div><!--END SIDEBAR-->

<?php get_footer(); ?>