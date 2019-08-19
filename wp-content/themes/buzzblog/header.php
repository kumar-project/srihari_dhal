<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?>>
<div id="st-container" class="st-container">
<div <?php if (is_admin_bar_showing()) {echo ('style="margin-top:32px;"');} ?> class="burger-button <?php if (buzzblog_getVariable('hamburger_menu') == 'yes') {echo 'visible-xs-block visible-sm-block';} ?>"><div class="st-trigger-effects"><div class="bt-menu-trigger nav-icon4"><span></span></div></div></div>
<div class="st-menu st-effect-4 sidepanel" id="menu-4">
<?php if(buzzblog_getVariable('logo_sidepanel') == 'yes' or buzzblog_getVariable('logo_sidepanel') == '' ){ if(buzzblog_getVariable('sidepanel_logo_url','url') !='') { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="side-logo"><img src="<?php echo esc_url( buzzblog_getVariable('sidepanel_logo_url','url')); ?>" width="<?php echo esc_attr( buzzblog_getVariable('sidepanel_logo_url','width')); ?>" height="<?php echo esc_attr( buzzblog_getVariable('sidepanel_logo_url','height')); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
		<?php } else { ?><div class="logo_h logo_h__txt"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo( 'name' ); ?></a></div><?php } ?>
		<?php } ?>
		<?php get_template_part('mobile/menu'); ?>
				<?php dynamic_sidebar("hs_side_panel"); ?>
			</div>

<?php get_template_part('newsletter'); ?>


<div class="top-panel22 hidden-phone"><div id="small-dialog" class="zoom-anim-dialog mfp-hide"><?php get_template_part("static/static-search"); ?></div></div>
	<?php 
	$hercules_header_position = buzzblog_getVariable('header_position'); 
			if($hercules_header_position == 'stickyheader') {
			$hercules_header_position = "header";
			}elseif ($hercules_header_position == 'normalheader') {
			$hercules_header_position = "normal_header";
			}else {
			$hercules_header_position = "header";
			}
			$header_background_ratio = buzzblog_getVariable('header_background_ratio'); 
			if($header_background_ratio =='') {$header_bg_ratio = "0.5";}else{$header_bg_ratio = buzzblog_getVariable('header_background_ratio');}
			
			$header_vertical_offset = buzzblog_getVariable('header_vertical_offset'); 
			if($header_vertical_offset =='') {$header_vr_offset = "0";}else{$header_vr_offset = buzzblog_getVariable('header_vertical_offset');}
		?>
		<div class="st-pusher">
<?php get_template_part( 'mobile/mobile-top-panel' ); ?>

				<div class="st-content">
					<div class="st-content-inner">
		<div class="main-holder">
		<?php get_template_part('wrapper/wrapper-top'); ?>
<header id="headerfix" data-stellar-background-ratio="<?php echo esc_attr($header_bg_ratio);?>" data-stellar-horizontal-offset="0" data-stellar-vertical-offset="<?php echo esc_attr($header_vr_offset);?>" class="headerstyler headerphoto <?php echo esc_attr($hercules_header_position); if (buzzblog_getVariable('header_layout') == 'topleftmenu') {echo " topleftmenu";} if (buzzblog_getVariable('header_layout') == 'topcenter') {echo " topcenter-menu";}  ?>">
<div class="header-overlay"></div>
<div class="visible-xs-block visible-sm-block">
<div class="container">
<div class="row">
    <div class="col-md-12"><div class="mobile-logo">
        <?php get_template_part("static/static-logo"); ?>
    </div></div>
</div>
</div>
</div>
<?php
if (buzzblog_getVariable('header_position')!= 'stickyheader') {
echo '<div class="container">';
}
?>
<?php get_template_part('wrapper/wrapper-header'); ?>
<?php
if (buzzblog_getVariable('header_position')!= 'stickyheader') {
echo '</div>';
}
?>
</header>