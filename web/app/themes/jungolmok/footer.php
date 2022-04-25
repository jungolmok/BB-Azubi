<?php

/** 
 * @package Boardwalk 2021 – jk
 */
?>

</main>

<footer>
    <div class="footer--container">
        <?php get_template_part( 'module/_general/01-footer' ); ?>
        <?php get_template_part( 'module/_general/02-socialmedia' ); ?>
        <p class="copyright"><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
    </div>
</footer>



<?php wp_footer(); ?>
</body>
</html>

