<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if(!defined('ABSPATH')) {
	die('-1');
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = (!empty($venue_details['address'])) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

	<div class="edgt-events-list-item-holder edgt-grid-row">
		<div class="edgt-grid-col-6">
			<div class="edgt-events-list-item-image-holder">
				<a href="<?php echo esc_url(tribe_get_event_link()); ?>">
					<?php the_post_thumbnail('large'); ?>

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
		</div>

		<div class="edgt-grid-col-6">
			<div class="edgt-events-list-item-content">
				<div class="edgt-events-list-item-title-holder">

					<?php do_action('tribe_events_before_the_event_title') ?>

					<h3 class="edgt-events-list-item-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>

				<span class="edgt-events-list-item-price">
					<?php echo esc_html(tribe_get_cost(null, true)); ?>
				</span>

					<?php do_action('tribe_events_after_the_event_title') ?>
				</div>

				<?php do_action('tribe_events_before_the_meta') ?>

				<div class="qpdef-events-list-item-meta">
					<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-calendar-full', 'linear_icons'); ?>
						</span>
							<span class="edgt-events-single-meta-label"><?php esc_html_e('Date:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<?php echo tribe_events_event_schedule_details(); ?>
						</span>
					</div>

					<div class="edgt-events-single-meta-item">
					<span class="edgt-events-single-meta-icon">
						<?php echo educator_edge_icon_collections()->renderIcon('icon-clock', 'simple_line_icons'); ?>
					</span>
						<span class="edgt-events-single-meta-label"><?php esc_html_e('Time:', 'educator'); ?></span>
					<span class="edgt-events-single-meta-value">
						<?php echo tribe_get_start_time(); ?> - <?php echo tribe_get_end_time(); ?>
					</span>
					</div>

					<?php if(tribe_has_venue()) : ?>
						<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-apartment', 'linear_icons'); ?>
						</span>
							<span class="edgt-events-single-meta-label"><?php esc_html_e('Venue:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<?php echo esc_html(tribe_get_venue()); ?>
						</span>
						</div>

						<?php if(tribe_address_exists()) : ?>
							<div class="edgt-events-single-meta-item">
							<span class="edgt-events-single-meta-icon">
								<?php echo educator_edge_icon_collections()->renderIcon('lnr-map-marker', 'linear_icons'); ?>
							</span>
								<span class="edgt-events-single-meta-label"><?php esc_html_e('Address:', 'educator'); ?></span>
							<span class="edgt-events-single-meta-value">
								<?php echo tribe_get_address(); ?>
							</span>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php do_action('tribe_events_after_the_meta') ?>

				<?php if(tribe_events_get_the_excerpt()) : ?>

					<?php do_action('tribe_events_before_the_content') ?>

					<div class="edgt-events-list-item-excerpt">
						<?php echo tribe_events_get_the_excerpt(); ?>
					</div>

					<?php do_action('tribe_events_after_the_content'); ?>

				<?php endif; ?>
			</div>
		</div>
	</div>