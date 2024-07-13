<?php get_header(); ?>
<div class="govuk-width-container">
	<?php if(!is_front_page()): ?>
	<a href="/" class="govuk-back-link">Back</a>
	<?php endif; ?>
	<main class="govuk-main-wrapper ">
		<div class="govuk-grid-row govuk-width-container">
			<div class="govuk-grid-column-full-width">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					
					<h1 class="govuk-heading-l"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<div class="govuk-inset-text">
					<?php printf( __
							( 'Posted', 'gdstheme' ).' %1$s %2$s',
							'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
							'<span class="by">'.__( 'by', 'gdstheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
						); ?>	
					</div>
					<?php if(has_post_thumbnail()):?>
						<div class="featured">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>
					<section>
						<?php the_content(); ?>
					</section>

				</article>

				<?php endwhile; ?>

					<?php gdstheme_page_navi(); ?>

				<?php else : ?>

				<article id="post-not-found" class="govuk-grid-column-full">
					<?php gdstheme_error('Post not found'); ?>
				</article>

				<?php endif; ?>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
