<?php
/**
 * Template for Attachement Display Pages
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */
 
get_header();


if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Back to %s', 'sprachkonstrukt' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php /* translators: %s - title of parent post */ printf( __( '&larr; %s', 'sprachkonstrukt' ), get_the_title( $post->post_parent ) ); ?></a></p>
				
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
					
						<h1><?php the_title(); ?></h1>
			
<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}	
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}		
?>			
				<p><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
					$attachment_size = apply_filters( 'sprachkonstrukt_attachment_size', 900 );
					echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); ?></a></p>
			
				<?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
		
				<?php the_content( __( 'Continue reading &rarr;', 'sprachkonstrukt' ) ); ?>
								
				<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'sprachkonstrukt' ), 'after' => '</nav>' ) ); ?>
			
				<div class="prevnextlinks">
					<p class="left"><?php previous_image_link( false, __( '&larr; Previous Image', 'sprachkonstrukt' ) ); ?></p>
					<p class="right"><?php next_image_link( false, __( 'Next Image &rarr;', 'sprachkonstrukt' ) ); ?></p>
				</div>
			
				<footer class="entry_meta">
					<br />
					<a href="<?php the_permalink(); ?>" title="<?php _e('Permalink', 'sprachkonstrukt'); ?>">#</a> <time datetime="<?php the_time('c') ?>"><?php the_time(get_option('date_format')); ?>, <?php the_time(); ?></time>
					<br />
			<?php 	if ( wp_attachment_is_image() ) {
					    $metadata = wp_get_attachment_metadata();
					    printf( __( 'Full size is %s pixels', 'sprachkonstrukt'),
					    	sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
					    		wp_get_attachment_url(),
					    		esc_attr( __('Link to full-size image', 'sprachkonstrukt') ),
					    		$metadata['width'],
					    		$metadata['height']
					    	)
					    );
					} ?><br />
			<?php 	else : ?>
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
			<?php 	endif; ?>
					<?php comments_popup_link( __( '0 Comments', 'sprachkonstrukt' ), __( '1 Comment', 'sprachkonstrukt' ), __( '% Comments', 'sprachkonstrukt' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'sprachkonstrukt' ), '| ', '' ); ?>
				</footer>	

					
			<?php comments_template(); ?>
					
			</article>
			
<?php endwhile; ?>
			
<?php get_footer(); ?>
