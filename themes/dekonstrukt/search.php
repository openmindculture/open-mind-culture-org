<?php
/**
 * Template for Search Result Pages
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */

get_header(); 

if ( have_posts() ) {
	the_post();
?>
				<h1><?php printf( __( 'Search results for: %s', 'sprachkonstrukt' ), '' . get_search_query() . '' ); ?></h1>
				<?php get_template_part( 'loop', 'archive' ); ?>

<?php } else { ?>
		<h1><?php _e( 'Not Found', 'sprachkonstrukt' ); ?></h1>
			<p><?php _e( 'No results were found, sorry.', 'sprachkonstrukt' ); ?></p>
<?php } ?>


<?php get_footer(); ?>