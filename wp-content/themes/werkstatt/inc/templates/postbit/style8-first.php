<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<?php 
	$image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, 'blog-large'); 
	$vars = $wp_query->query_vars;
	$columns = array_key_exists('columns', $vars) ? ($vars['columns'] == '3' ? 'large-8' : 'large-6') : 'large-6';	
?>
<div class="small-12 <?php echo esc_attr($columns); ?> columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style1 style8 style8-first'); ?> role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery" style="background-image: url(<?php echo esc_attr($image_url[0]); ?>)">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
			</a>
		</figure>
		<?php } ?>
		<header class="post-title entry-header">
			<?php the_title('<h4 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h4>'); ?>
		</header>
		<div class="post-content">
			<?php the_excerpt(); ?>
		</div>
		<aside class="post-meta">
			<?php the_author_posts_link(); ?> <?php esc_html_e('on', 'werkstatt'); ?> <?php echo get_the_date(); ?>
		</aside>
	</article>
</div>