<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
						<main id="main" role="main" class="row" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
                            <?php
                                $counter = 0;
                                $thumbail_rand = glob(__DIR__."/library/images/random/*");
                            ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php
                                $thumbnail = !empty(get_the_post_thumbnail_url(get_the_ID(),'full'))?"<img src=\"".get_the_post_thumbnail_url(get_the_ID(),'full')."\">": "<img src=\"".get_template_directory_uri() . "/" . explode("/poster_blog/",$thumbail_rand[rand(0, count($thumbail_rand)-1)])[1]."\">";
                                    if($counter%2):
                                ?>
                                    <div class=" project headline"  id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
                                        <a class="section_headline" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2 class="title"><?php the_title(); ?></h2></a>
                                        <div class="h_line"></div>
                                        <p class="byline entry-meta vcard">
                                            <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                                                /* the time the post was published */
                                                '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                                                /* the author of the post */
                                                '<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                                            ); ?>
                                        </p>

                                        <?php echo TruncateHTML::truncateWords(get_the_content(), '150', '...'); ?>
                                    </div>
                                    <figure class="project proof">
                                        <?=$thumbnail ?>
                                    </figure>
                                <?php else: ?>
                                    <figure class="project proof">
                                        <?=$thumbnail?>
                                    </figure>
                                    <div class="article-header project headline"  id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
                                        <a class="section_headline" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2 class="title"><?php the_title(); ?></h2></a>
                                        <div class="h_line"></div>
                                        <p class="byline entry-meta vcard">
                                            <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                                                /* the time the post was published */
                                                '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                                                /* the author of the post */
                                                '<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                                            ); ?>
                                        </p>

                                        <?php echo TruncateHTML::truncateWords(get_the_content(), '150', '...'); ?>
                                    </div>
                                <?php endif;?>
							<?php $counter++; endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</main>

					<?php get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>
