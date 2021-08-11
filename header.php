<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package secondstep
 * @since secondstep 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/7d898d27-da04-4026-8326-2c2ab5c38cdf.css"/>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
			<div id="site-title"><?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) )
	else
	{?><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span id="logo-span"></span><?php bloginfo( 'name' ); ?></a>
	<?php } ?>
		</div>
		<div class="site-description">
		
		<?php
		wp_reset_query();
		 if (is_front_page()) {?>
		<h1 class="home-title"><?php bloginfo( 'description' ); ?></h1>
		<?php }
			else
			{
			?>
			<h2 class="standard-title"><?php bloginfo( 'description' ); ?></h2>
			<?php
			}
		?>
	</div>
	<div id="phonenum">
			<div class="num">  <?php _e( '01792 448765', 'secondstep' ); ?></div>
			<div class="num">  <?php _e( '07968 441187', 'secondstep' ); ?></div>
			<div id="email-banner"><script type="text/javascript">
        /* <![CDATA[ */
        function hivelogic_enkoder(){var kode=
        "kode=\"oked\\\"=kode\\\"\\\\)=';)'-:t1nhlgeeo.(dAkatcreho.?dtknhlgeeo.<d(k"+
        "xie+o=}dikt)r(hA.adcke)o++(1Aiatcreho.=dxk)+={i2)+-;t1nhlgeeo.(dik0<i;r=f("+
        "'o=;;'\\\\x\\\\\\\"e\\\\ox}=cdeko)r(hdmCra.CnorfSg+i;t2==xc801c+f);<-(iit3"+
        "e)o(rAhd.Cdakcce)o+=;{t+nilhegoe<.;d=k(io0;i'rxf\\\\'=\\\\\\\\\\\\\\\"\\\\"+
        "\\\\;{\\\\h@rg0n\\\\0\\\\\\\\\\\\\\\\\\\\\\\\f\\\\h0r,u+kgpFud1FqruiVj.l>w"+
        "5@@{f;34f.i,>?0+llw6h,r+uDkg1Fgdnffh,r.@>~w.qlokhjrh?1>g@n+lr3>l*u{i%*/@D>"+
        "5As(ig7B1ux4\\\\7\\\\\\\\\\\\\\\\\\\\\\\\k\\\\xmy{kkzxz3u{tmnotixgFhxjngoi"+
        "Dxb(b(kCzrzo(&sbiu74\\\\7\\\\\\\\\\\\\\\\\\\\\\\\k\\\\x1yxkmz{zkuxt3n{tmxo"+
        "Fixgnhoj@gzioxsubrlgx(&CBk.nzgx(4ktos}izjk@{gun%=h\\\\r\\\\\\\"\\\\\\\\\\"+
        "\\\\\\e\\\\od\\\\k\\\\\\\"e\\\\o=\\\\dk\\\";kode=kode.split('').reverse()."+
        "join(''\\\")x;'=;'of(r=i;0<ik(do.eelgnht1-;)+i2={)+xk=do.ehcratAi(1++)oked"+
        "c.ahAr(t)ik}do=e+xi(k<do.eelgnhtk?do.ehcratAk(do.eelgnht1-:)'';)\";x='';fo"+
        "r(i=0;i<(kode.length-1);i+=2){x+=kode.charAt(i+1)+kode.charAt(i)}kode=x+(i"+
        "<kode.length?kode.charAt(kode.length-1):'');"
        ;var i,c,x;while(eval(kode));}hivelogic_enkoder();
        /* ]]> */
        </script></div></div>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<h1 class="menu-toggle"><?php _e( 'Menu', 'secondstep' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'secondstep' ); ?>"><?php _e( 'Skip to content', 'secondstep' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->
		<div class="clear-div"></div>
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">


