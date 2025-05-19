<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-all d-all cf" >

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> >

								<header class="article-header">

									<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>"  title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
                                                    
                                                    <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                       								/* the time the post was published */
                       								'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" >' . bones_get_the_author_posts_link() . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">
									<?php the_excerpt(); 


									?>								

								</section>


							</article>

							<?php endwhile; ?>

							
							<?php  bones_page_navi(); ?>


							<?php endif; ?>
							<?php
							global $wp_query; // you can remove this line if everything works for you
							 
							// don't display the button if there are not enough posts
							if (  $wp_query->max_num_pages > 1 )
								echo '<div class="misha_loadmore">More posts</div>'; // you can use <a> as well
							?>


						</main>


				</div>

			</div>


<?php get_footer(); ?>
