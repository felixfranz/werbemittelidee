<?php
/*
 Template Name: Product Galleries
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-all d-all cf">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> >


								<section class="entry-content cf" >
									<?php
									the_content();
										
										// Check value exists.
										if( have_rows('galleries') ):
											echo '<section class="vc_section gallery-section">';
											// Loop through rows.
											while ( have_rows('galleries') ) : the_row();

												// Case: Paragraph layout.
												if( get_row_layout() == 'product_gallery_container' ):
													$gallery_headline = get_sub_field('gallery_headline');
													// Do something...

													echo '<h2>'.$gallery_headline."</h2>";

													
													$images = get_sub_field('product_gallery');
													if( $images ): ?>
														
														
														<ul class="image-gallery">
															<?php foreach( $images as $image ): 
																$content = '<li>';
																	$content .= '<a class="gallery_image" href="'. $image['url'] .'">';
																			$content .= '<img src="'. $image['sizes']['thumbnail'] .'" alt="'. $image['alt'] .'" />';
																	$content .= '</a>';
																$content .= '</li>';
																if ( function_exists('slb_activate') ){
														$content = slb_activate($content);
														}

														echo $content;?>
															<?php endforeach; ?>
														</ul>
													<?php endif; 

												endif;

											// End loop.
											endwhile;
											echo '</section>';
										// No value.
										else :
											// Do something...
										endif;
									?>
								</section>




							</article>

							<?php endwhile; else : ?>



							<?php endif; ?>

						</main>

			

				</div>

			</div>


<?php get_footer(); ?>
