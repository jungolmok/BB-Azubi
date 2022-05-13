<?php
/**
 * @package Jungolmok 2021
 */
?>

<?php 
	$menu_name = 'primary';
	if ( has_nav_menu( $menu_name ) ) : 
?>
<aside>
	<div class="aside--container">
	<nav class="<?php echo $menu_name; ?>" role="navigation">
		<div class="nav--container">
			<?php 
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'		  => false,
					'menu_id'         => 'customid',
				)
			); 
			?>
		</div>
	</nav>
	</div>
</aside>
<?php endif; ?>