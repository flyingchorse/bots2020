<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package secondstep
 * @since secondstep 1.0
 */
?>
<div class="clear-div"></div>
	</div><!-- #main .site-main -->
<div class="clear-div"></div>

	<footer id="colophon" role="contentinfo">
		<div id="footer-columns">
				<div class="recent-post-section">
					<div class="recent-post section-0">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		
						<p>t: 01792 448765 m: 07968 441187</p>

					</div>
					<div class="recent-post section-1">
						<?php get_sidebar('footer-1');?>
					</div>
					<div class="recent-post section-2">
						<?php get_sidebar('footer-2');?>
					</div>
					<div class="recent-post section-3">
						<?php get_sidebar('footer-3');?>
					</div>
				</div>
				<?php wp_reset_query();?>
				<div class="clear-div"></div>
		</div>
	</footer>
</div><!-- #page .hfeed .site -->
<?php wp_footer(); ?>

</body>
</html>