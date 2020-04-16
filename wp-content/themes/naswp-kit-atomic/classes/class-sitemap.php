<?php
/**
 * Pomocník pro vygenerování základní sitemapy
 *
 * generuje statický sitemap.xml při publikaci článku/stránky
 * přidá odkaz na sitemapu do virtuálního robots.txt
 *
 *  @author Vladimír Smitka, Lynt.cz
 *
*/
if (!class_exists('NasWP_Sitemap')) {

	class NasWP_Sitemap
	{

		public function init()
		{

			add_action("publish_post", array($this, "sitemap"));
			add_action("publish_page", array($this, "sitemap"));
			add_filter('robots_txt', array($this, 'robotstxt'), 20, 2);

		}

		public function sitemap()
		{
			$postsForSitemap = get_posts(array(
				'numberposts' => -1,
				'orderby' => 'modified',
				'post_type' => array('post', 'page'),
				'order' => 'DESC'
			));

			$sitemap = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			foreach ($postsForSitemap as $post) {
				setup_postdata($post);

				$postdate = explode(" ", $post->post_modified);

				$sitemap .= '<url>' .
					'<loc>' . get_permalink($post->ID) . '</loc>' .
					'<lastmod>' . $postdate[0] . '</lastmod>' .
					'<changefreq>weekly</changefreq>' .
					'</url>';
			}

			$sitemap .= '</urlset>';

			$fp = fopen(ABSPATH . "sitemap.xml", 'w');
			fwrite($fp, $sitemap);
			fclose($fp);
		}

		function robotstxt($output, $public)
		{
			$homeURL = get_home_url();
			$output .= "Sitemap: $homeURL/sitemap.xml\n";
			return $output;
		}

	}
}
