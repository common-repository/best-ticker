<?php
/**
 * Plugin Name: Best Ticker
 * Plugin uri: http://www.traveloka.ml/plugins/best-ticker/
 * Description: Best Ticker WordPress Plugin For Your Website Theme. You Can Embed News Ticker Via Shortcode In Anywhere You Want, Even in Theme Files.
 * Version: 1.0
 * Author: Amzad Hossain
 * Author uri: http://freelanceramzad.ml/html/zeem/
 */
if ( !defined( 'ABSPATH' ) ) exit;


 function m_news_ticker_js_cs() {
    wp_enqueue_style( 'm_news_css', plugins_url('/css/ticker.css',__FILE__), array(), '5.2.0'); 
    wp_enqueue_script('jQuery');
    wp_enqueue_script( 'news_ticker_js', plugins_url('/js/jquery.ticker.min.js',__FILE__), array( 'jquery' ), '1.0', false );
    
 }
 add_action('init','m_news_ticker_js_cs');
 


 function m_news_ticker_list_short($atts) { 
    extract(shortcode_atts(array(
      'text'   => 'Latest News',
      'color'   => 'orange',
      'bg'   => '#000',
      'count' => '5',
      'category' => '',
      'id'   => 'ticker',
      'speed'   => '3000',
      'cursorspeed'   => '50',
      'pausehover'   => 'true',
      'finishhover'   => 'true',
      'fade'   => 'true',
      'fadespeed'   => '600',
      'fadeupspeed'   => '300',


     ),$atts));

   $loop = new WP_Query(array(
      'posts_per_page' => $count,
      'post_type' =>   'post',
      'category_name' =>   $category,
   ));
     
	 
   $_news_list = '
   <script type="text/javascript">
   jQuery(document).ready(function(){
       
      jQuery("#best_'.$id.'").ticker({
      itemSpeed:'.$speed.',
      cursorSpeed:'.$cursorspeed.',
      pauseOnHover:'.$pausehover.',
      finishOnHover:'.$finishhover.',
      fade:'.$fade.',
      fadespeed:'.$fadeupspeed.',
      fadeupspeed:'.$fadeupspeed.',
      
      });
 
   });
   </script>
   <div style="background:'.$bg.'" id="best_'.$id.'" class="ticker"><strong style="background:'.$color.'">'.$text.'</strong><ul>';
     while($loop->have_posts()) : $loop->the_post();
   
     $_news_list .= '

        <li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>

     ';
    endwhile;
    $_news_list .='</div></ul>';

    wp_reset_query();
    return $_news_list;

 }
 add_shortcode('ticker','m_news_ticker_list_short');