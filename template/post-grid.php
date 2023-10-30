<?php
$post_id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
?>
<div class="col-md-3 col-sm-4 col-6">
    <div class="card border-0 mb-3">
        <div class="ratio ratio-4x3">
            <a href="<?php echo get_the_permalink(); ?>">
                <img class="w-100 h-100 object-fit-cover rounded"
                    src="<?php echo $image[0] ? $image[0] : ''; ?>"
                    alt="<?php echo get_the_title() ?>;">
            </a>
        </div>

        <div class="py-2">
            <h2 class="archive-title mb-1 pb-3 text-truncate"> 
                <a class="text-dark" href="<?php echo get_the_permalink(); ?>">
                    <?php echo get_the_title() ?>
                </a>
            </h2>
            <small class="text-muted">Mulai Dari <?php echo wss_first_price($post_id); ?></small>
        </div>
    </div>
</div>