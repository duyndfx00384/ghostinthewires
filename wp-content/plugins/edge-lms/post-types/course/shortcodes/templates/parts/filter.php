<?php if($filter == 'yes') { ?>
<div class="edgt-cl-filter-holder">
    <div class="edgt-course-layout-filter">
        <span class="edgt-active" data-type="gallery"><i class=" icon_grid-2x2" aria-hidden="true"></i></span>
        <span data-type="simple"><i class="icon_ul" aria-hidden="true"></i></span>
    </div>
    <div class="edgt-course-items-counter">
        <span class="counter-label"><?php esc_html_e('Showing', 'edge-lms');?></span>
        <span class="counter-min-value"><?php echo esc_html($pagination_values['min_value']) ?></span>
        <span class="counter-dash">&ndash;</span>
        <span class="counter-max-value"><?php echo esc_html($pagination_values['max_value']) ?></span>
        <span class="counter-label"><?php esc_html_e('of', 'edge-lms');?></span>
        <span class="counter-total"><?php echo esc_html($pagination_values['total_items']) ?></span>
    </div>
    <div class="edgt-course-items-order">
        <select class="edgt-course-order-filter">
            <option data-type="date" data-order="DESC"><?php esc_html_e('Newly Publised', 'edge-lms'); ?></option>
            <option data-type="name" data-order="ASC"><?php esc_html_e('A-Z', 'edge-lms'); ?></option>
            <option data-type="name" data-order="DESC"><?php esc_html_e('Z-A', 'edge-lms'); ?></option>
        </select>
    </div>
</div>
<?php } ?>