<?php
/**
 * Template for Category Pages
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
				<h1><?php
					printf( __( 'Kategorie: %s', 'sprachkonstrukt' ), '' . single_cat_title( '', false ) . '' );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				get_template_part( 'loop', 'category' );
				?>

<?php
get_template_part( 'loop', 'archive' );

get_footer(); ?>