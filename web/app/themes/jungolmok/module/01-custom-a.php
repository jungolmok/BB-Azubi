
<?php 
    $layout = "custom--a";
    if( get_row_layout() == $layout ):
        $Haedline = get_sub_field("headline");
        $Text = get_sub_field("text");
?>
<section class="<?php echo $layout; ?>">
    <div class="section--container">
        <?php if( $Haedline ): ?>
        <?php echo $Haedline; ?>
        <?php endif; ?>

        <?php if( $Text ): ?>
        <?php echo $Text; ?>
        <?php endif; ?>
    </div>
    
</section>
<?php endif; ?>