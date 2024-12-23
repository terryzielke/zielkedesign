<?php get_header(); ?>

<div id="main-content">	
	<div id="events-banner" class="et_pb_section et_pb_section_0 banner et_pb_with_background et_section_regular">
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough et-last-child">
				<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_center et_pb_bg_layout_light">
				<div class="et_pb_text_inner">
					<h1>Public <span style="color: #ff6c3b;"> Events</span></h1>
				</div>
			</div>
		</div>	
	</div>	
</div>
	
	
	
	
	
	<div class="container">
		<div id="content-area" class="clearfix">
		<?php
			
			$args = array(
			    'post_type' => 'post',
			    'meta_key' => 'date_and_time',
			    'orderby' => 'meta_value',
			    'order' => 'ASC', // or 'ASC' for ascending order
			);
			
			$query = new WP_Query($args);
			
			// The Loop
			if ($query->have_posts()):
			    while ($query->have_posts()):
			        $query->the_post();
			        // Display your post content here
			        ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
						
						<?php
							$titletext = get_the_title();
							$excerpt = get_the_excerpt();
							$thumbnail = get_the_post_thumbnail_url();
							$date_time = get_field( "date_and_time" );
						?>
						<figure>
							<a href="<?php the_permalink(); ?>" style="background-image: url(<?=$thumbnail?>)"></a>
						</figure>
						<div class="excerpt">
							<div class="inner">
								<a href="<?php the_permalink(); ?>"><h2><?=$titletext?></h2></a>
								<h3><?=$date_time?></h3>
								<span class="break"></span>
								<p><?=$excerpt?></p>
							</div>
						</div>

					</article>
			      <?php  
			        
			    endwhile;
			    wp_reset_postdata();
			endif;
		?>
		</div>
	</div>
</div>

<img src="/wp-content/themes/divisweatcity/assets/images/slope-4.svg" style="width: 110vw;margin-left: -10px;margin-right: -10px;">
<?php

get_footer();
