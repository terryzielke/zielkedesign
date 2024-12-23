<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post();
			
			
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<div class="entry-content">
					<?php
						the_content();
					?>
					</div>

				</article>

		<?php endwhile;
		else:
	?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		/**
		 * Fires before the title and post meta on single posts.
		 *
		 * @since 3.18.8
		 */
		do_action( 'et_before_post' );
			
		$titletext = get_the_title();
		$thumbnail = get_the_post_thumbnail_url();
		$date_time = get_field( "date_and_time" );
		?>
		<div id="main-content">	
			<div id="single-post-banner" class="et_pb_section et_pb_section_0 banner et_pb_with_background et_section_regular" style="background-image: url(<?=$thumbnail?>);">
				<span id="single-post-banner-overlay"></span>
				<div class="et_pb_row et_pb_row_0">
					<div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough et-last-child">
						<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_center et_pb_bg_layout_light">
						<div class="et_pb_text_inner">
							<h1><span style="color: #ff6c3b;"><?=$titletext?></span></h1>
						</div>
					</div>
				</div>	
			</div>	
		</div>
	
		<div class="container">
			<div id="content-area" class="clearfix">
				<div id="left-area">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
						<h3><?=$date_time?></h3>
						<div class="entry-content">
						<?php the_content(); ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>

<img src="/wp-content/themes/divisweatcity/assets/images/slope-4.svg" style="width: 110vw;margin-left: -10px;margin-right: -10px;">
<?php

get_footer();
