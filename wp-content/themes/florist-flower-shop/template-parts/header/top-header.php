<?php
/**
 * The template part for top header
 *
 * @package Florist Flower Shop
 * @subpackage florist-flower-shop
 * @since florist-flower-shop 1.0
 */
?>
<?php if (get_theme_mod('florist_flower_shop_hide_show_topbar_section', true) == 1 || get_theme_mod( 'florist_flower_shop_resp_topbar_hide_show', true) == 1) {  ?>
	<div class="top-bar">
	  	<div class="container">
		  	<div class="row">
		  		<div class="col-lg-7 col-md-4">
		  			<div class="marquee-text">
				    	<?php if( get_theme_mod('florist_flower_shop_top_bar_text') != ''){ ?>
			      			<marquee class="py-2 py-lg-3 py-md-3 mb-0 text-center text-md-start text-lg-start"><?php echo esc_html(get_theme_mod('florist_flower_shop_top_bar_text',''));?></marquee>
				    	<?php } ?>
				    </div>
				</div>
				<div class="col-lg-3 col-md-5">
					<?php if (is_active_sidebar('social-links')) : ?>
						<?php dynamic_sidebar('social-links'); ?>
					<?php else : ?>
			              <!-- Default Social Icons Widgets -->
			              <div class="widget">
			                  <ul class="custom-social-icons" >
			                  		<li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
			                      	<li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>
			                      	<li><a href="https://instgram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
			                      	<li><a href="https://pinterest.com" target="_blank"><i class="fab fa-pinterest"></i></a></li>
			                      	<li><a href="https://whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a></li>			   	
			                  </ul>
			              </div>
			        <?php endif; ?> 	
				</div>
				<div class="col-lg-2 col-md-3">
			        <?php if( get_theme_mod('florist_flower_shop_contact_us_link') != '' || get_theme_mod('florist_flower_shop_contact_us_text') != ''){ ?>
			          	<div class="get-start-btn py-2 px-3 text-center my-2">
			            	<a href="<?php echo esc_url(get_theme_mod('florist_flower_shop_contact_us_link',''));?>"><?php echo esc_html(get_theme_mod('florist_flower_shop_contact_us_text',''));?></a>
			          	</div>
			        <?php } ?>
				</div>
			</div>
	  	</div>
	</div>
<?php }?>	
