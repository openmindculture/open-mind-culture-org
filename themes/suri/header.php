<?php
/**
 * Header Template Part
 *
 * Template part file that contains the HTML document head and opening HTML
 * body elements as well as the site header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suri
 * @since 0.0.1
 */

?><!DOCTYPE html><?php
/**
 * Fires immediately before site html tag.
 *
 * @since 0.0.1
 */
do_action( 'suri_hook_before_html' ); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head<?php suri_attr( 'head' );?>><?php wp_head(); ?></head>
<body<?php suri_attr( 'body' ); ?> <?php body_class(); ?>>

<?php
/**
 * Fires immediately after opening of main body tag.
 *
 * @since 0.0.1
 */
do_action( 'suri_hook_on_top_of_body' ); ?>

<div id="page"<?php suri_attr( 'site' ); ?>>

	<?php
	/**
	 * Fires immediately before opening of main header tag.
	 *
	 * @since 0.0.1
	 */
	do_action( 'suri_hook_before_header' ); ?>

	<header id="masthead" role="banner" <?php suri_attr( 'site-header' ); ?>>

		<?php
		/**
		 * Fires immediately after opening of main header tag.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_on_top_of_header' ); ?>

		<?php if ( has_action( 'suri_hook_for_header_items' ) ) : ?>
			<div<?php suri_attr( 'header-items' ); ?>>

				<?php
				/**
				 * Fires immediately after opening of header-items tag.
				 *
				 * @since 0.0.1
				 */
				do_action( 'suri_hook_for_header_items' );?>

			</div><!-- .header-items -->
		<?php endif; ?>

		<?php
		/**
		 * Fires immediately before closing of header tag.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_bottom_of_header' );?>

	</header><!-- #masthead -->

	<?php
	/**
	 * Fires immediately after closing of header tag.
	 *
	 * @since 0.0.1
	 */
	do_action( 'suri_hook_after_header' );?>

	<div id="content"<?php suri_attr( 'site-content' ); ?>>

		<?php
		/**
		 * Fires immediately after opening of main content tag.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_on_top_of_site_content' );?>
