<?php

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/temapanel/temapanel.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/temapanel/rm_script.js", false, "1.0");

}

$themename = "4Spannen";
$shortname = "SP";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Kategori Seçiniz"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "Genel Ayarlar",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Logo Url",
	"desc" => "Logonuzun adresini buraya yazınız.",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Favicon Url",
	"desc" => "Favicon adresini buraya yazınız.",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => ""),

array( "type" => "close"),

/*2 NEXT Tab*/
array( "name" => "Sosyal Medya",
	"type" => "section"),
array( "type" => "open"),


array( "name" => "Facebook Adresiniz",
	"desc" => "Facebook Adresinizi Yazınız.",
	"id" => $shortname."_facebook",
	"type" => "text",
	"std" => ""),


array( "name" => "Twitter Kullanıcı Adı",
	"desc" => "Twitter kullanıcı adını yazınız.",
	"id" => $shortname."_twitter",
	"type" => "text",
	"std" => ""),
	

array( "type" => "close"),

/*3 Next Tab*/
array( "name" => "İçerik Ayarları",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Anasayfa Sliderı",
"desc" => "Slider Sayfada Görünsün mü ?",
"id" => $shortname."_slider_active",
"type" => "select",
"options" => array("Evet", "Hayır"),
"std" => ""),

array( "name" => "Sliderda Görünecek Haberler",
	"desc" => "Temada Desteği Varsa Slider Haberleri Hangi Kategoriden Çekilsin ?.",
	"id" => $shortname."_slider_cat_id",
	"type" => "select",
	"options" => $wp_cats,
	"std" => ""),


array( "name" => "Üst Haberler",
	"desc" => "Temada Desteği Varsa Üst Haberler Hangi Kategoriden Çekilsin ?.",
	"id" => $shortname."_top_cat_id",
	"type" => "select",
	"options" => $wp_cats,
	"std" => ""),
	


array( "type" => "close"),

);

function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=temapaneli.php&saved=true");
 
} 

else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=temapaneli.php&reset=true");

}
}

 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}


function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 

 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Ayarlar</h2>
 
    <div class="rm_opts">
    <form method="post">
    <?php foreach ($options as $value) {
    switch ( $value['type'] ) {
     
    case "open":
    ?>
     
    <?php break;
     
    case "close":
    ?>
     
    </div>
</div>
<br />
 
<?php break;
 
case "title":
?>
<p><?php echo $themename;?> tema yönetim paneline hoşgeldiniz.</p>
 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/temapanel/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i ?>" type="submit" value="Kaydet" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Ayarları Sıfırla" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;"><a href="http://www.ysfdmr.com">Yusuf demir</a> tarafından hazırlanmıştır.</div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>