<?php
/*
Plugin Name: HB Social Bookmarks
Plugin URI: http://www.hendrikbahr.de/social-bookmark-wordpress-plugin/
Description: Plugin displays several social bookmark icons in the sidebar as a widget. After activation place the social bookmark widget on any space in your sidebar through the design -> widgets menu in WordPress admin.
Author: Hendrik Bahr
Version: 1.2.0
Author URI: http://www.hendrikbahr.de/
*/
class hb_social_bookmark {
	/**
	 * initializes plugin
	 */
	function init(){
		$widget = new hb_social_bookmark();
    	register_sidebar_widget('HB Social Bookmarks', array($widget,'display'));
	}
	/** 
	 * echos HTML output for social bookmark widget
	 */
	function display(){
		/*Preparing variables */
			$image_path			= get_option('siteurl').'/wp-content/plugins/hb-social-bookmark-widget';
			$url 				= htmlentities('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		
		if (is_single() || is_page()) {
			$description_iso 	= get_the_excerpt();
			$description 		= urlencode($description_iso);
			$title_iso			= get_the_title();
			$title				= urlencode($title_iso);
		}elseif (is_home()) {
			$description_iso 	= get_bloginfo('description');
			$description 		= urlencode($description_iso);
			$title_iso 			= get_bloginfo('name');
			$title 				= urlencode($title_iso);
		}elseif (is_archive()){
			$description_iso 	= single_tag_title('', false).' - '.get_bloginfo('description');
			$description 		= urlencode($description_iso);		
			$title_iso 			= single_tag_title('', false);
			$title 				= urlencode($title_iso);	
		}else {
			$description_iso 	= '';
			$description 		= '';
			$title_iso 			= '';
			$title 				= '';
		}

		/* printing Output */
		echo '
			<li class="widget widget_links">
			    <script type="text/javascript">
				<!--
					/* Function for Displaying Platform Title */
					function displayBookmark(text){
						myDiv = document.getElementById(\'bookmark\');
						myDiv.innerHTML = text;
				    	}
					/* Function for Add to Facebook */
					function fbs_click() {
					        u=location.href;
					        t=document.title;
					        window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t),"sharer","toolbar=0 ,status=0,width=626,height=436");
					        return false;
				        }
				    /* Function for Add to MySpace */
				    function GetThis(T, C, U, L){
							var targetUrl = "http://www.myspace.com/Modules/PostTo/Pages/?"+"t="+encodeURIComponent(T)+"&c="+encodeURIComponent(C)+"&u="+encodeURIComponent(U)+"&l="+L;
							window.open(targetUrl);
						}
					/* Function for adding to browser favorites */
					function AddFavorite(){
							if(navigator.appName != "Microsoft Internet Explorer"){
								window.external.addPanel(\''.$title_iso.'\',\''.$url.'\', \'\')
							} else {
								window.external.addFavorite(location.href, \''.$title_iso.'\');
							}							
						}
				-->
				</script>';
			
		echo '  <h2 class="widgettitle">Social Bookmarks</h2>				
				Bookmarken bei:	<span id="bookmark" style="font-weight: bold;"></span>
				<br /><br />
				
				<!-- Favoriten -->
				<a href="javascript:AddFavorite();"
					onmouseover="displayBookmark(\'Favoriten\')" onmouseout="displayBookmark(\'\')"	
					title="Zu Browser Favoriten hinzuf&uuml;gen">
					<img src="'.$image_path.'/book_favorites.png" alt="Browser Favoriten" /></a>
					
				<!-- Mister Wong -->
				<a href="http://www.mister-wong.de/?action=addurl&amp;bm_url='.$url.'&amp;bm_description='.$title.'"
					onmouseover="displayBookmark(\'Mr. Wong\')" onmouseout="displayBookmark(\'\')"
					title="Bei Mr. Wong bookmarken" target="_blank"><img
					src="'.$image_path.'/book_wong_16.gif" alt="Mr. Wong" /></a>
				
				<!-- Facebook -->
				<a href="http://www.facebook.com/share.php" 
					onmouseover="displayBookmark(\'Facebook\')" onmouseout="displayBookmark(\'\')"
					onclick="return fbs_click()" title="Bei Facebook merken"
					target="_blank"><img
					src="'.$image_path.'/book_facebook.gif" alt="Facebook" /></a>

				<!-- StumbleUpon -->
				<a href="http://www.stumbleupon.com/submit?url='.$url.'"
					onmouseover="displayBookmark(\'StumbleUpon\')" onmouseout="displayBookmark(\'\')" 
					title="StumbledUpon">
					<img src="'.$image_path.'/book_su.gif" alt="StumbleUpon" />
					</a>
					
				<!-- Technorati -->
				<a href="http://www.technorati.com/faves/?add='.$url.'"
					onmouseover="displayBookmark(\'Technorati\')" onmouseout="displayBookmark(\'\')"
					title="Bei Technorati bookmarken" target="_blank"><img
					src="'.$image_path.'/book_technorati.png"
					alt="technorati" /></a>
		
				<!-- Furl -->
				<a href="http://furl.net/storeIt.jsp?u='.$url.'&amp;t='.$title.'"
					onmouseover="displayBookmark(\'Furl\')" onmouseout="displayBookmark(\'\')"
					title="Bei Furl speichern" target="_blank"><img
					src="'.$image_path.'/book_furl.png" alt="Furl" /></a>
				
				<!-- Del.icio.us -->
				<a href="http://del.icio.us/post?url='.$url.'&amp;title='.$title.'"
					onmouseover="displayBookmark(\'Del.icio.us\')" onmouseout="displayBookmark(\'\')"
					title="del.icio.us" target="_blank"><img
					src="'.$image_path.'/book_delicious.png"
					alt="del.icio.us" /></a>
				
				<!-- Yahoo -->
				<a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u='.$url.'&amp;t='.$title.'"
					onmouseover="displayBookmark(\'Yahoo\')" onmouseout="displayBookmark(\'\')"
					title="My Yahoo" target="_blank"><img
					src="'.$image_path.'/book_yahoo.png" alt="yahoo" /></a>
				
				<!-- Linkarena -->
				<a href="http://www.linkarena.com/bookmarks/addlink/?url='.$url.'&amp;title='.$title.'"
					onmouseover="displayBookmark(\'Linkarena\')" onmouseout="displayBookmark(\'\')"
					title="Bei Linkarena bookmarken" target="_blank"><img
					src="'.$image_path.'/book_linkarena.png" alt="Linkarena" /></a>
				
				<!-- Oneview -->
				<a href="http://oneview.de/quickadd/neu/addBookmark.jsf?URL='.$url.'&amp;title='.$title.'"
					onmouseover="displayBookmark(\'Oneview\')" onmouseout="displayBookmark(\'\')"
					title="Bei Oneview bookmarken" target="_blank"><img
					src="'.$image_path.'/book_oneview.png" alt="Oneview" /></a>
				
				<!-- Webnews -->
				<a href="http://www.webnews.de"
					onmouseover="displayBookmark(\'Webnews\')" onmouseout="displayBookmark(\'\')" 
					onclick="document.location = \'http://www.webnews.de/einstellen?url=\'+encodeURIComponent(document.location)+\'&amp;title=\'+encodeURIComponent(document.title); return false;" 
					title="Webnews">
					<img src="'.$image_path.'/book_webnews.gif" alt="Webnews" /></a>
				
				<!-- Digg -->
				<a href="http://digg.com/submit?url='.$url.'&amp;title='.$title.'&amp;bodytext='.$description.'&amp;media=news&amp;topic=tech_news"
					onmouseover="displayBookmark(\'Digg\')" onmouseout="displayBookmark(\'\')" 
					title="Digg it">
					<img src="'.$image_path.'/book_digg.png" width="16" height="16" alt="Digg!" />
					</a>
					
				<!-- Myspace -->
				<a href="javascript: GetThis(\''.$title_iso.' \', \''.$description_iso.' \', \' '.$url.' \', 5)"
					onmouseover="displayBookmark(\'MySpace\')" onmouseout="displayBookmark(\'\')" 
					title="MySpace">
					<img src="'.$image_path.'/book_myspace.gif" alt="MySpace" /></a>
					
				<!-- Windows live -->
				<a href="https://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=de&amp;url='.$url.'&amp;title='.$title.'&amp;top=1"
					onmouseover="displayBookmark(\'Windows Live\')" onmouseout="displayBookmark(\'\')"
					title="Windows live Favorites">
					<img src="'.$image_path.'/book_live.png" alt="Windows Live" /></a>

				<!-- Google -->
				<a href="http://www.google.com/bookmarks/mark?op=add&amp;hl=de&amp;bkmk='.$url.'&amp;title='.$title.'"
					onmouseover="displayBookmark(\'Google\')" onmouseout="displayBookmark(\'\')"
					title="iGoogle" target="_blank"><img
					src="'.$image_path.'/book_google.png" alt="google" /></a>
					
				<!-- folkd -->
				<a href="http://www.folkd.com/submit/'.$url.'"
					onmouseover="displayBookmark(\'folkd\')" onmouseout="displayBookmark(\'\')"
					title="folkd" target="_blank"><img
					src="'.$image_path.'/book_folkd.png" alt="folkd" /></a>

				<!-- Blinklist -->
				<a href="http://www.blinklist.com/?Action=Blink/addblink.php&amp;Url='.$url.'&amp;Title='.$title.'&amp;Tag=&amp;Description='.$description.'"
					onmouseover="displayBookmark(\'Blinklist\')" onmouseout="displayBookmark(\'\')"
					title="Bei Blinklist bookmarken" target="_blank"><img
					src="'.$image_path.'/book_blinklist.png" alt="Blinklist" /></a>
					
				<!-- Favoriten.de -->
					<a href="http://www.favoriten.de/url-hinzufuegen.html" 
					onmouseover="displayBookmark(\'Favoriten.de\')" onmouseout="displayBookmark(\'\')"
					onclick="location.href=&quot;http://www.favoriten.de/url-hinzufuegen.html?bm_url=&quot;+encodeURIComponent(location.href)+&quot;&amp;bm_title=&quot;+encodeURIComponent(document.title);return false" 
					title="Bei Favoriten.de bookmarken" target="_top">
					<img src="'.$image_path.'/book_favoritende.gif" alt="Favoriten.de" /></a>
				
				<!-- Yigg -->
					<a href="http://yigg.de/neu?exturl='.$url.'&amp;exttitle='.$title.'&amp;extdesc='.$description.'"
					onmouseover="displayBookmark(\'Yigg\')" onmouseout="displayBookmark(\'\')"
					title="Yigg" target="_blank">
					<img src="'.$image_path.'/book_yigg.png" alt="Yigg" /></a>
				
				<!-- Weblinkr -->
					<a href="http://weblinkr.com" onclick="window.open(\'http://weblinkr.com/add/?popup=1&amp;address=\'+encodeURIComponent(location.href)+\'&amp;title=\'+encodeURIComponent(document.title), \'Weblinkr\',\'width=730, height=500, scrollbars=1, toolbar=0, resizable=1\'); return false;"
					onmouseover="displayBookmark(\'Weblinkr\')" onmouseout="displayBookmark(\'\')"
					title="Weblinkr" target="_blank">
					<img src="'.$image_path.'/book_weblinkr.png" alt="Weblinkr" /></a>
		';
		
		/*
		 * echos plugin credentials - thank you for supporting the author by not removing it, but it's up to you.
		 */
		echo '<div>Plugin by <a href="http://www.hendrikbahr.de">Hendrik Bahr</a>.</div>';

		echo '
			</li>';
	}
}

add_action('widgets_init',array('hb_social_bookmark','init'));
?>