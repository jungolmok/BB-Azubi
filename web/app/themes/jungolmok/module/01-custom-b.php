
<?php 
    $layout = "home--header";
    if( get_row_layout() == $layout ):
        $maintext = get_sub_field("main--text");

        $bgVideo = get_sub_field("bg--img--video")["video"];
        $bgImg = get_sub_field("bg--img--video")["bildimg"];

        $colorBG = get_sub_field("colors")["background--color"];
        $colorFont = get_sub_field("colors")["font--color"];
?>
<section 
    class="<?php echo $layout; ?>"
    style="<?php if ( $colorBG ) : ?>background-color:<?php echo $colorBG.';'; endif;?><?php if ( $colorFont ) : ?>color:<?php echo $colorFont.';'; endif;?>">

    <div class="section--bg">
    <figure class="setratio getfull">
        <video 
            width="<?php echo $bgVideo["width"]; ?>" 
            height="<?php echo $bgVideo["height"]; ?>" 
            loop="true" 
            autoplay="autoplay"
            muted>
            <source 
                src="<?php echo $bgVideo["url"]; ?>" 
                type="<?php echo $bgVideo["type"].'/'.$bgVideo["subtype"]; ?>">
        </video>
    </figure>
    </div>

    <div class="section--container">
        <article class="blocks">
            <div class="block--contents">
                <?php if( $maintext ): ?>
                <?php echo $maintext; ?>
                <?php endif; ?>
            </div>
        </article>
    </div>
    
</section>
<?php endif; ?>