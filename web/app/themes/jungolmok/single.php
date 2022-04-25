<?php
/**
 * @package Jungolmok 2021
 */
?>

<?php get_header(); ?>
    <!-- single.php -->
    <?php 
    while (have_posts()) : the_post(); 
        $image_id = get_post_thumbnail_id();
        $image_attr = wp_get_attachment_image_src( $image_id, 'full' );
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    ?>
        <figure>
            <img 
                data-src="<?php echo $image_attr[0]; ?>"
                width="<?php echo $image_attr[1]; ?>"
                height="<?php echo $image_attr[2]; ?>"
                alt="<?php echo $image_alt; ?>"
                class="jg--lazyimg"
            />
        </figure>

    <?php
        the_content();
        echo get_template_part( 'modul' );
    endwhile; 
    ?>
<?php get_footer(); ?>