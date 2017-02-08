<?php
/**
 * Template for 404 Error Pages
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */

get_header(); ?>

<h1><?php _e('Page not found', 'sprachkonstrukt');  ?> <small>[error 404]</small></h1>
<p><?php _e('Sorry, the page you requested could not be found.', 'sprachkonstrukt'); ?></p>

<?php get_footer(); ?>
