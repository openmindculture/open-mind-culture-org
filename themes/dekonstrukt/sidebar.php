<?php
/**
 * Template for the main sidebar to the right
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ ?>
		
		
		<aside>
		<ul id="sidebar">
			<?php if ( dynamic_sidebar('Sidebar') ) : else : ?>
				
				<?php sprachkonstrukt_archive_widget() ?>
				
				
			<li id="tag_cloud" class="widget widget_tag_cloud">
				<h2 class="widgettitle"><?php _e('Tags', 'sprachkonstrukt'); ?></h2>
				<div class="tagcloud">
					<?php wp_tag_cloud(); ?>
				</div> 
			</li> 
		
			
			<li id="meta" class="widget widget_meta">
				<h2 class="widgettitle"><?php _e( 'Meta', 'sprachkonstrukt' ); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

			<?php endif; ?>

			<li id="meta" class="affili">

	            		<!-- google skyscraper ads -->
	            		<script type="text/javascript"><!--
	                		google_ad_client    = "pub-6414740850978318";
	                		google_ad_width     = 160;
	                		google_ad_height    = 600;
	                		google_ad_format    = "160x600_as";
	                		google_ad_type      = "text";
	                		google_ad_channel   ="";
	                		google_color_border = "FFFFFF";
	                		google_color_bg     = "FFFFFF";
	                		google_color_link   = "000000";
	                		google_color_url    = "666666";
	               			google_color_text   = "333333";
	            		//--></script>
	            		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

			</li>
		</ul>
		</aside>