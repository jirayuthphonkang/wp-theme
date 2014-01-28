<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		<div class="grid_9 cont_col" id="posts">

	<div class="smaller-title">
		<h1 class="category-title lower-case"><?php _e('You were looking for','mazine'); ?>: <?php the_search_query(); ?></h1>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="fance">
		
		<?php if ( has_post_thumbnail()) : ?>
			<?php echo '<figure class="thumb">'; the_post_thumbnail(); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
		<?php endif; ?>
		<div class="heading">
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
			<div class="post-meta-written">
				<?php the_time('F j, Y'); ?> <?php _e('at','mazine');?> <?php the_time() ?>, <?php _e('by','mazine'); ?> <?php the_author_posts_link() ?>
			</div>
		</div>
		

		<div class="post-content">
			<?php the_excerpt(); /* the excerpt is loaded to help avoid duplicate content issues */ ?>
		</div><!--.post-excerpt-->
	</div>
	<?php endwhile; else: ?>
	<div class="fance">
		<div class="no-results">
			<div class="heading">
				<h2><?php _e('No Results','mazine'); ?></h2>
			</div>
			<div class="post-content">
				<p><?php _e('Please feel free try again!','mazine'); ?></p>
			</div>
		</div><!--no-results-->
	</div>
	<?php endif; ?>

	<nav class="newer-older">
		<div class="older">
				<?php next_posts_link(__('<span><span>&laquo; Older Entries</span></span>','mazine')) ?>
		</div><!--.older-->
		<div class="newer">
				<?php previous_posts_link(__('<span><span>Newer Entries &raquo;</span></span>','mazine')) ?>
		</div><!--.older-->
	</nav><!--.oldernewer-->

</div><!-- #content -->
<div class="grid_3 side_col_right">
<?php get_sidebar(); ?>
</div>
		<div class="clear"></div>
	</div>	
</section>

<?php get_footer(); ?>
