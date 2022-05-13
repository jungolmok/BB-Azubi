
<?php 
    $layout = "custom--a";
    if( get_row_layout() == $layout ):
        $Haedline = get_sub_field("headline");
        $Text = get_sub_field("text");
?>
<section class="<?php echo $layout; ?>">
    <div class="section--container">
        <?php if( $Haedline ): ?>
        <h2><?php echo $Haedline; ?></h2>
        <?php endif; ?>

        <?php if( $Text ): ?>
        <p><?php echo $Text; ?></p>
        <?php endif; ?>
    </div>
    
</section>
<?php endif; ?>