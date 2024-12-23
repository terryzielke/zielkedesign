<div class="zpg-settings-wrapper zielke_wp_admin">
<h1>Zielke Design Project Gallery Options</h1>

<section class="option_section static">
	<h3>How To Use</h3>
	<div class="padding">
		<p>This plugin allows you to create multiple galleries on your website. They are displayed in a grid structured album, which you can place wherever you like. To display the album, copy and past this shortcode <a class="btn button zielkedesign_click_to_copy"><span class="clipboard">[zielke_project_gallery]</span></a> at the desired location.</p>
		<p>The galleries are displayed with either a template page file which gives you a unique URL for each gallery, or an AJAX lightbox.</p>
	</div>
</section>

	
<div class="break clear"></div>


<form method="post" action="options.php">
<?php
settings_errors();
// Get Wordpress database
// global $wpdb;

/* --------------------------------------------------
	GET PLUGIN SETTINGS
-------------------------------------------------- */

// select settings group
settings_fields( 'zpg_settings_group' );
do_settings_sections( 'zpg_settings_group' );

// get current slideshow settings
$zpg_image_size			= esc_attr( get_option('zpg_image_size'));
$zpg_full_screen		= esc_attr( get_option('zpg_full_screen'));
$zpg_click_save			= esc_attr( get_option('zpg_click_save'));
$zpg_animation			= esc_attr( get_option('zpg_animation'));
$zpg_description		= esc_attr( get_option('zpg_description'));
$zpg_links				= esc_attr( get_option('zpg_links'));

// get current album settings
$zpg_constrain_width	= esc_attr( get_option('zpg_constrain_width'));
$zpg_use_small_thumbs	= esc_attr( get_option('zpg_use_small_thumbs'));
$zpg_full_width			= esc_attr( get_option('zpg_full_width'));
$zpg_lightbox			= esc_attr( get_option('zpg_lightbox'));
$zpg_show_name			= esc_attr( get_option('zpg_show_name'));
$zpg_excerpt			= esc_attr( get_option('zpg_excerpt'));
$zpg_anchor_on_select			= esc_attr( get_option('zpg_anchor_on_select'));
?>
	<!-- SINGLE GALLERY SETTINGS -->
	<h2>Single Gallery</h2>
	<!-- display options -->
	<section class="option_section accordion">
		<h3>Display Options</h3>
		<table class="option_list">
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_lightbox" id="zpg_lightbox" <?php if($zpg_lightbox == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_lightbox"></label>
				</td>
				<td class="col col_2">
					<p>Use Lightbox Instead of Pages:</p>
					<ul>
						<li>This works well for Themes that have a large/tall header before the page content.</li>
						<li>This works well if you are not concerned with <acronym title="search engine optimization">SEO</acronym>.</li>
						<li>This negatively impacts SEO because search engine crawlers can not read content loaded via AJAX.</li>
					</ul>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
				</td>
				<td class="col col_2">
					<p>Set the size of the image relative to the window. (min: 20%; max: 80%;)</p>
				</td>
				<td class="col col_3">
					<input type="number" name="zpg_image_size" id="zpg_image_size" value="<?php if($zpg_image_size){ echo $zpg_image_size; }else{ echo '60'; } ?>" min="20" max="80"> <span>%</span>
					<label for="zpg_image_size"></label>
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_full_screen" id="zpg_full_screen" <?php if($zpg_full_screen == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_full_screen"></label>
				</td>
				<td class="col col_2">
					<p>Use full-screen slideshow.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
				</td>
				<td class="col col_2">
					<p>Select slide transition effect/</p>
				</td>
				<td class="col col_3">
					<select name="zpg_animation" id="zpg_animation">
						
						<option value="horizontal" <?php if($zpg_animation == 'horizontal'){ echo ' selected="selected"'; } ?>>horizontal</option>
						
						<option value="vertical" <?php if($zpg_animation == 'vertical'){ echo ' selected="selected"'; } ?>>vertical</option>
						
						<option value="fade" <?php if($zpg_animation == 'fade'){ echo ' selected="selected"'; } ?>>fade</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_description" id="zpg_description" <?php if($zpg_description == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_description"></label>
				</td>
				<td class="col col_2">
					<p>Show description of the project below the gallery along with the client name, website link, and tags.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
		</table>
	</section>
	<!-- functionality options -->
	<section class="option_section accordion">
		<h3>UI Options</h3>
		<table class="option_list">
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_click_save" id="zpg_click_save" <?php if($zpg_click_save == 'on'){ echo 'checked="checked"'; }?>>
					<label  for="zpg_click_save"></label>
				</td>
				<td class="col col_2">
					<p>Enable right-click save image:</p>
					<ul>
						<li>Disabling this can greatly improve gallery performance</li>
					</ul>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_links" id="zpg_links" <?php if($zpg_links == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_links"></label>
				</td>
				<td class="col col_2">
					<p>Link the title of the gallery to the project website</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
		</table>
	</section>
	
	
	
	<div class="break clear"></div>
	
	<!-- GALLERY ALBUM SETTINGS -->
	<h2>Album Grid Settings</h2>
	
	<!-- functionality options -->
	<section class="option_section accordion">
		<h3>Display Options</h3>
		<table class="option_list">
			<tr>
				<td class="col col_1">
				</td>
				<td class="col col_2">
					<p>Restricts the maximum width of album grid/</p>
					<ul>
						<li>Width is measured in pixels.</li>
						<li>Albums under 1200px will load medium sized thumbnails.</li>
						<li>Albums under 900px will load small sized thumbnails.</li>
						<li>Under 900px will NOT display description excerpt.</li>
					</ul>
				</td>
				<td class="col col_3">
					<input type="number" name="zpg_constrain_width" id="zpg_constrain_width" value="<?php if($zpg_constrain_width){ echo $zpg_constrain_width; }else{ echo '1200'; } ?>" min="700" max="3000"> <span>px</span>
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_full_width" id="zpg_full_width" <?php if($zpg_full_width == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_full_width"></label>
				</td>
				<td class="col col_2">
					<p>Full width album.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_use_small_thumbs" id="zpg_use_small_thumbs" <?php if($zpg_use_small_thumbs == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_use_small_thumbs"></label>
				</td>
				<td class="col col_2">
					<p>Force low resolution thumbnails.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_show_name" id="zpg_show_name" <?php if($zpg_show_name == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_show_name"></label>
				</td>
				<td class="col col_2">
					<p>Displays title above each thumbnail.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_excerpt" id="zpg_excerpt" <?php if($zpg_excerpt == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_excerpt"></label>
				</td>
				<td class="col col_2">
					<p>Display excerpt below each thumbnail.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
					<input type="checkbox" name="zpg_anchor_on_select" id="zpg_anchor_on_select" <?php if($zpg_anchor_on_select == 'on'){ echo 'checked="checked"'; }?>>
					<label for="zpg_anchor_on_select"></label>
				</td>
				<td class="col col_2">
					<p>Anchor to gallery when page loads.</p>
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<!--
			<tr>
				<td class="col col_1">
				</td>
				<td class="col col_2">
				</td>
				<td class="col col_3">
				</td>
			</tr>
			<tr>
				<td class="col col_1">
				</td>
				<td class="col col_2">
				</td>
				<td class="col col_3">
				</td>
			</tr>
			-->
		</table>
	</section>
	

	

	<?php submit_button('Save Gallery Settings','primary','zpg_save_button'); ?>
</form>
</div>