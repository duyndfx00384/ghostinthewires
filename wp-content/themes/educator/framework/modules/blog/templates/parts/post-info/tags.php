<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="edgt-tags-holder">
    <div class="edgt-tags">
        <?php the_tags('', '', ''); ?>
    </div>
</div>
<?php } ?>