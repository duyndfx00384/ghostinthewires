<div class="edgt-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="edgt-tab-content">
                <h2 class="edgt-page-title"><?php esc_html_e('Backup Options', 'educator'); ?></h2>
                <form method="post" class="edgt_ajax_form edgt-backup-options-page-holder">
                    <div class="edgt-page-form">
                        <div class="edgt-page-form-section-holder">
                            <h3 class="edgt-page-section-title"><?php esc_html_e('Export/Import Options', 'educator'); ?></h3>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <h4><?php esc_html_e('Export', 'educator'); ?></h4>
                                    <p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'educator'); ?></p>
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="export_options" id="export_options" class="form-control edgt-form-element" rows="10" readonly><?php echo edgt_core_export_options(); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgt-page-form-section">
                                <div class="edgt-field-desc">
                                    <h4><?php esc_html_e('Import', 'educator'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'educator'); ?></p>
                                </div>
                                <div class="edgt-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control edgt-form-element" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgt-import-theme-options-btn"><?php esc_html_e('Import', 'educator'); ?></button>
									<?php wp_nonce_field('edgt_import_theme_options_secret_value', 'edgt_import_theme_options_secret', false); ?>
									<span class="edgt-bckp-message"></span>
								</div>
							</div>
                            <div class="edgt-page-form-section edgt-import-button-wrapper">
                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'educator') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will overide all your existing options.', 'educator'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<div class="edgt-page-form-section-holder">
							<h3 class="edgt-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'educator'); ?></h3>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<h4><?php esc_html_e('Export', 'educator'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'educator'); ?></p>
								</div>
								<div class="edgt-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control edgt-form-element" rows="10" readonly><?php echo edgt_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<h4><?php esc_html_e('Import', 'educator'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'educator'); ?></p>
								</div>
								<div class="edgt-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control edgt-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgt-import-custom-sidebars-btn"><?php esc_html_e('Import', 'educator'); ?></button>
									<?php wp_nonce_field('edgt_import_custom_sidebars_secret_value', 'edgt_import_custom_sidebars_secret', false); ?>
									<span class="edgt-bckp-message"></span>
								</div>
							</div>
							<div class="edgt-page-form-section edgt-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'educator') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'educator'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="edgt-page-form-section-holder">
							<h3 class="edgt-page-section-title"><?php esc_html_e('Export/Import Widgets', 'educator'); ?></h3>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<h4><?php esc_html_e('Export', 'educator'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'educator'); ?></p>
								</div>
								<div class="edgt-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control edgt-form-element" rows="10" readonly><?php echo edgt_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<h4><?php esc_html_e('Import', 'educator'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'educator'); ?></p>
								</div>
								<div class="edgt-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control edgt-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgt-page-form-section">
								<div class="edgt-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgt-import-widgets-btn"><?php esc_html_e('Import', 'educator'); ?></button>
									<?php wp_nonce_field('edgt_import_widgets_secret_value', 'edgt_import_widgets_secret', false); ?>
									<span class="edgt-bckp-message"></span>
								</div>
							</div>
							<div class="edgt-page-form-section edgt-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'educator') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'educator'); ?></li>
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