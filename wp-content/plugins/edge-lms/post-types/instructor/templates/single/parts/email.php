<?php if(!empty($email)) { ?>
    <div class="edgt-ts-info-row">
        <span aria-hidden="true" class="icon_mail_alt edgt-ts-bio-icon"></span>
        <a href="mailto:<?php echo sanitize_email(esc_html($email)); ?>" class="edgt-ts-bio-info"><?php echo sanitize_email(esc_html($email)); ?></a>
    </div>
<?php } ?>