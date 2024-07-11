<?php get_header(); ?>

<div class="govuk-width-container">
	<a href="#" class="govuk-back-link">Back</a>
	<main class="govuk-main-wrapper">
		<div class="govuk-grid-row">
			<div class="govuk-grid-column-two-thirds">
				<h1 class="govuk-heading-xl"><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="govuk-grid-row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="govuk-grid-column-full-width">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
						
						<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<?php /*
						<p class="byline entry-meta vcard">
							<?php printf( __
								( 'Posted', 'gdstheme' ).' %1$s %2$s',
								'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
								'<span class="by">'.__( 'by', 'gdstheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
							); ?>
						</p>
						*/
						?>

						<section>
							<?php the_content(); ?>
						</section>

					</article>
				</div>
			<?php endwhile; ?>

					<?php gdstheme_page_navi(); ?>

			<?php else : ?>

					<article id="post-not-found" class="govuk-grid-column-full">
						<?php gdstheme_error('Post not found'); ?>
					</article>

			<?php endif; ?>
		</div>
		
	</main>
</div>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
