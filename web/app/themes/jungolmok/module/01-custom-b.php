<?php 
    $layout = "custom--b";
    if( get_row_layout() == $layout ):
        $Image = get_sub_field("image");
        $Text = get_sub_field("text");
?>
<section class="<?php echo $layout; ?>">
    <div class="section--container">
        <figure>
            <img 
                src="<?php echo $Image['url']; ?>"
                width="<?php echo $Image['width']; ?>"
                height="<?php echo $Image['height']; ?>"
                alt="<?php echo $Image['alt']; ?>"
                title="<?php echo $Image['title']; ?>"
                />
        </figure>
        <?php if( $Text ): ?>
        <p><?php echo $Text; ?></p>
        <?php endif; ?>
    </div>
    
</section>
<?php endif; ?>

