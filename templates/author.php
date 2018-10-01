<?php
$myhome_author_description = get_the_author_meta( 'description' );
if ( ! empty( $myhome_author_description ) ) :
?>
<article class="mh-author">
	<div class="position-relative">

		<div class="mh-author__avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 125 ); ?>
		</div>

		<div class="mh-author__content">
			<div class="mh-author__content__inner">

			<div class="mh-author__label">
				<?php esc_html_e( 'Post author', 'myhome' ); ?>
			</div>

			<h3 class="mh-author__name">
				<?php the_author(); ?>
			</h3>

			<p>
				<?php the_author_meta( 'description' ); ?>
			</p>

			</div>
		</div>

	</div>
</article>
<?php
endif;