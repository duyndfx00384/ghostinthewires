<?php if(!empty($vita)) { ?>
    <p class="edgt-vita">
        <?php echo esc_html($vita); ?>
    </p>
    <?php if(!empty($address)): ?>
        <p class="edgt-si-address">
        <span class="address-icon fa fa-map-marker"></span><?php echo esc_html($address); ?>
        </p>
    <?php endif; ?>
    <?php if(!empty($phone_number)): ?>
    <p class="edgt-si-phone-number">
        <span class="phone-icon fa fa-phone"></span> <?php echo esc_html($phone_number); ?>
    </p>
    <?php endif; ?>
<?php } ?>