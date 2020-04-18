<?php
/**
 * Template Name: Bez nadpisu
 *
 * Bez nadpisu - nadpis je třeba udělat vlastní v editoru.
 *
 * @package Atomic Blocks
 */

get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer(); ?>
