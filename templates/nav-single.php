<div class="mh-post-single__nav">
	<div class="mh-grid">

		<div class="mh-grid__1of2">
			<?php if ( get_previous_post_link() ) : ?>
				<div class="mh-post-single__nav__prev">
					<?php
					previous_post_link(
						'%link',
						esc_html__( 'previous', 'myhome' ) . '<span>%title</span>'
					);
					?>
				</div>
			<?php endif; ?>
		</div>

		<div class="mh-grid__1of2">
			<?php if ( get_next_post_link() ) : ?>
				<div class="mh-post-single__nav__next">
					<?php
					next_post_link(
						'%link',
						esc_html__( 'next', 'myhome' ) . '<span>%title</span>'
					);
					?>
				</div>
			<?php endif; ?>
		</div>

	</div>
</div>
