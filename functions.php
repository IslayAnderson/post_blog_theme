<?php

function gdstheme_head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );

} 

// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;
  if ( is_feed() ) return $title;
  if ( 'right' == $seplocation ) {
	$title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} 

// remove WP version from RSS
function gdstheme_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function gdstheme_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function gdstheme_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}


function gdstheme_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {
		// register main stylesheet
		wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '', 'all' );

		// enqueue styles and scripts
		wp_enqueue_style( 'stylesheet' );
	}
}


function gdstheme_theme_support() {
	// rss
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// register menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'gdstheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'gdstheme' ) // secondary nav in footer
		)
	);

} 

// Pagination
function gdstheme_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
	$pages = paginate_links( array(
		'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'       => '',
		'current'      => max( 1, get_query_var('paged') ),
		'total'        => $wp_query->max_num_pages,
		'prev_text'    => '<svg class="govuk-pagination__icon govuk-pagination__icon--prev" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13"><path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path></svg> <span class="govuk-pagination__link-title">Previous<span class="govuk-visually-hidden"> page</span></span>',
		'next_text'    => '<span class="govuk-pagination__link-title">Next<span class="govuk-visually-hidden"> page</span><svg class="govuk-pagination__icon govuk-pagination__icon--next" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13"><path d="m8.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path></svg>',
		'type'         => 'array',
		'end_size'     => 3,
		'mid_size'     => 3
	  ) );
	  ?>
	<nav class="govuk-pagination">
		<ul class="govuk-pagination__list">
		<?php
		foreach($pages as $key=>$page){
			?>
			<li class="govuk-pagination__item">
				<?=$page?>
			</li>
			<?php
		}
		?>
		</ul>
	</nav>
  <?php
} 

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function gdstheme_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// modify read more 
function gdstheme_excerpt_more($more) {
	global $post;
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'gdstheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'gdstheme' ) .'</a>';
}

function gdstheme_launch() {

  // launching operation cleanup
  add_action( 'init', 'gdstheme_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'gdstheme_rss_version' );
  // remove injected css from comments widget
  add_filter( 'wp_head', 'gdstheme_remove_wp_widget_recent_comments_style', 1 );
  add_action( 'wp_head', 'gdstheme_remove_recent_comments_style', 1 );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'gdstheme_scripts_and_styles', 999 );

  // launching this stuff after theme setup
  gdstheme_theme_support();

  // add sidebars
  add_action( 'widgets_init', 'gdstheme_register_sidebars' );

  // remove p tags
  add_filter( 'the_content', 'gdstheme_filter_ptags_on_images' );
  // modfy excerpt
  add_filter( 'excerpt_more', 'gdstheme_excerpt_more' );

} 

// run actions on init
add_action( 'after_setup_theme', 'gdstheme_launch' );



function gdstheme_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'gdstheme_theme_customizer' );



// Sidebars & Widgets
function gdstheme_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'gdstheme' ),
		'description' => __( 'The first (primary) sidebar.', 'gdstheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	
} 

// Comment Layout
function gdstheme_comments( $comment ) {
   $GLOBALS['comment'] = $comment; ?>
  	<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
		<div class="govuk-inset-text">
			<?php
			$bgauthemail = get_comment_author_email();
			?>
			<img src="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>" class="load-gravatar avatar avatar-48 photo" height="40" width="40"  />
			<?php printf(__( '<span>%1$s: </span> %2$s', 'gdstheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'gdstheme' ),'  ','') ) ?>
			<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'gdstheme' )); ?> </a></time>
			<?php comment_text() ?>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
			<?php gdstheme_error( 'Your comment is awaiting moderation.', 'gdstheme' ) ?>
		<?php endif; ?>
	</div>
<?php
}


function gdstheme_error($message){
  ?>
  <div class="govuk-warning-text">
    <span class="govuk-warning-text__icon" aria-hidden="true">!</span>
    <strong class="govuk-warning-text__text">
      <span class="govuk-visually-hidden">Warning</span>
      <?php _e($message, 'gdstheme') ?>
    </strong>
  </div>
  <?php
}

function gdstheme_body_class($option){
	switch($option){
		case 'string':
			$body_class_string = '';
			foreach(get_body_class() as $class){
				$body_class_string .= $class . ' ';
			}
			//return substr($body_class_string, -1, 1); //i'm stupid and cant be bothered figuring out why this broken 
			return $body_class_string;
			break;	
		default:
			return get_body_class();
			break;
	}
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
