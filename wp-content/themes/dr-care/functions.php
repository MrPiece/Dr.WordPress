<?php
/**
 * dr.care functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dr.care
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'dr_care_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dr_care_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dr.care, use a find and replace
		 * to change 'dr-care' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dr-care', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'carousel-slide', 1500, 1000, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'dr-care' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'dr_care_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'dr_care_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dr_care_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'dr_care_content_width', 640 );
}
add_action( 'after_setup_theme', 'dr_care_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dr_care_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dr-care' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dr-care' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dr_care_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dr_care_scripts() {
	wp_enqueue_style('dr-care-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet');
	wp_enqueue_style('open-iconic-bootstrap', get_template_directory_uri() . '/assets/css/open-iconic-bootstrap.min.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
	wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css');
	wp_enqueue_style('aos', get_template_directory_uri() . '/assets/css/aos.css');
	wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css');
	wp_enqueue_style('bootstrap-datepicker', get_template_directory_uri() . '/assets/css/bootstrap-datepicker.css');
	wp_enqueue_style('jquery-timepicker', get_template_directory_uri() . '/assets/css/jquery.timepicker.css');
	wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/css/flaticon.css');
	wp_enqueue_style('icomoon', get_template_directory_uri() . '/assets/css/icomoon.css');

	wp_style_add_data( 'dr-care-style', 'rtl', 'replace' );

	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', null, null, true);
	wp_enqueue_script('jquery-migrate', get_template_directory_uri() . '/assets/js/jquery-migrate-3.0.1.min.js', null, null, true);
	wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', null, null, true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', null, null, true);
	wp_enqueue_script('jquery-erasing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', null, null, true);
	wp_enqueue_script('jquery-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', null, null, true);
	wp_enqueue_script('jquery-stellar', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js', null, null, true);
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', null, null, true);
	wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', null, null, true);
	wp_enqueue_script('aos', get_template_directory_uri() . '/assets/js/aos.js', null, null, true);
	wp_enqueue_script('jquery-animate-number', get_template_directory_uri() . '/assets/js/jquery.animateNumber.min.js', null, null, true);
	wp_enqueue_script('bootstrap-datepicker', get_template_directory_uri() . '/assets/js/bootstrap-datepicker.js', null, null, true);
	wp_enqueue_script('jquery-timepicker', get_template_directory_uri() . '/assets/js/jquery.timepicker.min.js', null, null, true);
	wp_enqueue_script('scrollax', get_template_directory_uri() . '/assets/js/scrollax.min.js', null, null, true);
	wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false');
	wp_enqueue_script('google-map', get_template_directory_uri() . '/assets/js/google-map.js', null, null, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', null, null, true);

	if ( is_page('appointment') || is_home() )
		wp_enqueue_script('create-appointment', get_template_directory_uri() . '/assets/js/create-appointment.js', ['jquery'], null, true);
}
add_action( 'wp_enqueue_scripts', 'dr_care_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

















add_action('init', 'register_carousel_posttype');
function register_carousel_posttype()
{
	register_post_type( 'carousel-slide', [
		'label'  => null,
		'labels' => [
			'name'               => 'Carousel Slides', // основное название для типа записи
			'singular_name'      => 'Carousel Slide', // название для одной записи этого типа
			'add_new'            => 'Add carousel slide', // для добавления новой записи
			'add_new_item'       => 'Add new carousel slide', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit carousel slide', // для редактирования типа записи
			'new_item'           => 'New carousel slide', // текст новой записи
			'view_item'          => 'Show carousel slide', // для просмотра записи этого типа.
			'search_items'       => 'Search carousel slides', // для поиска по этим типам записи
			'not_found'          => 'Not Found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Nothing in trash bin', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Carousel Slides', // название меню
		],
		'description'         => 'Here you can add slides to specific carousels on your website',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-images-alt',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'excerpt', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ 'carousel' ],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
		'capability_type'     => 'slide',
		'map_meta_cap'        => true,
	] );

	register_taxonomy( 'carousel', 'carousel-slide', [ 
		'labels'                => [
			'name'              => 'Carousels',
			'singular_name'     => 'Carousel',
			'search_items'      => 'Search Carousels',
			'all_items'         => 'All Carousels',
			'view_item '        => 'View Carousel',
			'parent_item'       => 'Parent Carousel',
			'parent_item_colon' => 'Parent Carousel:',
			'edit_item'         => 'Edit Carousel',
			'update_item'       => 'Update Carousel',
			'add_new_item'      => 'Add New Carousel',
			'new_item_name'     => 'New Carousel',
			'menu_name'         => 'Carousels',
		],
		'description'           => 'Here you can register or check existing carousels', // описание таксономии
		'hierarchical'          => true,
		'rewrite'               => true,
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => null,
		'rest_base'             => null,
	] );
}


add_action('after_setup_theme', 'drcare_register_nav_menus');
function drcare_register_nav_menus() 
{
	register_nav_menus([
		'header_menu' => __('Menu in the header'),
	]);
}


add_filter( 'nav_menu_css_class', 'drcare_add_nav_menu_class', 10, 2 );
function drcare_add_nav_menu_class( $classes, $item )
{
	$classes[] = 'nav-item';

	return $classes;
}


add_filter('wp_nav_menu', 'drcare_add_menuclass');
function drcare_add_menuclass($ulclass) 
{
	return preg_replace('/<a/', '<a class="nav-link"', $ulclass, -1);
}


add_action('init', 'register_subscription_posttype');
function register_subscription_posttype()
{
	register_post_type( 'subscription', [
		'label'  => null,
		'labels' => [
			'name'               => 'Subscriptions', // основное название для типа записи
			'singular_name'      => 'Subscription', // название для одной записи этого типа
			'add_new'            => 'Add subscription', // для добавления новой записи
			'add_new_item'       => 'Add new subscription', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit subscription', // для редактирования типа записи
			'new_item'           => 'New subscription', // текст новой записи
			'view_item'          => 'Show subscription', // для просмотра записи этого типа.
			'search_items'       => 'Search subscriptions', // для поиска по этим типам записи
			'not_found'          => 'Not Found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Nothing in trash bin', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Subscriptions', // название меню
		],
		'description'         => 'Here you can manage payed subscriptions to your services',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-text-page',
		'hierarchical'        => false,
		'supports'            => [ 'title' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ 'subscription-service' ],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
		'capability_type'     => 'subscription',
		'map_meta_cap'        => true,
	] );

	register_taxonomy( 'subscription-service', 'subscription', [ 
		'labels'                => [
			'name'              => 'Services',
			'singular_name'     => 'Services',
			'search_items'      => 'Search service',
			'all_items'         => 'All services',
			'view_item '        => 'View service',
			'parent_item'       => 'Parent service',
			'parent_item_colon' => 'Parent service:',
			'edit_item'         => 'Edit service',
			'update_item'       => 'Update service',
			'add_new_item'      => 'Add new service',
			'new_item_name'     => 'New service',
			'menu_name'         => 'Services',
			'back_to_items'     => 'Back to services'
		],
		'description'           => 'Here you can register or check services of existing subscriptions', // описание таксономии
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => null,
		'rest_base'             => null,
	] );
}


add_action('init', 'register_user_roles');
function register_user_roles()
{
	add_role('doctor', 'Doctor');
	$doctor = get_role('doctor');
}

add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );
function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a movie, get the post and post type object. */
	if ( 'edit_movie' == $cap || 'delete_movie' == $cap || 'read_movie' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a movie, assign the required capability. */
	if ( 'edit_movie' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a movie, assign the required capability. */
	elseif ( 'delete_movie' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private movie, assign the required capability. */
	elseif ( 'read_movie' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}


add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class )
{
	$out = '
	<div class="row no-gutters my-5 navigation %1$s" role="navigation">
		<div class="col text-center">
			<div class="nav-links block-27">
				<ul>%3$s</ul>
			</div>
		</div>
	</div>  
	';

	return $out;
}


add_filter('get_the_archive_title', 'drcare_default_archive_title');
function drcare_default_archive_title($title)
{
	$title = 'Blog';
	return $title;
}


add_filter('comment_form_default_fields', 'drcare_comment_form_default_fields');
function drcare_comment_form_default_fields($fields)
{
	$fields['author'] = '
		<div class="form-group">
			<label for="name">Name *</label>
			<input type="text" class="form-control" id="author" name="author" type="text" value="" size="30" maxlength="245" required="required">
		</div>
	';

	$fields['email'] = '
		<div class="form-group">
			<label for="email">Email *</label>
			<input id="email" name="email" type="email" class="form-control" aria-describedby="email-notes" required="required">
		</div>
	';

	$fields['url'] = '
		<div class="form-group">
			<label for="website">Website</label>
			<input id="url" name="url" type="url" value="" size="30" maxlength="200" class="form-control">
		</div>
	';

	return $fields;
}


add_filter('comment_form_fields', 'drcare_comment_form_fields');
function drcare_comment_form_fields($fields)
{
	return $fields;
}


add_filter('get_archives_link', 'style_the_archive');
function style_the_archive($links) {
	preg_match('/<\/a>&nbsp;\((\d)\)/', $links, $matches);
	$linksCount = $matches[1];
	
	$links = preg_replace('/<\/a>&nbsp;\(\d\)/', "<span>({$linksCount})</span></a>", $links);

	return $links;
}


// if ( wp_doing_ajax() ) {
	add_action('wp_ajax_create_appointment', 'create_appointment_callback');
	add_action('wp_ajax_nopriv_create_appointment', 'create_appointment_callback');
// }

function create_appointment_callback()
{
	global $wpdb;

	try {
		foreach ($_POST as $field => $v) 
			if ( empty($v) ) throw new Exception("{$field} is empty, please fill it in!");

		if ( !strtotime("{$_POST['date']} {$_POST['time']}") ) 
			throw new Exception("You've chosen the wrong date!");

		if ( 
			!preg_match("/^\+\d{11}$/", $_POST['phone']) &&
			!preg_match("/^\d{11}$/", $_POST['phone']) 
		) throw new Exception("Ivalid phone number! Check it once more {$_POST['phone']}");

		$wpdb->insert(
			'appointments',
			[
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'first-name' => $_POST['first_name'],
				'last-name' => $_POST['last_name'],
				'meet-time' => date('Y-m-d H:i:s', strtotime("{$_POST['date']} {$_POST['time']}")),
				'service-type' => $_POST['service'],
				'phone-number' => $_POST['phone'],
				'message' => $_POST['message']
			],
			'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
		);

		$response['type'] = 'success';
		$response['message'] = 'Your appointment was been saved!';
	} catch(Exception $err) {
		$response['type'] = 'error';
		$response['message'] = $err->getMessage();
	}

	echo json_encode($response);
	wp_die();
}

add_action( 'wp_ajax_edit_appointment', 'edit_appointment_callback' );
function edit_appointment_callback() 
{
	global $wpdb;

	$sql = $wpdb->prepare(
		"UPDATE appointments SET
		`first-name` = %s,
		`last-name` = %s,
		`phone-number` = %s,
		`meet-time` = %s
		WHERE id = %d",

		$_POST['firstName'],
		$_POST['lastName'], 
		$_POST['phoneNumber'], 
		$_POST['meetTime'], 
		$_POST['id']
	);

	try {
		$response = $wpdb->query($sql);

		if (! $response) throw new Exception("Update didn't work!");
	} catch(Exception $e) {
		echo json_encode([
			'type' => 'error', 
			'message' => 'Something bad happend! ' . $e->getMessage()
		]);
		wp_die();
	}

	echo json_encode([
		'type' => 'success', 
		'message' => 'Appointment has been updated'
	]);
	wp_die();
}

add_action('admin_enqueue_scripts', 'admin_style');
function admin_style()
{
	wp_enqueue_style('appointment-form', get_template_directory_uri() . '/assets/css/appointment-form.css');
}