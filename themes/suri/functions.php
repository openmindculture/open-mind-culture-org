<?php
/**
 * Suri theme functions and definitions
 *
 * This file defines content width, add theme support for various wordpress
 * features, load required stylesheets and scripts, register menus and widget
 * areas and load other required files to extend theme functionality.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Suri
 * @since 0.0.1
 */

/* MOD disable emoji styles and functions */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'disable_wp_emojicons' );
/* MOD disable emoji styles and functions END */

/**
 * Suri Theme intialization.
 *
 * @since 0.0.3
 */
class Suri_Init {

	/**
	 * Constructor method intentionally left blank.
	 *
	 * @since 0.0.3
	 */
	private function __construct() {}

	/**
	 * Setup function runs immediately at the end of this file.
	 *
	 * @since 0.0.3
	 */
	public static function setup() {
		if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) :

			/**
			 * Backward compatibility as Suri Theme only works in WordPress 4.2 or later.
			 */
			require get_template_directory() . '/inc/class-back-compat.php';
		endif;

		// Actions to call theme setup functions.
		add_action( 'after_setup_theme'      , array( __CLASS__, 'content_width' ), 0 );
		add_action( 'after_setup_theme'      , array( __CLASS__, 'after_setup_theme' ), 5 );
		add_action( 'after_setup_theme'      , array( __CLASS__, 'include_files' ), 5 );
		add_action( 'widgets_init'           , array( __CLASS__, 'register_sidebar' ) );
		add_action( 'wp_enqueue_scripts'     , array( __CLASS__, 'enqueue_scripts' ) );
		add_filter( 'wp_resource_hints'      , array( __CLASS__, 'resource_hints' ), 10, 2 );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * @since 0.0.3
	 *
	 * @global int $content_width
	 */
	public static function content_width() {

		/**
		 * Filter maximum allowed width for any content in the theme.
		 *
		 * @since 0.0.3
		 */
		$GLOBALS['content_width'] = apply_filters( 'suri_content_width', 720 );
	}

