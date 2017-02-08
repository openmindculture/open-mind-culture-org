<?php
/**
 * Functions
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ 



/**
 * set width for content
 */
if ( ! isset( $content_width ) )
	$content_width = 550;

/**
 * basic settings
 */
add_action( 'after_setup_theme', 'sprachkonstrukt_setup' );

if ( ! function_exists( 'sprachkonstrukt_setup' ) ):
function sprachkonstrukt_setup() {


	if ( ! load_theme_textdomain( 'sprachkonstrukt' , '/wp-content/languages/' ) )
		load_theme_textdomain( 'sprachkonstrukt' , TEMPLATEPATH.'/languages/' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


	// use wp_nav_menu() for main menu and social-button-menu
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'sprachkonstrukt' ),
		'social' => __( 'Social Buttons', 'sprachkonstrukt' ),
	) );
	
	
	// adding Thumbnail support
	add_theme_support( 'post-thumbnails' ); 
	
	
	
	// register main sidebar
	register_sidebar(array(
		'id'			=> 'main_sidebar',
		'name' 			=> __('Sidebar', 'sprachkonstrukt'),
		'description'	=> __('The Main Sidebar to the right', 'sprachkonstrukt'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">', 
		'after_widget' 	=> '</li>', 
		'before_title' 	=> '<h2 class="widgettitle">', 
		'after_title' 	=> '</h2>', 
	));
	
	// register widget for beautiful archive
	wp_register_sidebar_widget(0, __('Sprachkonstrukt Archive Widget', 'sprachkonstrukt'), 'sprachkonstrukt_archive_widget');


	// Custom Header Stuff
	define( 'HEADER_TEXTCOLOR', '96D321' ); // default green
	define( 'HEADER_IMAGE', '%s/images/headers/default.jpg' ); // default header image
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'sprachkonstrukt_header_image_width', 960 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'sprachkonstrukt_header_image_height', 170 ) );

	// for styling of header image in backend
	add_custom_image_header( '', 'sprachkonstrukt_admin_header_style' );

	// Default custom headers
	register_default_headers( array (
	
		'default' => array (
			'url'			=> '%s/images/headers/default.jpg',
			'thumbnail_url' => '%s/images/headers/default-thumbnail.jpg',
			'description' 	=> __( 'MacBook', 'sprachkonstrukt' )),
		'door' => array (
			'url'			=> '%s/images/headers/door.jpg',
			'thumbnail_url' => '%s/images/headers/door-thumbnail.jpg',
			'description' 	=> __( 'Door', 'sprachkonstrukt' )),
		'earth' => array (
			'url'			=> '%s/images/headers/earth.jpg',
			'thumbnail_url' => '%s/images/headers/earth-thumbnail.jpg',
			'description' 	=> __( 'Earth', 'sprachkonstrukt' )),
		'fireworks' => array (
			'url'			=> '%s/images/headers/fireworks.jpg',
			'thumbnail_url' => '%s/images/headers/fireworks-thumbnail.jpg',
			'description' 	=> __( 'Fireworks', 'sprachkonstrukt' )),
		'planet' => array (
			'url'			=> '%s/images/headers/planet.jpg',
			'thumbnail_url' => '%s/images/headers/planet-thumbnail.jpg',
			'description' 	=> __( 'Planet', 'sprachkonstrukt' )),
		'smoke' => array (
			'url'			=> '%s/images/headers/smoke.jpg',
			'thumbnail_url' => '%s/images/headers/smoke-thumbnail.jpg',
			'description' 	=> __( 'Smoke', 'sprachkonstrukt' )),
		'splatter' => array (
			'url'			=> '%s/images/headers/splatter.jpg',
			'thumbnail_url' => '%s/images/headers/splatter-thumbnail.jpg',
			'description' 	=> __( 'Splatter', 'sprachkonstrukt' )),
		'trees' => array (
			'url'			=> '%s/images/headers/trees.png',
			'thumbnail_url' => '%s/images/headers/trees-thumbnail.png',
			'description' 	=> __( 'Trees', 'sprachkonstrukt' ))

	) );
	
	// CSS in WYSIWYG Editor
	add_editor_style('editor.css');

	if ( is_admin() ){ // admin actions
  		add_action( 'admin_menu', 'sprachkonstrukt_add_options_page' );
	}

	add_theme_support('automatic-feed-links');

	
}
endif;


/**
 * Fallback for main menu
 */
if ( ! function_exists( 'sprachkonstrukt_menu' ) ):
function sprachkonstrukt_menu() {

	echo '<nav><ul>
			<li><a href="'.get_bloginfo('url').'">'.__('Home', 'sprachkonstrukt').'</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';			
}
endif;

/**
 * Fallback for social button menu (just show rss button)
 */
if ( ! function_exists( 'sprachkonstrukt_socialbuttons' ) ):
function sprachkonstrukt_socialbuttons() {

	echo '<ul class="socialbuttons">
			<li><a href="'.get_bloginfo('rss2_url').'" title="'.__('RSS', 'sprachkonstrukt').'">'.__('RSS', 'sprachkonstrukt').'</a></li>';
	echo '</ul>';			
}
endif;



/** 
 * outputs comments (and no pings/trackbacks) 
 */
