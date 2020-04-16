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