	/**
	 * Register theme features.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.0.3
	 */
	public static function after_setup_theme() {
		// Make theme available for translation.
		load_theme_textdomain( 'suri', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'suri-small-thumbnail' , 150, 150, true );
		add_image_size( 'suri-medium-thumbnail', 220, 180, true );
		add_image_size( 'suri-large-thumbnail' , 720, 445, true );

		// Allows the use of valid HTML5 markup.
		add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		if ( 1 === get_theme_mod( 'suri_no_web_fonts', '' ) ) :
			$editor_styles = 'resources/css/editor-style.css';
		else :
			$editor_styles = array( 'resources/css/editor-style.css', self::google_font_url() );
		endif;

		// Add custom styles for visual editor to resemble the theme style.
		add_editor_style( $editor_styles );

		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary', 'suri' ),
			'header'    => esc_html__( 'Header', 'suri' ),
			'footer'    => esc_html__( 'Footer', 'suri' ),
			'social'    => esc_html__( 'Social', 'suri' ),
		) );

		/**
		 * Filter custom background args.
		 *
		 * @since 0.0.3
		 */
		$suri_custom_background_args = apply_filters(
			'suri_custom_background_args', array(
				'default-color' => 'f2f2f2',
				'default-image' => '',
			)
		);
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', $suri_custom_background_args );

		/**
		 * Filter custom logo args.
		 *
		 * @since 0.0.3
		 */
		$suri_custom_logo_args = apply_filters(
			'suri_custom_logo_args', array(
				'flex-width'             => true,
				'flex-height'            => true,
				'width'                  => 56,
				'height'                 => 56,
			)
		);
		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', $suri_custom_logo_args );

		/**
		 * Filter custom header args.
		 *
		 * @since 0.0.3
		 */
		$suri_custom_header_args = apply_filters(
			'suri_custom_header_args', array(
				'default-image'          => '',
				'width'                  => 1600,
				'height'                 => 400,
				'flex-width'             => true,
				'flex-height'            => true,
				'header-text'            => true,
				'default-text-color'     => '',
				'wp-head-callback'       => 'suri_header_style',
				'admin-head-callback'    => '',
				'admin-preview-callback' => '',
			)
		);
		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', $suri_custom_header_args );

		/**
		 * Filter support for suri theme specific features.
		 *
		 * @since 0.0.3
		 */
		$suri_theme_support = apply_filters( 'suri_theme_support', array( 'schema', 'thumb', 'genericons' ) );
		foreach ( $suri_theme_support as $support ) {
			// Custom addon support for suri theme.
			add_theme_support( "suri_{$support}" );
		}
	}

	/**
	 * Register widget area.
	 *
	 * @since 0.0.3
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public static function register_sidebar() {

		/**
		 * Filter register widgets args.
		 *
		 * @since 0.0.3
		 */
		$widgets = apply_filters(
			'suri_register_sidebar', array(
				array(
					'name' => esc_html__( 'Sidebar', 'suri' ),
					'id' => 'sidebar-1',
					'description' => '',
				),
				array(
					'name' => esc_html__( 'Header', 'suri' ),
					'id' => 'header',
					'description' => '',
				),
				array(
					'name' => esc_html__( 'footer-widget-1', 'suri' ),
					'id' => 'footer-1',
					'description' => '',
				),
				array(
					'name' => esc_html__( 'footer-widget-2', 'suri' ),
					'id' => 'footer-2',
					'description' => '',
				),
				array(
					'name' => esc_html__( 'footer-widget-3', 'suri' ),
					'id' => 'footer-3',
					'description' => '',
				),
			)
		);
		foreach ( $widgets as $widget ) {
			register_sidebar( array(
				'name'          => $widget['name'],
				'id'            => $widget['id'],
				'description'   => $widget['description'],
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3' . suri_get_attr( 'widget-title' ) . '>',
				'after_title'   => '</h3>',
			) );
		}
	}

	/**
	 * Get Google fonts url to regesiter and enqueue.
	 *
	 * This function incorporates code from Twenty Fifteen WordPress Theme,
	 * Copyright 2014-2016 WordPress.org & Automattic.com Twenty Fifteen is
	 * distributed under the terms of the GNU GPL.
	 *
	 * @since 0.1.3
	 *
	 * @return string Google fonts URL for the theme.
	 */
	public static function google_font_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Roboto, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'suri' ) ) :
			$fonts[] = 'Roboto:400italic,700italic,400,700';
		endif;

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'suri' ) ) :
			$fonts[] = 'Noto Serif:700italic,700';
		endif;

		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'suri' );

		if ( 'cyrillic' === $subset ) :
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' === $subset ) :
			$subsets .= ',greek,greek-ext';
		elseif ( 'devanagari' === $subset ) :
			$subsets .= ',devanagari';
		elseif ( 'vietnamese' === $subset ) :
			$subsets .= ',vietnamese';
		endif;

		if ( $fonts ) :
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		endif;

		/**
		 * Filter google font url.
		 *
		 * @since 0.1.3
		 */
		return apply_filters( 'suri_google_font_url', $fonts_url );
	}

	/**
	 * Add preconnect for Google Fonts.
	 *
	 * This function incorporates code from Twenty Seventeen WordPress Theme,
	 * Copyright 2016-2017 WordPress.org. Twenty Seventeen is distributed
	 * under the terms of the GNU GPL.
	 *
	 * @since 0.2.4
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	public static function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'suri-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 0.0.3
	 */
	public static function enqueue_scripts() {
		wp_enqueue_style( 'suri-style', get_stylesheet_uri() );
		wp_enqueue_script( 'suri-scripts', get_template_directory_uri() . '/resources/js/scripts.js', array(), '1.0.0', true );

		if ( 1 !== get_theme_mod( 'suri_no_web_fonts', suri_get_theme_defaults( 'suri_no_web_fonts' ) ) ) :
			wp_enqueue_style( 'suri-fonts', esc_url( self::google_font_url() ) );
		endif;

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
			wp_enqueue_script( 'comment-reply' );
		endif;
	}

	/**
	 * Load theme core and addon files
	 *
	 * @since 0.0.3
	 */
	public static function include_files() {
		$suri_dir = trailingslashit( get_template_directory() );
		$essential_files = array(
			'helper/function-attr',
			'helper/function-defaults',
			'helper/function-header-style',
			'helper/function-inline-css',
			'helper/function-thumbnails',
			'class-plugin-support',
			'class-display',
			'class-filters',
			'customizer/class-active',
			'customizer/class-data',
			'customizer/class-sanitization',
		);
		foreach ( $essential_files as $file ) {
			/**
			 * Load theme core functions files.
			 */
			require_once( "{$suri_dir}inc/{$file}.php" );
		}
		$addon_files = array(
			'thumb'        => array( 'thumb', 'set-thumbnail', 'delete-thumbnail' ),
			'schema'       => array( 'schema' ),
			'genericons'   => array( 'fonticon-data', 'genericons' ),
		);
		foreach ( $addon_files as $feature => $files ) {
			foreach ( $files as $file ) {
				/**
				 * Conditionally load theme addon files.
				 */
				require_if_theme_supports( "suri_{$feature}", "{$suri_dir}addon/{$feature}/{$file}.php" );
			}
		}

		/**
		 * Load theme customizer file at last.
		 */
		require_once( "{$suri_dir}inc/customizer/class-customizer.php" );
	}
}

Suri_Init::setup();
