<?php
/**
 * Template for (Date-)Archive Pages
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
				<h1>
					<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', 'sprachkonstrukt' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', 'sprachkonstrukt' ), get_the_date('F Y') ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', 'sprachkonstrukt' ), get_the_date('Y') ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'sprachkonstrukt' ); ?>
					<?php endif; ?>
				</h1>

<?php
rewind_posts();
get_template_part( 'loop', 'archive' );

get_footer(); ?>