<?php
/**
 * Pomocník pro vložení kódu Google Analytics
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_GA')) {

	class NasWP_GA
	{
		public $id;

		public function __construct($id)
		{
			$this->id = $id;
		}

		public function init()
		{
			add_action('wp_head', array($this, 'ga_code'));
		}

		public function ga_code()
		{
			?>
			<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->id; ?>"></script>
			<script>window.dataLayer = window.dataLayer || [];

				function gtag() {
					dataLayer.push(arguments);
				}

				gtag('js', new Date());
				gtag('config', '<?php echo $this->id;?>');</script>
		<?php }

	}
}
