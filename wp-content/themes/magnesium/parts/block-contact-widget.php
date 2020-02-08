<?php
/**
 * Display Contact widget in footer
 *
 * @package WordPress
 * @subpackage JointsWP
 * @since 0.0.1
 */

$contacts = get_field('footer_contact_info', 'option');
$social = get_field('social_networks_info', 'option');
$social_text = get_field('social_networks_text', 'option');

?>

<div class="contact-widget__container columns__inner">
	<?php
	foreach ( $contacts as $slug => $info ) {
		?>
		<div class="contact-widget__<?php echo $slug; ?>">
			<?php
			$items = explode( ',', $info );
			$i = 1;
			$items_count = count($items);
			foreach ( $items as $item ) {
				?>
				<?php echo trim( $item ); ?><?php echo $i < $items_count ? '<br>' : ''; ?>
				<?php
				$i++;
			}
			?>
		</div>
		<?php
	}
	?>

    <div class="contact-widget__social">
        <?php
        if ( $social_text ) {
            echo '<p class="show-for-medium">'.$social_text.'</p>';
        }
        foreach ( $social as $slug => $info ) {
            ?>
            <a href="<?php echo $info ?>" class="icon" title="<?php echo ucfirst($slug); ?>">
                <i class="fa fa-<?php echo $slug ?>"></i>
            </a>
            <?php
        }
        ?>
    </div>
</div>