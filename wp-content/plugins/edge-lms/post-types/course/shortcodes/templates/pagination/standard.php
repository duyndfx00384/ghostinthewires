<?php if($query_results->max_num_pages > 1) { ?>
	<div class="edgt-cl-loading">
		<div class="edgt-cl-loading-bounce1"></div>
		<div class="edgt-cl-loading-bounce2"></div>
		<div class="edgt-cl-loading-bounce3"></div>
	</div>
	<?php
		$pages = $query_results->max_num_pages;
		$paged = $query_results->query['paged'];
		
		if($pages > 1){ ?>
			<div class="edgt-cl-standard-pagination">
				<ul>
					<li class="edgt-cl-pag-prev">
						<a href="#" data-paged="1"><span class="lnr lnr-chevron-left"></span></span></a>
					</li>
					<?php for ($i=1; $i <= $pages; $i++) { ?>
						<?php
							$active_class = '';
							if($paged == $i) {
								$active_class = 'edgt-cl-pag-active';
							}
						?>
						<li class="edgt-cl-pag-number <?php echo esc_attr($active_class); ?>">
							<a href="#" data-paged="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></a>
						</li>
					<?php } ?>
					<li class="edgt-cl-pag-next">
						<a href="#" data-paged="2"><span class="lnr lnr-chevron-right"></span></span></a>
					</li>
				</ul>
			</div>
		<?php }
	?>
<?php }