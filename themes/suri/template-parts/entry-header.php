<?php
/**
 * The template part for displaying header meta information for current post
 *
 * @package Suri
 * @since 0.0.6
 */

?>

<div<?php suri_attr( 'entry-meta' ) ?>>

	<?php /* MOD do not display author and date */ ?>
	
	<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<span<?php suri_attr( 'comments-link' ) ?>>
			<?php comments_popup_link(
				sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'suri' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() )
			);?>
		</span>
	<?php endif; ?>

	<?php edit_post_link( esc_html__( 'Edit', 'suri' ), '<span' . suri_get_attr( 'edit-link' ) . ' >', '</span>' );?>
</div>
