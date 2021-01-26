<?php
/**
 * Pomocník pro vložení kódu Google Tag Manager (GTM)
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_GTM')) {
	class NasWP_GTM
	{
		public $id;


		public function __construct($id)
		{
			$this->id = $id;
		}

		public function init()
		{
			add_action('wp_head', array($this, 'gtm_code_head'));
			add_action('wp_body_open', array($this, 'gtm_code_body'));
		}

		public function gtm_code_head()
		{
			?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $this->id;?>');</script>
			<!-- End Google Tag Manager -->
			<script>
			    window.dataLayer = window.dataLayer || [];
                            window.dataLayer.push({
		    <?php
		      $contentType = '';
		      if (is_404())        $contentType = '404';
		      if (is_page())       $contentType = 'page';
		      if (is_single())     $contentType = 'post';
		      if (is_archive())    $contentType = 'archive';
		      if (is_tax())        $contentType = 'taxonomy-list';
		      if (is_tag())        $contentType = 'tag-list';
		      if (is_category())   $contentType = 'category-list';
		      if (is_date())       $contentType = 'date-list';
		      if (is_author())     $contentType = 'author';
		      if (is_search())     $contentType = 'search';
		      if (is_home())       $contentType = 'post-list';
		      if (is_front_page()) $contentType = 'homepage';

		      echo sprintf( "'wp_contentType':'%s',", $contentType );
		      echo sprintf( "'wp_postType':'%s',", get_post_type() );

		      if  (is_single()){
			  global $post;
			  $author = get_the_author_meta( 'display_name', $post->post_author );
			  $category = get_the_category();
			  echo sprintf( "'wp_author':'%s',", $author );
			  echo sprintf( "'wp_category':'%s',", $category[0]->cat_name );
		      }

		      if (is_search()) {
			  global $wp_query;
			  echo sprintf( "'wp_searchNum':'%s',", $wp_query->found_posts );
			  echo sprintf( "'wp_searchTerm':'%s',", get_search_query() );
		      }
		    ?>
		    });
		    </script>
		<?php }

		public function gtm_code_body()
		{
			?>
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $this->id; ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php }


	}
}
