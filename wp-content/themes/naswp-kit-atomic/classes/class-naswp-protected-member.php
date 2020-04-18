<?php
/**
 * Jednoduchá member sekce
 * Přepisuje funkcionalitu příspěvků chráněných heslem - místo zadání hesla vyžaduje přihlášení uživatele.
 * Pro použití stačí nastavit příspěvky jako chráněné a nastavit jim libovolné heslo.
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Protected_Member')) {

	class NasWP_Protected_Member
	{

		private $protected_prefix;


		public function __construct($protected_prefix = false)
		{
			$this->protected_prefix = $protected_prefix;
		}

		public function init()
		{

			add_action('template_redirect', array($this, 'auth_redir'));
			add_filter('post_password_required', array($this, 'login_access'), 10, 2);
			add_action('admin_head', array($this, 'highlight_protected'));
			add_action('pre_get_posts', array($this, 'hide_protected'));

			if ($this->protected_prefix !== false) {
				add_filter('protected_title_format', array($this, 'title_format'), 10, 2);
			}

		}


		public function auth_redir()
		{
			$post = get_post();
			if (!is_user_logged_in() && !empty($post->post_password)) {
				auth_redirect();
			}
		}

		public function login_access($protected, $post)
		{
			if ($protected && is_user_logged_in()) {
				$protected = false;
			}
			return $protected;
		}


		public function title_format($format, $post)
		{
			if (is_user_logged_in()) {
				$format = $this->protected_prefix . '%s';
			}
			return $format;

		}

		function highlight_protected()
		{
			echo '<style type="text/css">.striped>tbody>:nth-child(odd).post-password-protected{background-color:#ffeaea}.striped>tbody>:nth-child(even).post-password-protected{background-color:#fff1f1}</style>';
		}


		function hide_protected($query)
		{
			if (!$query->is_singular() && !is_user_logged_in()) {
				$query->set('has_password', false);
			}
		}
	}
}
