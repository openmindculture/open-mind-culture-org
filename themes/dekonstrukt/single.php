<?php
/**
 * Main Template File for a single post
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ 

get_header(); 

if (have_posts()) : 
	while (have_posts()) : the_post(); ?>

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title=" <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
					<?php the_content(); ?>
	
		
					<p class="entry_pages">		
						<?php wp_link_pages(array('before' => '<strong>'.__( 'Pages', 'sprachkonstrukt' ).':</strong> ', 'after' => '', 'next_or_number' => 'number')); ?>
					</p>  				
					
<?php endwhile; endif; ?>
	
					<footer class="entry_meta">
						<br />
						<a href="<?php the_permalink(); ?>" title="<?php _e('Permalink', 'sprachkonstrukt'); ?>">#</a> <time datetime="<?php the_time('c') ?>"><?php the_time(get_option('date_format')); ?>, <?php the_time(); ?></time>
						<br />
						<?php the_category(' | ') ?><br />
						<?php the_tags(__( 'Tags', 'sprachkonstrukt' ).': ', ' | ', '<br />') ?>
						<?php comments_popup_link( __( '0 Comments', 'sprachkonstrukt' ), __( '1 Comment', 'sprachkonstrukt' ), __( '% Comments', 'sprachkonstrukt' ), '', '' ); ?>
						<?php edit_post_link( __( 'Edit', 'sprachkonstrukt' ), '', '' ); ?>
					</footer>
				</article>
				
				<div class="prevnextlinks">
					<p class="left"><?php previous_post_link(); ?></p>
					<p class="right"><?php next_post_link() ; ?></p>
				</div>
				<p class="clear"></p>
				
<?php comments_template(); ?>

<?php get_footer(); ?>