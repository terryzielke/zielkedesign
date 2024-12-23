<?php
/**
 * Browser Detection
 */
$browser = 'None';
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) $browser = 'Opera';
	elseif (strpos($user_agent, 'Edge')) $browser = 'Edge';
	elseif (strpos($user_agent, 'Chrome')) $browser = 'Chrome';
	elseif (strpos($user_agent, 'Safari')) $browser = 'Safari';
	elseif (strpos($user_agent, 'Firefox')) $browser = 'Firefox';
	elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) $browser = 'Internet Explorer';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" rel="shortcut icon">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" rel="apple-touch-icon-precomposed">
	<!-- meta data -->
	<meta name="theme-color" content="#000000" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/dd2ef627ee.js" crossorigin="anonymous"></script>
	<!-- GreenSocks -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="<?php if(is_home()){echo 'blog-body';}elseif(is_author()){echo 'author-body';}else{global $post; $pageSlug = $post->post_name; echo $pageSlug.'-body';} ?>">
<div id="page" class="site <?php echo ' '.strtolower($browser); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zielke2020' ); ?></a>
	
	<div id="close-nav-curtain"></div>
	<nav id="site-navigation" class="main-navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'page-menu',
			) );
		?>
		<h4>Projects</h4>
		<ul id="project-menu" class="menu">
			<?php
				global $wp_query;
				$args=array(
					'post_type'			=> 'project',
					'post_status'		=> 'publish',
					'orderby'			=> 'date',
					'order'				=> 'DESC',
					'posts_per_page'	=> 100
				);
				$query = null;
				$query = new WP_Query($args);
				if( $query->have_posts() ) {
					while ($query->have_posts()) : $query->the_post();
						echo '<li class="menu-item project-item '.($wp_query->post->ID == get_the_ID() ? ' current-item' :'').'"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
					endwhile;
				}
				wp_reset_query();
			?>
		</ul>
	</nav><!-- #site-navigation -->
	
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<svg version="1.1" id="zielkedesign_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60.57267 61.6248016">
					<g class="left">
						<path class="light" d="M30.286335,52.9373932l-7.3750076-7.3750076l-7.3750086-7.3749771l-7.3749762-7.3750076l-7.004961,7.0049629 c-0.2043714,0.2043686-0.204371,0.5357208,0.0000007,0.7400932l7.0049601,7.0049286l7.3749762,7.3750076l7.0692129,7.0692139 c0.195797,0.195797,0.4613552,0.3057938,0.7382545,0.3057938h13.0541401c0.4662323,0,0.6997223-0.563694,0.3700447-0.8933716 L30.286335,52.9373932z"/>
						<path class="dark" d="M15.2305231,23.7431908l-7.0691805,7.0692101l7.3749762,7.3750076l7.3750086-7.3750076l6.481636-6.481636
							c0.3296757-0.3296757,0.0961857-0.8933716-0.3700466-0.8933716H15.9687796
							C15.6918793,23.4373932,15.426321,23.5473919,15.2305231,23.7431908z"/>
					</g>
					<g class="right">
						<path class="light" d="M52.4113274,16.0623856l-7.3749771-7.3749762l-7.0692139-7.0692129 c-0.195797-0.1957974-0.4613533-0.3057952-0.7382545-0.3057952H24.1747437c-0.4662323,0-0.6997223,0.5636951-0.3700466,0.8933713 l6.481638,6.481637l7.3750076,7.3749762l7.3750076,7.3750076l7.3749771,7.3750076l7.0049591-7.004961 c0.2043724-0.2043705,0.2043724-0.5357227,0-0.7400932L52.4113274,16.0623856z"/>
						<path class="dark" d="M45.0363503,23.4373932l-7.3750076,7.3750076l-6.481636,6.481636 c-0.3296776,0.3296776-0.0961876,0.8933716,0.3700466,0.8933716h13.0541363c0.2769012,0,0.5424576-0.1099968,0.7382584-0.3057976 l7.0691795-7.0692101L45.0363503,23.4373932z"/>
					</g>
					</svg>
				</a>
			</p>
		</div><!-- .site-branding -->
		<a id="menu-button">
			<div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
		</a>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
