<?php
/**
 * theme support
 */
 if ( ! function_exists( 'wpbeg_setup' ) ) {
	function wpbeg_setup() {
		load_theme_textdomain( 'wpbeg', get_template_directory() . '/languages' );
		add_theme_support( 'html5',
			array(
				'menus',
				'title-tag',
				'post-thumbnails',
				'automatic-feed-links',
			 )
		);
	}
	register_nav_menus( array(
		'global_nav' => esc_html__( 'global navigation', 'wpbeg' ),
		'sub_nav'    => esc_html__( 'sub navigation', 'wpbeg' ),
	) );
}
add_action( 'after_setup_theme', 'wpbeg_setup' );

if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/**
 * Title output
 */
function wpbeg_title( $title ) {
	if ( is_front_page() && is_home() ) {
		$title = get_bloginfo( 'name', 'display' );
	} elseif ( is_singular() ) {
		$title = single_post_title( '', false );
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'wpbeg_title' );

/**
 * Read stylesheet, script
 */
function wpbeg_script() {
	$locale = get_locale();
	$locale = apply_filters( 'theme_locale', $locale, 'wpbeg' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0' );
	if( $locale == 'ja' ) {
		wp_enqueue_style( 'wpbeg-mplus1p', '//fonts.googleapis.com/earlyaccess/mplus1p.css', array() );
	}
	wp_enqueue_style( 'wpbeg-Sacramento', '//fonts.googleapis.com/css?family=Sacramento&amp;amp;subset=latin-ext', array() );
	wp_enqueue_style( 'wpbeg-normalize', get_template_directory_uri() . '/css/normalize.css', array(), '4.5.0' );
	wp_enqueue_style( 'wpbeg-wpbeg', get_template_directory_uri() . '/css/wpbeg.css', array(), '1.0.0' );
	wp_enqueue_style( 'wpbeg-style', get_template_directory_uri() . '/style.css', array(), '1.0.0' );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.4.1.min.js' , "", "3.4.1", true );
	wp_enqueue_script( 'samplejs', get_template_directory_uri() . '/js/sample.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpbeg_script' );

/**
 * Read editor-style
 */
function wpbeg_theme_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . "/css/editor-style.css" );
}
add_action( 'admin_init', 'wpbeg_theme_add_editor_styles' );

function wpbeg_widgets_init() {
	register_sidebar (
		array (
			'name'          => esc_html__( 'Category widget', 'wpbeg' ),
			'id'            => 'category_widget',
			'description'   => esc_html__( 'It is widget for categories', 'wpbeg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2><i class="fa fa-folder-open" aria-hidden="true"></i>',
			'after_title'   => "</h2>\n",
		)
	);
	register_sidebar (
		array (
			'name'          => esc_html__( 'Tag widget', 'wpbeg' ),
			'id'            => 'tag_widget',
			'description'   => esc_html__( 'It is widget for tags', 'wpbeg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2><i class="fa fa-tags" aria-hidden="true"></i>',
			'after_title'   => "</h2>\n",
		)
	);
	register_sidebar (
	  array (
			'name'          => esc_html__( 'Archive widget', 'wpbeg' ),
			'id'            => 'archive_widget',
			'description'   => esc_html__( 'It is widget for archives', 'wpbeg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2><i class="fa fa-archive" aria-hidden="true"></i>',
			'after_title'   => "</h2>\n",
	  )
	);
	register_sidebar (
	  array (
			'name'          => esc_html__( 'freedom widget', 'wpbeg' ),
			'id'            => 'freedom_widget',
			'description'   => esc_html__( 'It is widget for freedom', 'wpbeg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => "</h2>\n",
	  )
	);
}
add_action( 'widgets_init', 'wpbeg_widgets_init' );

/**
 * Add-custom-post-type
 */
add_action( 'init', 'codex_book_init' );
/**
 * カスタム投稿タイプ book を登録する。
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_book_init() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name', 'wpbeg' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'wpbeg' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'wpbeg' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'wpbeg' ),
		'add_new'            => _x( 'Add New', 'book', 'wpbeg' ),
		'add_new_item'       => __( 'Add New Book', 'wpbeg' ),
		'new_item'           => __( 'New Book', 'wpbeg' ),
		'edit_item'          => __( 'Edit Book', 'wpbeg' ),
		'view_item'          => __( 'View Book', 'wpbeg' ),
		'all_items'          => __( 'All Books', 'wpbeg' ),
		'search_items'       => __( 'Search Books', 'wpbeg' ),
		'parent_item_colon'  => __( 'Parent Books:', 'wpbeg' ),
		'not_found'          => __( 'No books found.', 'wpbeg' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'wpbeg' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => _x( 'description', 'wpbeg' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'book', $args );
}

// init アクションにフックして、そのタイミングで create_book_taxonomies を呼び出す
add_action( 'init', 'create_book_taxonomies', 0 );

// "book" カスタム投稿タイプに対して genres と writers という2つのカスタム分類を作成する
function create_book_taxonomies() {
	// （カテゴリーのような）階層化したカスタム分類を新たに追加
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Genres' ),
		'all_items'         => __( 'All Genres' ),
		'parent_item'       => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item'         => __( 'Edit Genre' ),
		'update_item'       => __( 'Update Genre' ),
		'add_new_item'      => __( 'Add New Genre' ),
		'new_item_name'     => __( 'New Genre Name' ),
		'menu_name'         => __( 'Genre' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'book' ), $args );

	// （タグのような）階層のないカスタム分類を新たに追加
	$labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Writers' ),
		'popular_items'              => __( 'Popular Writers' ),
		'all_items'                  => __( 'All Writers' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer' ),
		'update_item'                => __( 'Update Writer' ),
		'add_new_item'               => __( 'Add New Writer' ),
		'new_item_name'              => __( 'New Writer Name' ),
		'separate_items_with_commas' => __( 'Separate writers with commas' ),
		'add_or_remove_items'        => __( 'Add or remove writers' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers' ),
		'not_found'                  => __( 'No writers found.' ),
		'menu_name'                  => __( 'Writers' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);

	register_taxonomy( 'writer', 'book', $args );
}

/*
 * カスタムフィールド
 */
function add_bookdetail_fields() {
	add_meta_box(
		'book_setting',             //カスタムフィールドブロックに割り当てるID名
		'本の情報',                   //カスタムフィールドのタイトル
		'insert_bookdetail_fields', //入力エリアの HTML
		'book',                     //投稿タイプ。サンプルでは カスタムタクソノミー名。他に post 等が指定可能
		'normal'                    //カスタムフィールドが表示される部分
	);
}
add_action( 'admin_menu', 'add_bookdetail_fields' );

//入力エリア
function insert_bookdetail_fields() {
	global $post;
	echo '著者： <input type="text" name="book_author" value="'.get_post_meta( $post->ID, 'book_author', true ).'" size="50" style="margin-bottom: 10px;" />　<br>';
	echo '価格： <input type="text" name="book_price" value="'.get_post_meta( $post->ID, 'book_price', true ).'" size="50" style="margin-bottom: 10px;" />　<br>';
	echo 'ISBN： <input type="text" name="book_isbn" value="'.get_post_meta( $post->ID, 'book_isbn', true ).'" size="50" style="margin: 10px 0;" /><br>';
	if( get_post_meta( $post->ID, 'book_label', true ) == "is-on" ) {
		$book_label_check = "checked";
	}//チェックされていたらチェックボックスの$book_label_checkの場所にcheckedを挿入
	echo 'ベストセラーラベル： <input type="checkbox" name="book_label" value="fa-check" '.$book_label_check.' ><br>';
}

//カスタムフィールドの値を保存
function save_custom_fields( $post_id ) {

	if( !empty( $_POST['book_author'] ) ){
		update_post_meta( $post_id, 'book_author', $_POST['book_author'] );
	} else {
		delete_post_meta( $post_id, 'book_author' );
	}

	if( !empty( $_POST['book_price'] ) ){
		update_post_meta( $post_id, 'book_price', $_POST['book_price'] );
	} else {
		delete_post_meta( $post_id, 'book_price' );
	}

	if( !empty( $_POST['book_isbn'] ) ){
		update_post_meta( $post_id, 'book_isbn', $_POST['book_isbn'] );
	} else {
		delete_post_meta( $post_id, 'book_isbn' );
	}

	if( !empty( $_POST['book_label'] ) ){
		update_post_meta( $post_id, 'book_label', $_POST['book_label'] );
	} else {
		delete_post_meta( $post_id, 'book_label' );
	}
}
add_action( 'save_post', 'save_custom_fields' );

function tax_init() {
	function tax_func( $num ) {
		$tax = 1.1;
		return $num[0] * $tax;
	}
}
add_shortcode( 'tax', 'tax_func' );
add_action( 'init', 'tax_init' );


function custom_main_query ( $query ) {
    if ( is_admin() || ! $query -> is_main_query() ) {
        return;
	}

    if ( $query -> is_category() ) {
        $query -> set( 'posts_per_page', 20 );
	}

    if ( $query -> is_search() ) {
        $query -> set('cat', -2);
    }
}
add_action( 'pre_get_posts', 'custom_main_query' );
