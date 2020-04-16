<?php
/**
 * Pomocník pro nastavení základních chybějících SEO Metadat
 *
 * Metabox pro nastavení meta description
 * Nastavení og:image pokud je k dispozici náhledový obrázek
 *
 *  @author Vladimír Smitka, Lynt.cz
 *
*/
if (!class_exists('NasWP_SEO')) {
	class NasWP_SEO
	{


		private $id = 'naswp-seo';
		private $prefix = 'naswp_';

		private $screens = array(
			'post',
			'page',
		);
		private $fields = array(
			array(
				'id' => 'meta-description',
				'label' => 'Meta Description',
				'type' => 'textarea',
			),
		);

		public function init()
		{
			add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
			add_action('save_post', array($this, 'save_post'));
			add_action('wp_head', array($this, 'meta_description'));
			add_action('wp_head', array($this, 'og_image'));
		}

		/**
		 * Hooks into WordPress' add_meta_boxes function.
		 * Goes through screens (post types) and adds the meta box.
		 */
		public function add_meta_boxes()
		{
			foreach ($this->screens as $screen) {
				add_meta_box(
					$this->id,
					__('SEO', 'naswp-atomic'),
					array($this, 'add_meta_box_callback'),
					$screen,
					'side',
					'default'
				);
			}
		}

		/**
		 * Generates the HTML for the meta box
		 *
		 * @param object $post WordPress post object
		 */
		public function add_meta_box_callback($post)
		{
			wp_nonce_field($this->id . '_data', $this->id . '_nonce');
			$this->generate_fields($post);
		}

		/**
		 * Generates the field's HTML for the meta box.
		 */
		public function generate_fields($post)
		{
			$output = '';
			foreach ($this->fields as $field) {
				$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
				$db_value = get_post_meta($post->ID, $this->prefix . $field['id'], true);
				switch ($field['type']) {
					case 'textarea':
						$input = sprintf(
							'<textarea id="%s" name="%s" rows="5" style="width:100%%">%s</textarea>',
							$field['id'],
							$field['id'],
							$db_value
						);
						break;
					default:
						$input = sprintf(
							'<input id="%s" name="%s" type="%s" value="%s" style="width:100%%">',
							$field['id'],
							$field['id'],
							$field['type'],
							$db_value
						);
				}
				$output .= '<p>' . $label . '<br />' . $input . '</p>';
			}
			echo $output;
		}

		/**
		 * Hooks into WordPress' save_post function
		 */
		public function save_post($post_id)
		{
			if (!isset($_POST[$this->id . '_nonce']))
				return $post_id;

			$nonce = $_POST[$this->id . '_nonce'];
			if (!wp_verify_nonce($nonce, $this->id . '_data'))
				return $post_id;

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;

			foreach ($this->fields as $field) {
				if (isset($_POST[$field['id']])) {
					switch ($field['type']) {
						case 'email':
							$_POST[$field['id']] = sanitize_email($_POST[$field['id']]);
							break;
						case 'text':
							$_POST[$field['id']] = sanitize_text_field($_POST[$field['id']]);
							break;
						case 'textarea':
							$_POST[$field['id']] = sanitize_text_field($_POST[$field['id']]);
							break;
					}
					update_post_meta($post_id, $this->prefix . $field['id'], $_POST[$field['id']]);
				} else if ($field['type'] === 'checkbox') {
					update_post_meta($post_id, $this->prefix . $field['id'], '0');
				}
			}
		}

		function meta_description()
		{
			if (is_singular()) {
				$des_post = get_post_meta(get_the_ID(), 'naswp_meta-description', true);
				echo '<meta name="description" content="' . $des_post . '" />' . "\n";
			}

			if (is_category()) {
				$des_cat = strip_tags(category_description());
				if ($des_cat) echo '<meta name="description" content="' . $des_cat . '" />' . "\n";
			}
		}


		function og_image()
		{
			if (is_singular()) {
				$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
				if ($thumb) {
					echo '<meta property="og:image" content="' . $thumb . '" />';
				}
			}
		}

	}
}
