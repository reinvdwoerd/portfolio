<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<div class="small-12 medium-6 large-4 columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style1'); ?> role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('werkstatt-blog'); ?>
			</a>
		</figure>
		<?php } ?>
		<aside class="post-category">
			<?php the_category(', '); ?>
		</aside>
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