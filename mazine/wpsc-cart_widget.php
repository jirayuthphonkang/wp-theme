<div id="cart_top_contents">
	<div id="cart_icon"></div>
	<span id="cart_items_no"><?php 	echo wpsc_cart_item_count(); ?></span>
	<div id="cart_text">
		<?php if (wpsc_cart_item_count() == 1) echo __('product in  your shopping cart<br/>Total: &nbsp; '); else echo __('products in  your shopping cart<br/>Total: &nbsp; '); ?>
		 <span class="price"><?php echo wpsc_cart_total_widget(); ?></span>
		<a href="<?php echo get_option('shopping_cart_url'); ?>" class="details"><?php echo __('details'); ?></a>
	</div>
</div>

<div id="cart_bottom_contents">
<?php if(wpsc_cart_item_count() > 0): ?>
 	 	
 	<table class='shoppingcart'>
		<thead><tr>
			<th id='product'><?php echo __('Product', 'wpsc'); ?></th>
			<th id='quantity' class="qty"><?php echo __('Qty', 'wpsc'); ?></th>
			<th id='price' class="price"><?php echo __('Price', 'wpsc'); ?></th>
		</tr></thead>
		<?php $i = 0;?>	
		
		<?php while($c = wpsc_have_cart_items()): wpsc_the_cart_item(); $i++;?>
			<tr <?php if ($i == $c) echo "class=\"omega\""; ?> >
				<td><?php echo wpsc_cart_item_name(); ?></td>
				<td class="qty"><?php echo wpsc_cart_item_quantity(); ?></td>
				<td class="price"><?php echo wpsc_cart_item_price(); ?></td>
			</tr>
		<?php endwhile; ?>
	

<?php if(wpsc_cart_has_shipping() && !wpsc_cart_show_plus_postage()) : ?>
		<tr class="shipping"><td colspan="2"><?php echo __('Shipping', 'wpsc'); ?></td><td class="price"><?php echo wpsc_cart_shipping(); ?></td></tr>
	  	<?php endif; ?>
	 
	  	
<?php if( (wpsc_cart_tax(false) >0) && !wpsc_cart_show_plus_postage()) : ?>
<tr class="shipping"><td colspan="2"><?php echo wpsc_display_tax_label(true); ?></td><td class="price">><?php echo wpsc_cart_tax(); ?></td></tr>
	<?php endif; ?>
	<tr class="total"><td colspan="2"><?php echo __('Total', 'wpsc'); ?></td><td class="price"><?php echo wpsc_cart_total_widget(); ?>
	</td></tr>
	<?php if(wpsc_cart_show_plus_postage()) : ?><tr class="total"><td colspan="3">
				<span class='pluspostagetax'> + <?php echo __('Postage &amp; Tax ', 'wpsc'); ?></span></td></tr>
			<?php endif; ?>
	 </table>

	
	<form action='' method='post' class='wpsc_empty_the_cart'>
		<input type='hidden' name='wpsc_ajax_action' value='empty_cart' />
		<span class='emptycart'>
			<a target='_parent' href='<?php echo htmlentities(add_query_arg('wpsc_ajax_action', 'empty_cart', remove_query_arg('ajax')), ENT_QUOTES); ?>'><?php echo __('Empty your cart', 'wpsc'); ?></a>
		</span>                                                                                             
	</form>
	
	
	<a href="<?php echo get_option('shopping_cart_url'); ?>" class="checkout"><?php echo __('Go to Checkout', 'wpsc'); ?></a>
	
<?php else: ?>
	<div id="no_items">
								<?php echo __('There are no products in your shopping cart!<br/>
								We hope it\'s not for long.', 'mazine'); ?>
								<p> <a target='_parent' href="<?php echo get_option('product_list_url'); ?>"><?php echo __('Visit the shop', 'wpsc'); ?></a></p>
							</div>	
<?php endif; ?>
</div>
<?php
//wpsc_google_checkout();


?>