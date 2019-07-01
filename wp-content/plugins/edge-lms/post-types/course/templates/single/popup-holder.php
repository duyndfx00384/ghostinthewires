<div class="edgt-course-popup">
	<div class="edgt-course-popup-inner">
		<div class="edgt-grid-row">
            <div class="edgt-grid-col-8">
                <div class="edgt-course-item-preloader edgt-hide">
                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
                <div class="edgt-popup-heading">
                    <h5 class="edgt-course-popup-title"><?php the_title(); ?></h5>
                    <span class="edgt-course-popup-close"><i class="icon_close"></i></span>
                </div>
                <div class="edgt-popup-content">

                </div>
            </div>
			<div class="edgt-grid-col-4">
				<div class="edgt-popup-info-wrapper">
                    <div class="edgt-lms-search-holder">
                        <div class="edgt-lms-search-field-wrapper">
                            <input class="edgt-lms-search-field" value="" placeholder="<?php esc_html_e('Search Courses', 'edge-lms') ?>">
                            <i class="edgt-search-icon icon_search" aria-hidden="true"></i>
                            <i class="edgt-search-loading fa fa-spinner fa-spin edgt-hidden" aria-hidden="true"></i>
                        </div>
                        <div class="edgt-lms-search-results"></div>
                    </div>
					<?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/popup-items-list', 'course') ?>
				</div>
			</div>
		</div>
	</div>
</div>
