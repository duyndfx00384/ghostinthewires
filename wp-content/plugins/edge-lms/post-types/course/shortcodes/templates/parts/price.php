<?php
$price = edgt_lms_calculate_course_price(get_the_ID());
 ?>
<div class="edgt-ci-price-holder clearfix">
  <?php if($price == 0) { ?>
      <span class="edgt-ci-price-free">
        <?php esc_html_e('Free', 'edge-lms'); ?>
      </span>
  <?php } else { ?>
      <span class="edgt-ci-price-value">
          <?php echo get_woocommerce_currency_symbol() . esc_html($price); ?>
      </span>
  <?php } ?>
</div>
