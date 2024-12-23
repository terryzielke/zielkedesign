<?php
	function zielkedesign_project_list_shortcode(){
		
		// set HTML
		$HTML = '<div id="projects-wapper">';
		
		
		// get randomized array of exercises for this block
		$args = array(
	        'post_type'     => 'project',
			'post_status'	=> 'publish',
	        'orderby'       => 'date',
	        'order'			=> 'DESC'
	    );
	    $query = new WP_Query($args);
	    
	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();
	            
				// Get the exercise data
				$link = get_permalink();
				$title = get_the_title();
				$image = get_the_post_thumbnail_url();
				
				$HTML .=	'<div class="project">
								<a href="'.$link.'">
									<figure style="background-image:url('.$image.');"></figure>
									<h2>'.$title.'</h2>
								</a>
							</div>';
				
	        }
	    }
	    
	    $HTML .= '</div>';
	    
	  
	    // return HTML
	    return $HTML;

	}
	add_shortcode('zielkedesign_project_list', 'zielkedesign_project_list_shortcode');
?>