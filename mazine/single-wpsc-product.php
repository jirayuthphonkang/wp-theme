<?php get_header(); ?>
<section id="content">
	<div class="container_12">
	<?php if(!is_single()): ?>	
		<div class="grid_3 side_col_left">
			<?php if ( ! dynamic_sidebar( 'Store Page Sidebar' )) : ?>
						
			<?php endif; ?>
		</div>
	<?php endif; ?>
		<div class="grid_9 cont_col">
		
			
			<?php if ( ! dynamic_sidebar( 'Banner Holder' )) : ?>
						
			<?php endif; ?>
			
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
	<?php endwhile; ?>
		</div>
		<?php if(is_single()): ?>	
		<div class="grid_3 side_col_left">
			<?php if ( ! dynamic_sidebar( 'Store Page Sidebar' )) : ?>
						
			<?php endif; ?>
		</div>
	<?php endif; ?>
	
	
		<div class="clear"></div>
	</div>	
</section>
<?php get_footer(); ?>
