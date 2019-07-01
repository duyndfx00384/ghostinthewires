<?php educator_edge_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="edgt-page-footer">
				<?php
					if($display_footer_top) {
						educator_edge_get_footer_top();
					}
					if($display_footer_bottom) {
						educator_edge_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.edgt-wrapper-inner  -->
</div> <!-- close div.edgt-wrapper -->
<?php wp_footer(); ?>
</body>
</html>