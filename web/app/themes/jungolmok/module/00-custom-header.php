
<?php 
    $layout = "custom--a";
    if( get_row_layout() == $layout ):
        $Haedline = get_sub_field("headline");
        $Text     = get_sub_field("text");
?>
<section class="<?php echo $layout; ?>">
    <div class="section--container">
        <h1><?php echo get_the_title(); ?></h1>

        <?php if( $Text ): ?>
        <p><?php echo $Text; ?></p>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>