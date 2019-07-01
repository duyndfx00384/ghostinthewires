<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if(!defined('ABSPATH')) {
	die('-1');
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

global $post;

$event_id = get_the_ID();

$price_class = '';
if(tribe_get_cost(null, true) === 'Free') {
	$price_class = 'edgt-free';
}


?>

<div id="tribe-events-content" class="tribe-events-single edgt-tribe-events-single">
	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<div class="edgt-events-single-main-info clearfix">
		<div class="edgt-events-single-date-holder">
			<div class="edgt-events-single-date-inner">
				<h3 class="edgt-events-single-date-day">
					<?php echo tribe_get_start_date(null, true, 'd'); ?>
				</h3>

				<h5 class="edgt-events-single-date-month">
					<?php echo tribe_get_start_date(null, true, 'M'); ?>
				</h5>
			</div>
		</div>
		<div class="edgt-events-single-title-holder">
			<h2 class="edgt-events-single-title"><?php the_title(); ?></h2>
			<div class="edgt-events-single-date">
				<span class="edgt-events-single-info-icon">
					<?php echo educator_edge_icon_collections()->renderIcon('icon-clock', 'simple_line_icons'); ?>
				</span>
				<?php echo tribe_events_event_schedule_details($event_id); ?>
			</div>
		</div>
        <?php do_action('tribe_events_single_event_after_the_content') ?>
	</div>

	<div class="edgt-events-single-main-content">
		<div class="edgt-grid-row edgt-events-single-media">
			<div class="edgt-events-single-featured-image edgt-grid-col-6">
				<?php echo tribe_event_featured_image($event_id, 'full', false); ?>
			</div>
			<div class="edgt-events-single-map edgt-grid-col-6">
				<?php tribe_get_template_part('modules/meta/map'); ?>
			</div>
		</div>
		<div class="edgt-events-single-content-holder">
			<?php do_action('tribe_events_single_event_before_the_content') ?>

			<?php the_content(); ?>

		</div>
	</div>

	<div class="edgt-events-single-meta">
		<?php do_action('tribe_events_single_event_before_the_meta') ?>
		<h4><?php esc_html_e('Event Details', 'educator'); ?></h4>

		<div class="edgt-events-single-meta-holder edgt-grid-row">
			<div class="edgt-grid-col-6">
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
						<?php echo educator_edge_icon_collections()->renderIcon('lnr-clock', 'linear_icons'); ?>
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
								<?php echo educator_edge_icon_collections()->renderIcon(' lnr-map-marker', 'linear_icons'); ?>
							</span>
							<span class="edgt-events-single-meta-label"><?php esc_html_e('Address:', 'educator'); ?></span>
							<span class="edgt-events-single-meta-value">
								<?php echo tribe_get_address(); ?>
							</span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<div class="edgt-grid-col-6">
				<?php if(tribe_has_organizer()) : ?>
					<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-user', 'linear_icons'); ?>
						</span>
						<span class="edgt-events-single-meta-label"><?php esc_html_e('Organizer Name:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<?php echo esc_html(tribe_get_organizer()); ?>
						</span>
					</div>
				<?php endif; ?>

				<?php if(tribe_get_organizer_phone()) : ?>
					<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-phone-handset', 'linear_icons'); ?>
						</span>
						<span class="edgt-events-single-meta-label"><?php esc_html_e('Phone:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<?php echo esc_html(tribe_get_organizer_phone()); ?>
						</span>
					</div>
				<?php endif; ?>

				<?php if(tribe_get_organizer_email()) : ?>
					<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-envelope', 'linear_icons'); ?>
						</span>
						<span class="edgt-events-single-meta-label"><?php esc_html_e('Email:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<a href="mailto: <?php echo tribe_get_organizer_email(); ?>">
								<?php echo esc_html(tribe_get_organizer_email()); ?>
							</a>
						</span>
					</div>
				<?php endif; ?>

				<?php if(tribe_get_organizer_website_link()) : ?>
					<div class="edgt-events-single-meta-item">
						<span class="edgt-events-single-meta-icon">
							<?php echo educator_edge_icon_collections()->renderIcon('lnr-earth', 'linear_icons'); ?>
						</span>
						<span class="edgt-events-single-meta-label"><?php esc_html_e('Website:', 'educator'); ?></span>
						<span class="edgt-events-single-meta-value">
							<a target="_blank" href="<?php echo tribe_get_organizer_website_url(); ?>">
								<?php echo tribe_get_organizer_website_url(); ?>
							</a>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="edgt-events-single-navigation-holder clearfix">
			<div class="edgt-events-single-prev-event">
				<?php
				$prev_event = Tribe__Events__Main::instance()->get_closest_event($post, 'previous');
				if($prev_event !== null) {
				?>
				<a class="edgt-events-nav-image" href="<?php echo esc_attr(tribe_get_event_link($prev_event)); ?>" target="_self" itemprop="url">
					<?php echo get_the_post_thumbnail($prev_event, 'educator_edge_square'); ?>
				</a>
				<span class="edgt-events-nav-text">
					<span class="edgt-events-nav-label"><?php esc_html_e('Previous' , 'educator')?></span>
					<?php tribe_the_prev_event_link('%title%'); ?>
				</span>
				<?php } ?>

			</div>

			<div class="edgt-events-single-next-event">
				<?php
				$next_event = Tribe__Events__Main::instance()->get_closest_event($post, 'next');
				if($next_event !== null) {
				?>

				<span class="edgt-events-nav-text">
					<span class="edgt-events-nav-label"><?php esc_html_e('Next' , 'educator')?></span>
					<?php tribe_the_next_event_link('%title%'); ?>
				</span>
				<a class="edgt-events-nav-image" href="<?php echo esc_attr(tribe_get_event_link($next_event)); ?>" target="_self" itemprop="url">
					<?php echo get_the_post_thumbnail($next_event, 'educator_edge_square'); ?>
				</a>
				<?php } ?>

			</div>
		</div>

		<?php do_action('tribe_events_single_event_after_the_meta'); ?>
	</div>
</div>
