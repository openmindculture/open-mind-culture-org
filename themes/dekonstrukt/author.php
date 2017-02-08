<?php
/**
 * Template for Author Archive Pages
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */

get_header(); 

if ( have_posts() )
	the_post();
?>
				<h1><?php printf( __( 'Author Archives: %s', 'sprachkonstrukt' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>


<?php
rewind_posts();
get_template_part( 'loop', 'archive' );

get_footer(); ?>