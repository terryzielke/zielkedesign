<?php

function show_equipment_field($user) {
    // Get the user's current categories
    $terms = wp_get_object_terms($user->ID, 'equipment');
    $user_categories = !empty($terms) && !is_wp_error($terms) ? wp_list_pluck($terms, 'term_id') : array();
    
    // Retrieve all terms in the equipment taxonomy
    $taxonomy = get_taxonomy('equipment');
    $terms = get_terms(array('taxonomy' => 'equipment', 'hide_empty' => false));

    ?>
    <h3><?php echo esc_html($taxonomy->label); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="equipment">Select Categories</label></th>
            <td>
                <?php foreach ($terms as $term) { ?>
                    <label>
                        <input type="checkbox" name="equipment[]" value="<?php echo esc_attr($term->term_id); ?>" <?php checked(in_array($term->term_id, $user_categories)); ?> />
                        <?php echo esc_html($term->name); ?>
                    </label><br />
                <?php } ?>
            </td>
        </tr>
    </table>
    <?php
}

add_action('show_user_profile', 'show_equipment_field');
add_action('edit_user_profile', 'show_equipment_field');


/* save custom user fields */
function save_equipment_field($user_id) {
    // Check if the current user has permission to edit the user
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Check if the taxonomy field is set
    if (isset($_POST['equipment'])) {
        // Get the selected term IDs from the checkboxes
        $term_ids = array_map('intval', $_POST['equipment']);
        
        // Set the terms for the user
        wp_set_object_terms($user_id, $term_ids, 'equipment');

    } else {
        // If no terms are selected, remove existing terms
        wp_delete_object_term_relationships($user_id, 'equipment');
    }
}

// Hook into user profile update actions
add_action('personal_options_update', 'save_equipment_field');
add_action('edit_user_profile_update', 'save_equipment_field');


?>