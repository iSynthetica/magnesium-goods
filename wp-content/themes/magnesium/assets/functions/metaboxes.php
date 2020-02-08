<?php
add_action( 'add_meta_boxes', 'joints_post_add_meta_boxes', 30, 2 );
add_action( 'save_post', 'joints_post_save_meta_boxes', 1, 2 );
add_action('admin_head', 'joints_mb_admin_style');

function joints_mb_admin_style() {
	?>
	<style>
		textarea.wp-editor-area.excerpt-like
		{
			padding: 2px 6px;
			display: block;
			margin: 12px 0 0;
			height: 4em;
			width: 100%;
			font-family: inherit !important;
			font-size: inherit !important;
		}
		input.regular-text {
			display: block;
			width: 100%;
		}
	</style>
	<?php
}

function joints_post_add_meta_boxes( $post_type, $post )
{
	if ( get_post_meta($post->ID, '_wp_page_template' , true ) == 'page-templates/about.php' ) {
		add_meta_box( 'page_about_additional_mb', __( 'Боковая панель', 'woocommerce' ), 'joints_page_about_additional_mb', 'page', 'normal' );
	}
}

/**
 * Output the metabox.
 *
 * @param WP_Post $post
 */
function joints_page_about_additional_mb( $post )
{
	?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for=""><?php echo __('График работы') ?></label></th>
				<td>
					<input
						name="page_sidebar_schedule_title"
						type="text" id=""
						value="<?php echo htmlspecialchars_decode( get_post_meta($post->ID, 'page_sidebar_schedule_title' , true ) ); ?>"
						placeholder=""
						class="regular-text ml-text"
					/>
					<br />
					<span class="description"></span>
				</td>
			</tr>

			<tr>
				<th scope="row"></th>
				<td>
					<?php
					$settings = array(
						'textarea_name' => 'page_sidebar_schedule',
						'editor_css'    => '<style>#wp-pagesidebarschedule-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
					);
					wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'page_sidebar_schedule' , true ) ), 'pagesidebarschedule', $settings );
					?>
					<br />
					<span class="description"></span>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for=""><?php echo __('Контактная информация') ?></label></th>
				<td>
					<input
						name="page_sidebar_contacts_title"
						type="text" id=""
						value="<?php echo htmlspecialchars_decode( get_post_meta($post->ID, 'page_sidebar_contacts_title' , true ) ); ?>"
						placeholder=""
						class="regular-text ml-text"
					/>
					<br />
					<span class="description"></span>
				</td>
			</tr>

			<tr>
				<th scope="row"></th>
				<td>
					<?php
					$settings = array(
						'textarea_name' => 'page_sidebar_contacts',
						'editor_css'    => '<style>#wp-pagesidebarcontacts-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
					);
					wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'page_sidebar_contacts' , true ) ), 'pagesidebarcontacts', $settings );
					?>
					<br />
					<span class="description"></span>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

/**
 * Save Use and Ingredients metaboxes data
 *
 * @param $post_id
 * @param $post
 */
function joints_post_save_meta_boxes( $post_id, $post )
{
	// $post_id and $post are required
	if ( empty( $post_id ) || empty( $post ) ) {
		return;
	}

	// Dont' save meta boxes for revisions or autosaves
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
		return;
	}

	// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
	if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
		return;
	}

	// Check user has permission to edit
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if (!empty($_POST['post_blockquote'])) {
		$datta = htmlspecialchars( $_POST['post_blockquote'] );
		update_post_meta( $post_id, 'post_blockquote', $datta );
	}

	if (!empty($_POST['page_sidebar_schedule_title'])) {
		$datta = htmlspecialchars( $_POST['page_sidebar_schedule_title'] );
		update_post_meta( $post_id, 'page_sidebar_schedule_title', $datta );
	}

	if (!empty($_POST['page_sidebar_schedule'])) {
		$datta = htmlspecialchars( $_POST['page_sidebar_schedule'] );
		update_post_meta( $post_id, 'page_sidebar_schedule', $datta );
	}

	if (!empty($_POST['page_sidebar_contacts_title'])) {
		$datta = htmlspecialchars( $_POST['page_sidebar_contacts_title'] );
		update_post_meta( $post_id, 'page_sidebar_contacts_title', $datta );
	}

	if (!empty($_POST['page_sidebar_contacts'])) {
		$datta = htmlspecialchars( $_POST['page_sidebar_contacts'] );
		update_post_meta( $post_id, 'page_sidebar_contacts', $datta );
	}
}