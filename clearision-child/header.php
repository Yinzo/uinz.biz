<!DOCTYPE html>
<html lang="zh-cn">

<head>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<?php if (get_option('clrs_opct') == "no") { ?>
	<link rel="stylesheet" href="<?=get_template_directory_uri(); ?>/../clearision-child/style.opacity.css">
	<?php $bg = get_option('clrs_opbg'); if ( !empty( $bg ) ) { ?>
	<style>body { background-image: url("<?=$bg;?>"); };</style>
<?php }; }; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?=get_option( 'clrs_favi', 'favicon.ico' );?>" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="author" content="dimpurr" />
<meta name="application-name" content="<?php bloginfo('name' ); ?>"/>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url')?>" />
<link rel="alternate" type="application/rdf+xml" title="RSS 1.0" href="<?php bloginfo('rss_url')?>" />
<link rel="alternate" type="application/atom+xml" title="ATOM 1.0" href="<?php bloginfo('atom_url')?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php

if ( is_user_logged_in() ) { // 适配 WordPress 顶部管理栏
	echo '<style type="text/css" media="screen"> #float { top: 32px; } </style>' ;
}

$clrs_style = get_option("clrs_style");
if ( !empty($clrs_style) ) {
	echo "<style>" . $clrs_style . "</style>";
}

?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page">

<hgroup id="ctn_header">
	<div id="title">
		<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
	<div id="title_r">
		<?php clrs_sns(); ?>
		<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><button id="tr_rss"></button></a>
		<a href="<?php echo admin_url();?>" target="_blank"><button id="tr_admin"></button></a>
		<span id="tr_clear"></span>
		<form id="tr_s_f" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input id="tr_search" type="text" name="s" id="s" placeholder="" size="10" />
		</form>
	</div>
<div class="clearfix"></div>
</hgroup>

<div id="float" >

<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img id="logo" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" src="<?php echo get_option('clrs_logo'); ?>" ></a>

<nav id="nav" role="navigation">
	<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
</nav>

<nav id="next" role="sencond_navigation">
	<?php wp_nav_menu( array( 'theme_location' => 'next' ) ); ?>
</nav>

</div>
<?                          //ip获取代码
date_default_timezone_set("PRC");

$ipfile = "wp-content/ip.txt";//保存的文件名
$lastvisiter = "wp-content/lv.txt";//最后访问来源
$ip = $_SERVER['REMOTE_ADDR'];
$src = $_SERVER['HTTP_USER_AGENT'];
$date = date('Y-m-d H:i:s');
$text = "\n"."IP Address: "."$ip"."\n"."Time:"."$date"."\n"."Source:"."$src"."\n";
if (strpos($text, "bot")==false && strpos($text,"spider")==false)//爬虫过滤 
	{
		$handle = fopen($ipfile, 'a+');
		$handle2 = fopen($lastvisiter,'r');
		$tmp = file_get_contents("$lastvisiter");
		if($src!=$tmp)//相同访问者过滤
			{
				fwrite($handle,"$text");
				fclose($handle);
				$handle3 = fopen($lastvisiter,'w+');
				fwrite($handle3, "$src");
				fclose($handle3);
			}
		else
			{
				fwrite($handle,"+1");
				fclose($handle);
			}
		fclose($handle2);

	}
?>
