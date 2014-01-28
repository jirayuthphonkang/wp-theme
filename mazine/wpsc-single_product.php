<div class="fance">
<?php
global $wpsc_query, $wpdb;
$image_width = get_option('single_view_image_width');
$image_height = get_option('single_view_image_height');
?>

<?php 
//-----Customized Function-------------------------------



function mazine_wpsc_output_breadcrumbs($options = Array()) {
	$products_page_id = wpec_get_the_post_id_by_shortcode('[productspage]');
	$products_page = get_post($products_page_id);
	if(!wpsc_has_breadcrumbs()){	
		return;
	}
	$filtered_products_page = array(
			'url' => get_option('product_list_url'),
			'name' => $products_page->post_title
		);
	$filtered_products_page = apply_filters('wpsc_change_pp_breadcrumb', $filtered_products_page);
	// If home if the same as products apge only show the products-page link and not the home link
	if(get_option('page_on_front') != $products_page_id){
		echo isset($options['before-breadcrumbs']) ? $options['before-breadcrumbs'] : '<div class="breadcrumb">';
		echo isset($options['before-crumb']) ? $options['before-crumb'] : '';
		echo '<a class="wpsc-crumb" id="wpsc-crumb-home" href="'.get_option('home').'">'.get_option('blogname').'</a>';
		echo isset($options['after-crumb']) ? $options['after-crumb'] : '';
	
		echo isset($options['crumb-separator']) ? $options['crumb-separator'] : ' &raquo; ';
	}	
	echo isset($options['before-crumb']) ? $options['before-crumb'] : '';
	echo '<a class="wpsc-crumb" id="wpsc-crumb-'.$products_page_id.'" href="'.$filtered_products_page['url'].'">'.$filtered_products_page['name'].'</a>';
	echo isset($options['after-crumb']) ? $options['after-crumb'] : '';


	while (wpsc_have_breadcrumbs()) {
		wpsc_the_breadcrumb(); 
		echo isset($options['crumb-separator']) ? $options['crumb-separator'] : ' &raquo; ';
		echo isset($options['before-crumb']) ? $options['before-crumb'] : '';
		if(wpsc_breadcrumb_url()) {
			echo '<a class="wpsc-crumb" id="wpsc-crumb-'.wpsc_breadcrumb_slug().'" href="'.wpsc_breadcrumb_url().'">'.wpsc_breadcrumb_name().'</a>';
		} else {
		//echo '<span class="wpsc-crumb" id="wpsc-crumb-'.wpsc_breadcrumb_slug().'">' . wpsc_breadcrumb_name() . '<span>';\
		?>
			
		<?php
		}
		echo isset($options['after-crumb']) ? $options['after-crumb'] : '';
	}
	if (isset($options['after-breadcrumbs'])) {
		echo $options['after-breadcrumbs'];
	} else {
		echo '</div>';
	}
}


?>

<?php
		// Breadcrumbs
		
		// Plugin hook for adding things to the top of the products page, like the live search
		do_action( 'wpsc_top_of_products_page' );
	?>

<?php  ?>




<?php
mazine_wpsc_output_breadcrumbs();
?>
<div class="title border">
<h2 class="category-title"><?php echo wpsc_the_product_title(); ?></h2>
<?php ?>
</div>

