<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-all d-all cf">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> >


								<section class="entry-content cf">
									<?php
										
										the_content();

									?>
								</section> <?php // end article section ?>

							</article>

							<?php endwhile; endif; ?>

						</main>


				</div>

			</div>

<?php get_footer(); ?>
