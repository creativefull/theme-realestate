<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'myhome' ); ?></label>
	<input placeholder="<?php echo esc_attr( My_Home_Theme()->settings->get( 'search-placeholder' ) ); ?>"
	       value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" type="text" />
</form>