if ( ! function_exists( 'sprachkonstrukt_comment' ) ):
function sprachkonstrukt_comment($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<div id="comment-<?php comment_ID(); ?>" >
     		<div class="kommentar-avatar">
     			<?php echo get_avatar($comment,$size='32',$default=get_bloginfo('template_directory').'/images/gravatar.png' ); ?>
     		</div>
     		<div class="kommentar-inhalt">
      			<span class="comment-author vcard"><?php echo(get_comment_author_link()); ?>:</span> <?php comment_text(); ?>
				<?php if ($comment->comment_approved == '0') : ?>
        			<br /> <em><?php _e('Your comment is awaiting moderation.', 'sprachkonstrukt') ?></em>
      			<?php endif; ?>
      			
				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date();?>, <?php comment_time(); ?></a>
					<div class="reply">
         				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      				</div>
      			</div>
				
      			
      		</div>
     	</div>
<?php
}
endif;


/** 
 * outputs pings/trackbacks (and no comments) 
 */
if ( ! function_exists( 'sprachkonstrukt_ping' ) ):
function sprachkonstrukt_ping($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<div id="comment-<?php comment_ID(); ?>" >
     		<span class="comment-author vcard comment-meta commentmetadata">
      			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php _e('Trackback', 'sprachkonstrukt'); ?>:</a> <?php echo(get_comment_author_link()); ?>
      			</span>
				
      			
      		
     	</div>
<?php
        }
endif;


/**
 * styles header image in admin panel
 */
if ( ! function_exists( 'sprachkonstrukt_admin_header_style' ) ) :
function sprachkonstrukt_admin_header_style() {
?>
<style type="text/css">
#headimg {
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
width: <?php echo HEADER_IMAGE_WIDTH; ?>px;

	text-align: right;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
}
#headimg h1, #headimg #desc {
	margin-right: 15px;
}
#headimg h1 a, #headimg h1 a:hover, #headimg h1 a:active {
	display: block;
	padding-top: .8em;
	padding-bottom: 10px;
	text-transform: lowercase;
	color: #<?php echo HEADER_TEXT_COLOR; ?> !important;
	font-size: 64px;	
	text-decoration: none !important;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
}

#headimg #desc {
	text-transform: lowercase;
	color: #fff !important;
	font-size: 14px;
}
}
</style>
<?php
}
endif;


/**
 * The Theme Settings Page
 */
 
function sprachkonstrukt_add_options_page() {
	add_theme_page('Sprachkonstrukt Theme Info', __('Theme Info', 'sprachkonstrukt'), 'manage_options', 'sprachkonstrukt_theme_options', 'sprachkonstrukt_options_do_page');
}
 
function sprachkonstrukt_options_do_page() {
	?>
	<div class="wrap">
		<h2><?php _e("Sprachkonstrukt Theme Info", 'sprachkonstrukt'); ?></h2>
		<h3><?php _e('Questions, Errors, Feature Requests?', 'sprachkonstrukt'); ?></h3>
		<p><?php _e('&rarr; See the ', 'sprachkonstrukt'); ?> <a href="http://sprachkonstrukt2.deyhle-webdesign.com"><?php _e('sprachkonstrukt2 blog', 'sprachkonstrukt'); ?></a> <?php _e('or ask me on <a href="http://twitter.com/iRuben">Twitter</a>.', 'sprachkonstrukt'); ?></p>
		
		<h3><?php _e('Happy with your Theme?', 'sprachkonstrukt'); ?></h3>
		<p><?php _e("You should donate a few dollars, so I can buy a beer and work on future updates!", 'sprachkonstrukt'); ?><br /><?php _e('Just click the following button:', 'sprachkonstrukt'); ?></p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="X5GU7UCXWM2K6">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>
		
	</div>
	<?php	
}




/**
 * The included Archive Widget
 */
 
if ( ! function_exists( 'sprachkonstrukt_archive_widget' ) ):
function sprachkonstrukt_archive_widget() {

	global $wpdb; // Wordpress Database
	
	$years = $wpdb->get_results( "SELECT distinct year(post_date) AS year, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year(post_date) ORDER BY post_date DESC" );
	
	if ( empty( $years ) ) {
		return; // empty archive
	}
	
	$months_short = apply_filters( 'smarter_archives_months', array( '', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ) );
	$months_short = apply_filters( 'smarter_archives_months', array( '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ) );
	
	?>
		<li id="better-archives" class="widget widget_better-archives">
			<h2 class="widgettitle"><?php _e( 'Archives', 'sprachkonstrukt' ); ?></h2>
			<ul class="better-archives">
	<?php foreach ( $years as $year ) {
		print '<li><a class="year-link" href="' . get_year_link( $year->year ) . '">' . $year->year . '</a> ';
		
		for ( $month = 1; $month <= 12; $month++ ) {
			if ( (int) $wpdb->get_var( "SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND year(post_date) = '$year->year' AND month(post_date) = '$month'" ) > 0 ) {
				print '<a class="month-link" href="' . get_month_link( $year->year, $month ) . '">' . $months_short[$month] . '</a>';
			}
			
			if ( $month != 12 ) {
				print ' ';
			}
		}
		
		print '</li>';
	}
	
	print '</ul></li>';

}
endif;
?>