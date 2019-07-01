<?php
$member_list = get_post_meta(get_the_ID(), 'edgt_course_members_meta', true);

if(!empty($member_list)) { ?>
<div class="edgt-course-members">
    <ul>
        <?php
        foreach ($member_list as $member) {
            $user_name = get_user_meta($member, 'first_name', true);
            $user_lastname = get_user_meta($member, 'last_name', true);
        ?>
            <li>
                <span><?php echo esc_html($user_name) . ' ' . esc_html($user_lastname); ?></span>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }