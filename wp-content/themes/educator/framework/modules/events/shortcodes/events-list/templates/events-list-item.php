<?php
$price_class = '';
if(tribe_get_cost(null, true)== 'Free') {
	$price_class = 'edgt-free';
}
?>

<div <?php post_class($item_class); ?>>
	<div class="edgt-events-list-item-holder">
		<?php if(has_post_thumbnail()) : ?>
			<div class="edgt-events-list-item-image-holder">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail($image_size); ?>

					<div class="edgt-events-list-item-date-holder">
						<div class="edgt-events-list-item-date-inner">
							<h3 class="edgt-events-list-item-date-day">
								<?php echo tribe_get_start_date(null, true, 'd'); ?>
							</h3>

							<h5 class="edgt-events-list-item-date-month">
								<?php echo tribe_get_start_date(null, true, 'M'); ?>
							</h5>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<div class="edgt-events-list-item-content">
			<div class="edgt-events-list-item-title-holder">
				<h3 class="edgt-events-list-item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			</div>
			<div class="edgt-events-list-item-info">
				<div class="edgt-events-list-item-date">
					<span class="edgt-events-item-info-icon">
						<?php echo educator_edge_icon_collections()->renderIcon('fa-clock-o', 'font_awesome'); ?>
					</span>
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>
				<div class="edgt-events-list-item-location-holdere">
					<span class="edgt-events-item-info-icon">
						<?php echo educator_edge_icon_collections()->renderIcon('fa-map-marker', 'font_awesome'); ?>
					</span>
					<span class="qpdef-events-list-item-location"><?php echo esc_html(tribe_get_address()); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>