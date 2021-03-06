<?php 
	$id = get_the_ID();
	$fs_all = get_post_meta($id, 'fs_all', true);
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$fs_autoplay_speed = get_post_meta($id, 'fs_autoplay_speed', true) ? get_post_meta($id, 'fs_autoplay_speed', true) : 5000;
	$fs_autoplay = get_post_meta($id, 'fs_autoplay', true) == 'on' ? $fs_autoplay_speed : false;
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$total = sizeof($fs_slides);
	
	$portfolios = array();
?>
<div class="style4-container">
	<div class="swiper-container full-page style4 thb-portfolio" data-autoplay="<?php echo esc_attr($fs_autoplay); ?>">
	   <div class="swiper-wrapper">
			<?php $i = 1; foreach ($fs_slides as $slide) { 
				$id = $slide['portfolio'];
				$image_id = get_post_thumbnail_id($id);
				$image_url = wp_get_attachment_image_src($image_id, 'full');
				
				$main_color = get_post_meta($id, 'main_color', true);
				$main_color_title = get_post_meta($id, 'main_color_title', true);
				
				$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
				if ($categories !== '') {
					$categories = strip_tags($categories);
				}
				
				$title = get_the_title($id);
				
				$main_listing_type = get_post_meta($id, 'main_listing_type', true);
				$permalink = '';
				if ($main_listing_type == 'link') {
					$permalink = get_post_meta($id, 'main_listing_link', true);	
				} else {
					$permalink = get_the_permalink();	
				}
				
				$portfolios[] = array(
					'title' => $title,
					'image_id' => $image_id,
					'cats' => $categories,
					'link' => $permalink
				);
			?>
				<div class="swiper-slide center-contents type-portfolio">
					<div class="row align-center">
						<div class="small-12 medium-8 columns">
							<h1><span><a href="<?php echo esc_attr($permalink); ?>"><?php echo get_the_title($id); ?></a></span></h1>
							<aside class="thb-categories"><span><?php echo esc_html($categories); ?></span></aside>
						</div>
					</div>
				</div>
			<?php $i++; } ?>
		</div>
		
	</div>
	<?php if ($fs_all !== 'off') { ?>
	<a href="#" title="<?php esc_attr('All Projects','werkstatt'); ?>" class="show-all fixed">
		<?php esc_html_e('All Projects','werkstatt'); ?>
	</a>
	<?php } ?>
	<div class="swiper-pagination"></div>
	<div class="swiper-container style4-thumbnails thb-portfolio">
		<div class="swiper-wrapper">
			<?php 
				 foreach ($portfolios as $portfolio) {
				 	$image_url = wp_get_attachment_image_src($portfolio["image_id"], 'full');
				 	echo '
				 	<div class="swiper-slide">
				 		<a href="'. esc_attr($portfolio["link"]) .'" class="slider-inner" style="background-image:url('. esc_attr($image_url[0]) .')">
				 		</a>
				 	</div>';
				 }
			?>
		</div>
	</div>
</div>
<?php do_action('thb_show_all', $portfolios); ?>