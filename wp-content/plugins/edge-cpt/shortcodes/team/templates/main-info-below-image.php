<div class="edgt-team main-info-below-image <?php echo esc_attr($skin) ?>">
	<div class="edgt-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="edgt-team-image">
                <?php echo wp_get_attachment_image($team_image,'full');?>
			</div>
		<?php } ?>

		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "") { ?>
			<div class="edgt-team-info">
				<?php if ($team_name !== '' || $team_position !== '') { ?>
					<div class="edgt-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
						<?php if ($team_name !== '') { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="edgt-team-name">
								<?php echo esc_attr($team_name); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
						<?php } ?>
						<?php if ($team_position !== "") { ?>
							<p class="edgt-team-position"><?php echo esc_attr($team_position) ?></p>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if ($team_description != "") { ?>
					<div class='edgt-team-text'>
						<div class='edgt-team-text-inner'>
							<div class='edgt-team-description'>
								<p><?php echo esc_attr($team_description) ?></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>

		<div class="edgt-team-social-holder-between">
			<div class="edgt-team-social <?php echo esc_attr($team_social_icon_type) ?>">
				<div class="edgt-team-social-inner">
					<div class="edgt-team-social-wrapp">

						<?php foreach( $team_social_icons as $team_social_icon ) {
							print $team_social_icon;
						} ?>

					</div>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>