<div class="edgt-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="edgt-tab-content">
                <h2 class="edgt-page-title"><?php esc_html_e('Import', 'educator'); ?></h2>
                <form method="post" class="edgt_ajax_form edgt-import-page-holder" data-confirm-message="<?php esc_html_e('Are you sure, you want to import Demo Data now?', 'educator'); ?>">
                    <div class="edgt-page-form">
                        <div class="edgt-page-form-section-holder">
                            <h3 class="edgt-page-section-title"><?php esc_html_e('Import Demo Content', 'educator'); ?></h3>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <h4><?php esc_html_e('Import', 'educator'); ?></h4>
                                    <p><?php esc_html_e('Choose demo content you want to import', 'educator'); ?></p>
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_example" id="import_example" class="form-control edgt-form-element dependence">
                                                    <option value="educator"><?php esc_html_e('Educator', 'educator'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <h4><?php esc_html_e('Import Type', 'educator'); ?></h4>
	                                <p><?php esc_html_e('Import Type', 'educator'); ?></p>
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_option" id="import_option" class="form-control edgt-form-element">
                                                    <option value=""><?php esc_html_e('Please Select', 'educator'); ?></option>
                                                    <option value="complete_content"><?php esc_html_e('All', 'educator'); ?></option>
                                                    <option value="content"><?php esc_html_e('Content', 'educator'); ?></option>
                                                    <option value="widgets"><?php esc_html_e('Widgets', 'educator'); ?></option>
                                                    <option value="options"><?php esc_html_e('Options', 'educator'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <h4><?php esc_html_e('Import attachments', 'educator'); ?></h4>
                                    <p><?php esc_html_e('Do you want to import media files?', 'educator'); ?></p>
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="field switch">
                                                    <label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'educator'); ?></span></label>
                                                    <label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'educator'); ?></span></label>
                                                    <input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <input type="submit" class="btn btn-primary btn-sm " value="<?php esc_html_e('Import', 'educator'); ?>" name="import" id="edgt-import-demo-data" />
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="edgt-import-load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'educator') ?> </span><br />
                                                    <div class="edgt-progress-bar-wrapper html5-progress-bar">
                                                        <div class="progress-bar-wrapper">
                                                            <progress id="progressbar" value="0" max="100"></progress>
                                                        </div>
                                                        <div class="progress-value">0%</div>
                                                        <div class="progress-bar-message">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgt-page-form-section edgt-import-button-wrapper">
                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'educator') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'educator'); ?></li>
                                        <li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'educator')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>