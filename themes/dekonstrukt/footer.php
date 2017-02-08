<?php
/**
 * Template for displaying the footer
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ ?>
		
		</div>
		
		<?php 
		// creating social button menu on the left
		wp_nav_menu( array( 'container' => 'ul',  'menu_class' => 'socialbuttons', 'fallback_cb' => 'sprachkonstrukt_socialbuttons', 'theme_location' => 'social', 'depth' => 1 ) );  
		?>
		<?php
		// creating main sidebar on the right
		?>
		
		<?php get_sidebar(); ?>
		
		<div id="finished" ></div>
	</div>
		
	<footer id="footer">
        <? /*

		<?php _e('This website is powered by', 'sprachkonstrukt'); ?> <a href="http://wordpress.org/" rel="generator">Wordpress</a> <?php _e('using the', 'sprachkonstrukt'); ?> <a href="http://sprachkonstrukt2.deyhle-webdesign.com">Sprachkonstrukt2</a> <?php _e('Theme', 'sprachkonstrukt'); ?>.

        */
        ?>
	<?php wp_footer(); ?>
	</footer>
	
	<!-- custom footer elements -->
<aside class="mobileads">

<!-- custom google adwords advertising -->
 <ins class="adsbygoogle"
    style="display:block;"
    data-ad-client="pub-6414740850978318"
    data-ad-slot=""
    data-ad-format="horizontal"></ins>
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
 <!-- /custom google adwords advertising -->

<!-- custom ad Regenwald.org -->
<p>
  <a href="http://www.regenwald.org" title="Link zum Rettet den Regenwald e.V.">
    <img border="0" src="http://www.regenwald.org/images/service/penan_redu.gif" alt="Banner: Kampagne: Regenwaldschützer verhaftet!" width="468" height="60" class="size-full aligncenter" />
  </a>
</p>

<!-- custom ad doctors without borders -->
<p>
<a href="https://www.aerzte-ohne-grenzen.de/spenden/jetzt-online-spenden/einmalig-spenden/index.html"><img alt="Spenden für Ärzte ohne Grenzen" src="http://www.aerzte-ohne-grenzen.de/_media/bilder/banner-haupt--300x250-fallback.jpg" id="Ärzte ohne Grenzen - Onlinebanner Wir sind da" class="size-full aligncenter" /></a></p>
<!-- /custom ad doctors without borders -->




</aside>
	
</body>
</html>