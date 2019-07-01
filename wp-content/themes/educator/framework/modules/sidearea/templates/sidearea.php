<section class="edgt-side-menu">
	<div class="edgt-close-side-menu-holder">
		<a class="edgt-close-side-menu" href="#" target="_self">
			<?php echo educator_edge_icon_collections()->renderIcon('icon_close', 'font_elegant'); ?>
		</a>
	</div>
	<div class="edgt-side-area-holders">
		<div class="edgt-side-menu-top">
			<?php if(is_active_sidebar('sidearea')) {
				dynamic_sidebar('sidearea');
			} ?>
		</div>
		<?php if(is_active_sidebar('sidearea-bottom')) { ?>
			<div class="edgt-side-menu-bottom">
				<?php dynamic_sidebar('sidearea-bottom'); ?>
			</div>
		<?php } ?>
	</div>
</section>