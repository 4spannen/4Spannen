<?php
add_theme_support(
'post-formats',
array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat', 'test')
);



/*
	Add theme panel 4SP
*/
if (file_exists(TEMPLATEPATH.'/temapaneli.php')) include_once("temapaneli.php");


/*
	Add post thumbnails support wp 4SP
*/
add_theme_support('post-thumbnails');


/*
	ADD wp dynamic menu support 4SP
*/
add_action( 'init', 'theme_menus' );
function theme_menus() {
    register_nav_menus(
        array(
            'topMenu' => __( 'Üst Menü' ),
            'footer' => __( 'Footer menu' )
        )
    );
}


/*	
	get categry id using category slug name 4sp;
	<?php echo get_category_id(get_option('SP_top_cat_id'));
*/
function get_category_id($cat_name){
	  $idObj = get_category_by_slug($cat_name); 
  	  return $id = $idObj->term_id;
}

/*
	Custom word Excerp Content
*/
function text_word_excerpt($baslik = '', $sonra = '', $uzunluk=20) {
   if (!$baslik) return $baslik;
   $basligim = explode(' ', $baslik, $uzunluk);
   if (count($basligim)>=$uzunluk) {
      $basligim= implode(" ",$basligim). $sonra;
   } else {
      $basligim= implode(" ",$basligim);
   }
   return $basligim;
}

/*
	Custom Excerp Content
*/
the_excerpt_max_charlength(140);

function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        	}else{
            	echo $subex;
        		}
        echo '...';
    	} else {
        	echo $excerpt;
    		}
}

/*
	ADD Sidebar widget support 4sp
*/
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    )
);

/*
	Add Pagination
*/

function sayfalama($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
    if(1 != $pages)
    {
        echo "<div class='wp-pagenavi'>";
        echo "<span>".$paged."/".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>İlk</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&laquo;</a>";
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&raquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Son</a>";
        echo "</div>";
    }
}

/*
	ADD txt counter (form counter) 4sp
*/

function sayacEkle (){
    $oku = file_get_contents('sayac.txt');
    $oku = $oku+1;
    return $oku;
    file_put_contents('sayac.txt',$oku);
}


/*
	Google+ Meta Tags
*/
add_action( 'wp_head', 'add_google_plus_meta' );
function add_google_plus_meta() {
	if( is_single() ) {
		global $post;
		$post_id = get_the_ID();
		setup_postdata( $post );
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
		$thumbnail = empty( $thumbnail ) ? '' : '<meta itemprop="image" content="' . esc_url( $thumbnail[0] ) . '">';
	?>
<!-- Google+ meta tags -->
<meta itemprop="name" content="<?php esc_attr( the_title() ); ?>">
<meta itemprop="description" content="<?php echo esc_attr( get_the_excerpt() ); ?>">
<?php echo $thumbnail . "\n"; ?>
<!-- eof Google+ meta tags -->
	<?php
	}
}
/*
	FACEBOOK Meta Tags
*/

//function to limit description to 300 characters
function limit($var, $limit) {
    if ( strlen($var) > $limit ) {
        return substr($var, 0, $limit) . '...';
    }
    else {
        return $var;
    }
}

// Set your Open Graph Meta Tags
function fbogmeta_header() {
    if (is_single()) {
        //getting the right post content
        $postsubtitrare = get_post_meta($post->ID, 'id-subtitrare', true);
        $post_subtitrare = get_post($postsubtitrare);
        $content = limit(strip_tags($post_subtitrare-> post_content),297);
        ?>
        <meta property="og:title" content="<?php the_title(); ?>"/>
        <meta property="og:description" content="<?php echo $content; ?>" />
        <meta property="og:url" content="<?php the_permalink(); ?>"/>
        <?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id(     get_the_ID() ), 'thumbnail'); ?>
        <?php if ($fb_image) : ?>
        <meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
        <?php endif; ?>
        <meta property="og:type" content="<?php
        if (is_single() || is_page()) { echo "article"; } else { echo "website";}     ?>"
        />
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
        <?php
        }
        }
add_action('wp_head', 'fbogmeta_header');

?>