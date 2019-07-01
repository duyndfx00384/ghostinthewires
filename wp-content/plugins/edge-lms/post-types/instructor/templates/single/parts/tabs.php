<?php
$tabs = apply_filters( 'educator_edge_single_instructor_tabs', array() );
if ( ! empty( $tabs ) ) :
    ?>

    <div class="edgt-tabs edgt-tabs-standard">
        <ul class="edgt-tabs-nav clearfix">
            <?php foreach ( $tabs as $key => $tab ) : ?>
                <li class="<?php echo esc_attr( $key ); ?>_tab">
                    <a href="#tab-<?php echo esc_attr( $key ); ?>">
                        <span class="edgt-tab-icon">
                            <?php print $tab['icon']; ?>
                        </span>
                        <span class="edgt-tab-title">
                            <?php echo apply_filters( 'educator_edge_instructor_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php foreach ( $tabs as $key => $tab ) : ?>
            <div class="edgt-tab-container" id="tab-<?php echo sanitize_title($key); ?>">
                <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/' . $tab['template'], 'instructor', '', $params); ?>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>