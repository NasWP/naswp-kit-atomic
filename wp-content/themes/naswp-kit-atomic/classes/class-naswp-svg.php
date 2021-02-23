<?php
/**
 * Pomocník pro nahrávání svg - přidá svg do poloných typů ouborů, sanitizuje a opraví zobrazování svg v Médiích
 *
 * Helper class for uploading svg - adds svg into allowed mime types, sanitizes it and adds a preview in Media gallery
 *
 * @category NasWP
 * @package  NasWP_SVG
 * @author   Karolína Vyskočilová <karolina@kybernaut.cz>
 */

// Load Composer dependencies.
require_once( __DIR__ . '/../vendor/autoload.php' );

use enshrined\svgSanitize;

if ( ! class_exists( 'NasWP_SVG' ) ) {

	/**
	 * Template Class Doc Comment
	 *
	 * Template Class
	 *
	 * @category NasWP
	 * @package  NasWP_SVG
	 * @author   Karolína Vyskočilová <karolina@kybernaut.cz>
	 */
	class NasWP_SVG {

		/**
		 * The sanitizer
		 *
		 * @var \enshrined\svgSanitize\Sanitizer
		 */
		protected $sanitizer;

		/**
		 * Hook into WordPress
		 *
		 * @return void
		 */
		public function init() {
			$this->sanitizer = new svgSanitize\Sanitizer();
			$this->sanitizer->minify( true );

			add_filter( 'upload_mimes', array( $this, 'svg_upload_mimes' ) );
			add_filter( 'wp_prepare_attachment_for_js', array( $this, 'svgs_response_for_svg' ), 10, 3 );
			add_filter( 'wp_check_filetype_and_ext', array( $this, 'fix_mime_type_svg' ), 75, 4 );
			add_filter( 'wp_handle_upload_prefilter', array( $this, 'check_for_svg' ) );
		}

        /**
         * Fixes the issue in WordPress 4.7.1 being unable to correctly identify SVGs
         *
         * @param array $data Data associated to the file.
         * @param string $file Full path to the file.
         * @param string $filename The name of the file (may differ from $file due to $file being in a tmp directory).
         * @param array $mimes Array of mime types keyed by their file extension regex.
         *
         * @return array
         */
        public function fix_mime_type_svg( $data, $file, $filename, $mimes = null ) {
            $ext = isset( $data['ext'] ) ? $data['ext'] : '';
            if ( strlen( $ext ) < 1 ) {
                $exploded = explode( '.', $filename );
                $ext      = strtolower( end( $exploded ) );
            }
            if ( $ext === 'svg' ) {
                $data['type'] = 'image/svg+xml';
                $data['ext']  = 'svg';
            } elseif ( $ext === 'svgz' ) {
                $data['type'] = 'image/svg+xml';
                $data['ext']  = 'svgz';
            }

            return $data;
        }

		/**
		 * Check if the file is an SVG, if so handle appropriately
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function check_for_svg( $file ) {

			if ( $file['type'] === 'image/svg+xml' ) {
				if ( ! $this->sanitize( $file['tmp_name'] ) ) {
					$file['error'] = __( "Sorry, this file couldn't be sanitized so for security reasons wasn't uploaded",'naswp-kit-atomic' );
				}
			}

			return $file;
		}

		/**
		 * Sanitize the SVG
		 *
		 * @param string $file SVG file.
		 *
		 * @return bool|int
		 */
		protected function sanitize( $file ) {
			$dirty     = file_get_contents( $file );
			$is_zipped = $this->is_gzipped( $dirty );

			// Is the SVG gzipped? If so we try and decode the string.
			if ( $is_zipped ) {
				$dirty = gzdecode( $dirty );

				// If decoding fails, bail as we're not secure.
				if ( false === $dirty ) {
					return false;
				}
			}

			$clean = $this->sanitizer->sanitize( $dirty );

			if ( false === $clean ) {
				return false;
			}

			// If we were gzipped, we need to re-zip.
			if ( $is_zipped ) {
				$clean = gzencode( $clean );
			}

			file_put_contents( $file, $clean );

			return true;
		}

		/**
		 * Check if the contents are gzipped
		 *
		 * @see http://www.gzip.org/zlib/rfc-gzip.html#member-format
		 *
		 * @param string $contents Contents of SVG file.
		 *
		 * @return bool
		 */
		protected function is_gzipped( $contents ) {
			if ( function_exists( 'mb_strpos' ) ) {
				return 0 === mb_strpos( $contents, "\x1f" . "\x8b" . "\x08" );
			} else {
				return 0 === strpos( $contents, "\x1f" . "\x8b" . "\x08" );
			}
		}

		/**
		 * Filters list of allowed mime types and file extensions.
		 *
		 * @param array $mimes Mime types keyed by the file extension regex corresponding to those types. 'swf' and 'exe' removed from full list. 'htm|html' also removed depending on '$user' capabilities.
		 *
		 * @return array $mimes
		 */
		public function svg_upload_mimes( $mimes = array() ) {
			$mimes['svg']  = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';
			return $mimes;
		}

		/**
		 * Filters the attachment data prepared for JavaScript.
		 * Base on /wp-includes/media.php
		 *
		 * @param array          $response   Array of prepared attachment data.
		 * @param integer|object $attachment Attachment ID or object.
		 * @param array          $meta       Array of attachment meta data.
		 *
		 * @return mixed $response
		 */
		public function svgs_response_for_svg( $response, $attachment, $meta ) {
			if ( 'image/svg+xml' === $response['mime'] && empty( $response['sizes'] ) ) {
				$svg_path = get_attached_file( $attachment->ID );
				if ( ! file_exists( $svg_path ) ) {
					// If SVG is external, use the URL instead of the path.
					$svg_path = $response['url'];
				}
				$dimensions        = $this->svgs_get_dimensions( $svg_path );
				$response['sizes'] = array(
					'full' => array(
						'url'         => $response['url'],
						'width'       => $dimensions->width,
						'height'      => $dimensions->height,
						'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait',
					),
				);
			}

			return $response;
		}

		/**
		 * Get dimension svg file
		 *
		 * @param string $svg Path of svg.
		 * @return object width and height.
		 */
		private function svgs_get_dimensions( $svg ) {
			$svg = simplexml_load_file( $svg );
			if ( false === $svg ) {
				$width  = '0';
				$height = '0';
			} else {
				$attributes = $svg->attributes();
				$width      = (string) $attributes->width;
				$height     = (string) $attributes->height;
			}

			return (object) array(
				'width'  => $width,
				'height' => $height,
			);
		}

	}
}
