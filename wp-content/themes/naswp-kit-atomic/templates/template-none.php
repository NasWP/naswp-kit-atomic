<?php
/**
 * Template Name: Jen obsah
 *
 * Bez hlavičky a patičky - pouze obsah.
 *
 * @package Atomic Blocks
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->



	</div><!-- #content -->
</div><!-- #page .container -->
<?php wp_footer(); ?>
</body>
</html> 