<div id='products_page_container' class="wrap wpsc_container space">
	
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	
	<div class="productdisplay">
	<?php /** start the product loop here, this is single products view, so there should be only one */?>
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			<div class="single_product_display product_view_<?php echo wpsc_the_product_id(); ?>">
				<div class="">
				<?php if(get_option('show_thumbnails')) :?>
					<div class="image_container imagecol">
						<?php if ( wpsc_the_product_thumbnail() ) : ?>
								<a rel="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_image(); ?>">
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(get_option('product_image_width'),get_option('product_image_height'),'','single'); ?>"/>
								</a>
								<?php 
								if ( function_exists( 'gold_shpcrt_display_gallery' ) )
									echo gold_shpcrt_display_gallery( wpsc_the_product_id() );
								?>
						<?php else: ?>
									<a href="<?php echo wpsc_the_product_permalink(); ?>">
									<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />
									</a>
						<?php endif; ?>
					</div>
				<?php endif; ?> 
		
					<div class="producttext">
						
						
							<?php				
								do_action('wpsc_product_before_description', wpsc_the_product_id(), $wpsc_query->product);
							?>
						
						<h5><?php echo _('Short Description');  ?></h5>
						<div class="wpsc_description"><?php echo wpsc_the_product_description(); ?></div>
							
							
						<form class="product_form mazine_product_form" enctype="multipart/form-data" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
							
						
							<?php if ( wpsc_product_has_supplied_file() ) : ?>

								<fieldset class="custom_file">
									<legend><?php _e( 'Upload a File', 'wpsc' ); ?></legend>
									<p><?php _e( 'Select a file from your computer to include with this purchase.', 'wpsc' ); ?></p>
									<input type="file" name="custom_file" />
								</fieldset>
							<?php endif; ?>	
						<?php /** the variation group HTML and loop */?>
                        <?php if (wpsc_have_variation_groups()) { ?>
                        <fieldset><legend><?php _e('Product Options', 'wpsc'); ?></legend>
						<div class="wpsc_variation_forms">
                        	<table>
							<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
								<tr><td class="col1"><label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?>:</label></td>
								<?php /** the variation HTML and loop */?>
								<td class="col2"><select class="wpsc_select_variation" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									<option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
								<?php endwhile; ?>
								</select></td></tr> 
							<?php endwhile; ?>
                            </table>
						</div><!--close wpsc_variation_forms-->
                        </fieldset>
						<?php } ?>
						<?php /** the variation group HTML and loop ends here */?>

							<?php
							/**
							 * Quantity options - MUST be enabled in Admin Settings
							 */
							?>
							<?php if(wpsc_has_multi_adding()): ?>
                            	<fieldset><legend style="float:left;"><?php _e('Quantity', 'wpsc'); ?>: &nbsp;</legend>
								<div class="wpsc_quantity_update">
								<input type="text" id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" />
								<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
								<input type="hidden" name="wpsc_update_quantity" value="true" />
                                </div><!--close wpsc_quantity_update-->
                                </fieldset>
							<?php endif ;?>
							<div class="wpsc_product_price">
								<?php if(wpsc_show_stock_availability()): ?>
									<?php if(wpsc_product_has_stock()) : ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock"><?php _e('Product in stock', 'wpsc'); ?></div>
									<?php else: ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock"><?php _e('Product not in stock', 'wpsc'); ?></div>
									<?php endif; ?>
								<?php endif; ?>	
								<?php if(wpsc_product_is_donation()) : ?>
									<label for="donation_price_<?php echo wpsc_the_product_id(); ?>"><?php _e('Donation', 'wpsc'); ?>: </label>
									<input type="text" id="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />
								<?php else : ?>
									<?php if(wpsc_product_on_special()) : ?>
										<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Old Price', 'wpsc'); ?>: <span class="oldprice" id="old_product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_product_normal_price(); ?></span></p>
									<?php endif; ?>
									<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Price', 'wpsc'); ?>: <span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="currentprice pricedisplay"><?php echo wpsc_the_product_price(); ?></span></p>
									<?php if(wpsc_product_on_special()) : ?>
										<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('You save', 'wpsc'); ?>: <span class="yousave" id="yousave_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_currency_display(wpsc_you_save('type=amount'), array('html' => false)); ?>! (<?php echo wpsc_you_save(); ?>%)</span></p>
									<?php endif; ?>
									 <!-- multi currency code -->
                                    <?php if(wpsc_product_has_multicurrency()) : ?>
	                                    <?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>
									<?php if(wpsc_show_pnp()) : ?>
										<p class="pricedisplay"><?php _e('Shipping', 'wpsc'); ?>:<span class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span></p>
									<?php endif; ?>							
								<?php endif; ?>
							
							</div><!--close wpsc_product_price-->
							<!--sharethis-->
							
							<!--end sharethis-->
							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />					
							<?php if( wpsc_product_is_customisable() ) : ?>
								<input type="hidden" value="true" name="is_customisable"/>
							<?php endif; ?>
							<?php if ( wpsc_product_has_personal_text() ) : ?>
								<br class="clear" />
								<fieldset class="custom_text">
									<legend><?php _e( 'Personalize Your Product', 'wpsc' ); ?></legend>
									<p><?php _e( 'Complete this form to include a personalized message with your purchase.', 'wpsc' ); ?></p>
									<textarea cols='55' rows='5' name="custom_text"></textarea>
								</fieldset>
							<?php endif; ?>
							<?php
							/**
							 * Cart Options
							 */
							?>

							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
								<?php if(wpsc_product_has_stock()) : ?>
									<div class="wpsc_buy_button_container">
											<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
											<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
											<button class="wpsc_buy_button" onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')"><span><span><?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?></span></span></button>
											<?php else: ?>
										
										<button id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"><span><span><?php _e('Add To Cart', 'wpsc'); ?></span></span></button>
										
											<?php endif; ?>
										<div class="wpsc_loading_animation">
											<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
											<?php _e('Updating cart...', 'wpsc'); ?>
										</div><!--close wpsc_loading_animation-->
									</div><!--close wpsc_buy_button_container-->
								<?php else : ?>
									
									<p class="soldout"><?php _e('This product has sold out.', 'wpsc'); ?></p>
								<?php endif ; ?>
							<?php endif ; ?>
						</form><!--close product_form-->
					<div class="clear"></div>	
					<?php echo wpsc_product_rater(); ?>
					<?php
					echo wpsc_also_bought( wpsc_the_product_id() );
						?>
						
						<?php
						if(wpsc_show_fb_like()): ?>
	                        <div class="FB_like">
	                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo wpsc_the_product_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=435&amp;action=like&amp;font=arial&amp;colorscheme=light" frameborder="0"></iframe>
	                        </div><!--close FB_like-->
                        <?php endif; ?>
                        <?php if ( get_option( 'wpsc_share_this' ) == 1 ): ?>
							<div class="st_sharethis" displayText="ShareThis"></div>
							<?php endif; ?>
					<!--close productcol-->
		
					<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
 
						
							
						<?php
							do_action('wpsc_product_addons', wpsc_the_product_id());
						?>
						<?php if(wpsc_the_product_additional_description()) : ?>
						
						<h5><?php echo _('Additional Product Information'); ?></h5>
						<div class="single_additional_description">
            <?php
							$value = '';
							$the_addl_desc = wpsc_the_product_additional_description();
							if( is_serialized($the_addl_desc) ) {
								$addl_descriptions = @unserialize($the_addl_desc);
							} else {
								$addl_descriptions = array('addl_desc', $the_addl_desc);
							}
							
							if( isset($addl_descriptions['addl_desc']) ) {
								$value = $addl_descriptions['addl_desc'];
							}

            	if( function_exists('wpsc_addl_desc_show') ) {
            		echo wpsc_addl_desc_show( $addl_descriptions );
            	} else {
            	echo stripslashes( wpautop($the_addl_desc, $br=1));
            	}	
            ?></div>
						
		
		<?php endif; ?>
		<div class="clear"></div>
	</div>
					<?php do_action('wpsc_product_addon_after_descr', wpsc_the_product_id()); ?>
				
					<?php /** the custom meta HTML and loop */?>
					<div class="custom_meta">
						<?php while (wpsc_have_custom_meta()) : wpsc_the_custom_meta(); 
								if (stripos(wpsc_custom_meta_name(),'g:') !== FALSE){
									continue;
								}
							?>
							<strong><?php echo wpsc_custom_meta_name(); ?>: </strong><?php echo wpsc_custom_meta_value(); ?><br />
						<?php endwhile; ?>
					</div>
					<?php /** the custom meta HTML and loop ends here */?>
					
					
					
					
					<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') =='1')) : ?>
						<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
					<?php endif ; ?>
					
					
						
						
					
					</div>
		
					<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
					
					
				</div>
			</div>
		</div>
		
		<?php echo wpsc_product_comments(); ?>
<?php endwhile; ?>
<?php /** end the product loop here */?>

		<?php
		if(function_exists('fancy_notifications')) {
			echo fancy_notifications();
		}
		?>
		<div class="clear"></div>
</div>
