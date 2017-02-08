<?php
/**
 * Template for Comments
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */

			if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sprachkonstrukt' ); ?></p>
		<?php
				return;
			endif; ?>



<?php if ( have_comments() ) : ?>
				<h2 id="comments"><?php _e('Comments', 'sprachkonstrukt'); ?></h2>
				<ul class="pinglist">
					<?php wp_list_comments('type=pings&callback=sprachkonstrukt_ping'); ?>
				</ul>
				<ul class="commentlist">
					<?php wp_list_comments('type=comment&callback=sprachkonstrukt_comment'); ?>
				</ul>
				<div class="navigation">
					<div class="alignleft"><?php previous_comments_link() ?></div>
					<div class="alignright"><?php next_comments_link() ?></div>
				</div>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<?php comment_form(	array (
 					'fields'  => apply_filters( 'comment_form_default_fields', array (
 						'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" aria-required=\'true\' required /><label for="author">'.__('Name', 'sprachkonstrukt').'</label> <span class="required">*</span></p>',
						'email' => '<p class="comment-form-email"><input id="email" name="email" type="email" value="" size="30" aria-required=\'true\' required /><label for="email">'.__('eMail', 'sprachkonstrukt').'</label> <span class="required">*</span></p>',
						'url' =>  '<p class="comment-form-url"><input id="url" name="url" type="url" value="" size="30" /><label for="url">'.__('Website (optional)', 'sprachkonstrukt').'</label></p>',
 					) ),
					'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>', 
					'title_reply' => __('Comment', 'sprachkonstrukt'), 
					'title_reply_to' => __('Answer %s', 'sprachkonstrukt'),
					'comment_notes_before' => '',
					'comment_notes_after' => ''
					 ));
					 
					 // In Germany, you should consider to use the following and insert a link to your legal notice page.
						/*
						'comment_notes_after' => '
						<p class="legal_notice">Mit dem Absenden eines Kommentars bestätigst du, die <a href="">Datenschutzbestimmungen</a> gelesen und verstanden zu haben.</p>' */
					  ?>
					 
<?php endif; ?>				
