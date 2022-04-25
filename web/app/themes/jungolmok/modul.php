<?php
/**
 * @package Jungolmok 2021
 */
?>

<!-- module.php -->

<?php 
if( have_rows('list--modules')):
	$id = 0;
	while ( have_rows('list--modules') ) : the_row();
		$id ++;
		include('module/01-custom-a.php');
		include('module/01-custom-b.php');
	endwhile;
endif;

