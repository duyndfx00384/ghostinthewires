<thead>
    <tr>
        <td>
            <?php esc_html_e('Program', 'edge-lms'); ?>
        </td>
        <?php if($enable_category == 'yes') { ?>
        <td class="edgt-ct-category-title">
            <?php esc_html_e('Category', 'edge-lms'); ?>
        </td>
        <?php } ?>
        <?php if($enable_instructor == 'yes') { ?>
            <td class="edgt-ct-instructor-title">
                <?php esc_html_e('Instructor', 'edge-lms'); ?>
            </td>
        <?php } ?>
        <?php if($enable_students == 'yes') { ?>
            <td class="edgt-ct-students-title">
                <?php esc_html_e('Students', 'edge-lms'); ?>
            </td>
        <?php } ?>
        <?php if($enable_price == 'yes') { ?>
            <td class="edgt-ct-price-title">
                <?php esc_html_e('Price', 'edge-lms'); ?>
            </td>
        <?php } ?>
        <td>
            &nbsp;
        </td>
    </tr>
</thead>