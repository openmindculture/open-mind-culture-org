<?php
/**
 * Loop for displaying posts 
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */
 
if (have_posts()) : 
	while (have_posts()) : the_post(); ?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title=" <?php the_title(); ?>">
		<?php the_title(); ?>
		</a></h1>
	<?php if ( is_archive() || is_search() ) : /* Only display excerpts for archives and search. */ ?>
		<?php the_excerpt(); ?>
	<?php else : ?>
		<?php the_content(__( 'Continue reading &rarr;', 'sprachkonstrukt' )); ?>
		
		<p class="entry_pages">		
						<?php wp_link_pages(array('before' => '<strong>'.__( 'Pages', 'sprachkonstrukt' ).':</strong> ', 'after' => '', 'next_or_number' => 'number')); ?>
					</p>  
	<?php endif; ?>
	<footer class="entry_meta">
		<br />
		<a href="<?php the_permalink(); ?>" title="<?php _e('Permalink', 'sprachkonstrukt'); ?>">#</a>
        <time datetime="<?php the_time('c') ?>"><?php the_time(get_option('date_format')); ?>, <?php the_time(); ?></time>
		<br />
		<?php the_category(' | ') ?><br />
		<?php the_tags(__( 'Tags', 'sprachkonstrukt' ).': ', ' | ', '<br />') ?>
		<?php 
            /* comments_popup_link( __( '0 Comments', 'sprachkonstrukt' ), __( '1 Comment', 'sprachkonstrukt' ), __( '% Comments', 'sprachkonstrukt' ), '', '' );
            */
        ?>
		<?php edit_post_link( __( 'Edit', 'sprachkonstrukt' ), '', '' ); ?>
	</footer>
</article>

<?php endwhile; ?>



<div class="prevnextlinks">
	<p class="right"><?php next_posts_link( __( 'Previous posts', 'sprachkonstrukt' ).' &rarr;' ); ?></p>
	<p class="left"><?php previous_posts_link( '&larr; '.__( 'Later posts', 'sprachkonstrukt' ) ); ?></p>
</div>

		
<?php else : ?>
<h1><?php _e( 'Not Found', 'sprachkonstrukt' ); ?></h1>
			<p><?php _e( 'No results were found, sorry.', 'sprachkonstrukt' ); ?></p>
<?php endif; ?>
