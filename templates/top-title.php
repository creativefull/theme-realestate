<?php

$myhome_top                  = true;
$myhome_top_title_class      = array( 'mh-top-title' );
$myhome_top_title_title      = '';
$myhome_top_title_text       = '';
$myhome_top_title_background = '';

if ( is_home() ) :
	$myhome_top_title_show = My_Home_Theme()->settings->get( 'top-title-show' );
	if ( ! class_exists( 'ReduxFramework' )
	     || ( ! empty( $myhome_top_title_show ) )
	) :
		$myhome_top_title_title = apply_filters( 'wpml_translate_single_string', My_Home_Theme()->settings->get( 'blog-title' ), 'myhome', 'mh-blog-title' );
		if ( empty( $myhome_top_title_title ) ) :
			$myhome_top_title_title = esc_html__( 'Blog', 'myhome' );
		endif;
		$myhome_top_title_text  = apply_filters( 'wpml_translate_single_string', My_Home_Theme()->settings->get( 'blog-subtitle' ), 'myhome', 'mh-blog-subtitle' );
		$myhome_top_title_style = My_Home_Theme()->layout->top_title_style();
		if ( $myhome_top_title_style == 'image' ) :
			$myhome_top_title_background = My_Home_Theme()->layout->get_top_title_background_image_url();
			if ( ! empty( $myhome_top_title_background ) ) {
				array_push( $myhome_top_title_class, 'mh-top-title--image-background lazyload' );
			}
		endif;
	else :
		$myhome_top = false;
	endif;
elseif ( is_post_type_archive( 'estate' ) ) :
	global $myhome_breadcrumbs;
	$myhome_breadcrumbs = new \MyHomeCore\Common\Breadcrumbs\Breadcrumbs();

	$myhome_archive_title = apply_filters(
		'wpml_translate_single_string',
		My_Home_Theme()->settings->get( 'estate_archive-name' ),
		'myhome-core',
		'Breadcrumbs archive title'
	);
	if ( empty( $myhome_archive_title ) ) :
		$myhome_archive_title = esc_html__( 'Properties', 'myhome' );
	endif;
	$myhome_top_title_title = $myhome_archive_title;

	$myhome_archive_image = My_Home_Theme()->settings->get( 'estate_archive-image' );

	if ( ! empty( $myhome_archive_image ) && ! empty( $myhome_archive_image['id'] ) ) :
		array_push( $myhome_top_title_class, 'mh-top-title--image-background lazyload' );
		$myhome_top_title_background = $myhome_archive_image['id'];
	endif;
elseif ( is_category() || is_tag() || ( is_archive() && ! is_tax() && ! is_author() ) ) :
	$myhome_top_title_show = My_Home_Theme()->settings->get( 'top-title-show' );
	if ( ! class_exists( 'ReduxFramework' ) || ! empty( $myhome_top_title_show ) ) :
		$myhome_top_title_title = get_the_archive_title();
		$myhome_top_title_text  = get_the_archive_description();
		$myhome_top_title_style = My_Home_Theme()->layout->top_title_style();
		if ( $myhome_top_title_style == 'image' ) :
			$myhome_top_title_background = My_Home_Theme()->layout->get_top_title_background_image_url();
			if ( ! empty( $myhome_top_title_background ) ) {
				array_push( $myhome_top_title_class, 'mh-top-title--image-background lazyload' );
			}
		endif;
	else:
		$myhome_top = false;
	endif;
elseif ( is_singular( 'post' ) ) :
	$myhome_top_title_show = My_Home_Theme()->settings->get( 'top-title-show' );
	if ( ! class_exists( 'ReduxFramework' ) || ! empty( $myhome_top_title_show ) ) :
		$myhome_top_title_title = apply_filters( 'wpml_translate_single_string', My_Home_Theme()->settings->get( 'blog-title' ), 'myhome', 'mh-blog-title' );
		if ( empty( $myhome_top_title_title ) ) :
			$myhome_top_title_title = esc_html__( 'Blog', 'myhome' );
		endif;
		$myhome_top_title_text  = apply_filters( 'wpml_translate_single_string', My_Home_Theme()->settings->get( 'blog-subtitle' ), 'myhome', 'mh-blog-subtitle' );
		$myhome_top_title_style = My_Home_Theme()->layout->top_title_style();
		if ( $myhome_top_title_style == 'image' ) :
			$myhome_top_title_background = My_Home_Theme()->layout->get_top_title_background_image_url();
			if ( ! empty( $myhome_top_title_background ) ) {
				array_push( $myhome_top_title_class, 'mh-top-title--image-background lazyload' );
			}
		endif;
	else:
		$myhome_top = false;
	endif;
elseif ( is_singular( 'page' ) || is_singular( 'testimonial' ) ) :
	$myhome_top_title_title = get_the_title();
	global $post;
	$myhome_image = get_post_meta( $post->ID, 'term_image_wide', true );
	if ( ! empty( $myhome_image ) ) :
		$myhome_top_title_background = $myhome_image;
	endif;
	if ( ! empty( $myhome_top_title_background ) ) :
		array_push( $myhome_top_title_class, 'mh-top-title--image-background lazyload' );
	endif;
elseif ( is_search() ) :
	$myhome_top_title_title = esc_html__( 'Search result for ', 'myhome' ) . get_search_query();
elseif ( is_archive() && is_tax() ) :
	global $myhome_breadcrumbs;
	$myhome_breadcrumbs = new \MyHomeCore\Common\Breadcrumbs\Breadcrumbs();
	if ( $myhome_breadcrumbs->has_elements() ) {
		$myhome_term = $myhome_breadcrumbs->get_current_term();
	} else {
		$myhome_term = \MyHomeCore\Terms\Term::get_term();
	}
	$myhome_top_title_title = $myhome_term->get_name();
	$myhome_top_title_text  = $myhome_term->get_description();
	if ( $myhome_term->has_image_wide() ) :
		array_push( $myhome_top_title_class, 'mh-top-title--wide-bg lazyload' );
		$myhome_top_title_background = $myhome_term->get_image_wide_id();
	endif;
elseif ( is_author() ) :
	array_push( $myhome_top_title_class, 'mh-top-title--author' );
endif;

if ( $myhome_top ) :
	?>
	<div
		class="<?php echo esc_attr( implode( ' ', $myhome_top_title_class ) ); ?>"
		<?php if ( ! empty( $myhome_top_title_background ) ) : ?>
			<?php
			$myhome_top_title_background_srcset = wp_get_attachment_image_srcset( $myhome_top_title_background, 'myhome-wide-xs' );
			if ( ! empty( $myhome_top_title_background_srcset ) ) :?>
				style="background-size:cover;"
				data-bgset="<?php echo esc_attr( $myhome_top_title_background_srcset ) ?>"
				data-sizes="auto"
				data-parent-fit="cover"
			<?php endif; ?>
		<?php endif; ?>
	>
		<?php if ( ! empty( $myhome_top_title_title ) ) : ?>
			<?php if ( is_singular( 'post' ) ) : ?>
				<div class="mh-top-title__heading"><?php echo esc_html( $myhome_top_title_title ); ?></div>
			<?php else : ?>
				<h1 class="mh-top-title__heading"><?php echo esc_html( $myhome_top_title_title ); ?></h1>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! empty( $myhome_top_title_text ) ) : ?>
			<div class="mh-top-title__subheading"><?php echo wp_kses_post( $myhome_top_title_text ); ?></div>
		<?php endif; ?>

		<?php if ( is_author() ):
			/* @var \MyHomeCore\Users\User $myhome_agent */
			global $myhome_agent;
			?>
			<div class="mh-layout" itemprop="RealEstateAgent" itemscope itemtype="http://schema.org/RealEstateAgent">
				<div class="position-relative">
					<?php if ( $myhome_agent->has_image() ) : ?>
						<div class="mh-top-title__avatar">
							<img
								src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_agent->get_image_id(), 'myhome-square-xs' ) ); ?>"
								alt="<?php echo esc_attr( $myhome_agent->get_name() ); ?>"
								itemprop="image"
							>
						</div>
					<?php endif; ?>
					<div class="mh-top-title__author-info">
						<div class="mh-top-title__author-info__content">
							<h1 class="mh-top-title__heading" itemprop="name">
								<?php echo esc_html( $myhome_agent->get_name() ); ?>
							</h1>

							<?php if ( $myhome_agent->has_description() ) : ?>
								<div class="mh-top-title__user-description">
									<?php echo wp_kses_post( $myhome_agent->get_description() ); ?>
								</div>
							<?php endif; ?>

							<div class="mh-agent__additional-fields">
								<?php foreach ( $myhome_agent->get_fields() as $myhome_agent_field ) : ?>
									<?php if ( $myhome_agent_field->get_value() == '' ) {
										continue;
									}
									?>
									<div class="mh-agent__additional-fields__item">
										<strong>
											<?php echo esc_html( $myhome_agent_field->get_name() ); ?>:
										</strong>
										<?php if ( $myhome_agent_field->is_link() ) : ?>
											<a href="<?php echo esc_url( $myhome_agent_field->get_link() ); ?>">
												<?php echo esc_html( $myhome_agent_field->get_value() ); ?>
											</a>
										<?php else :
											echo esc_html( $myhome_agent_field->get_value() );
										endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

							<?php if ( $myhome_agent->has_phone() || $myhome_agent->has_email() ) : ?>
								<div class="mh-agent-contact">
									<?php if ( $myhome_agent->has_email() ) : ?>
										<div class="mh-agent-contact__element">
											<a href="mailto:<?php echo esc_attr( $myhome_agent->get_email() ); ?>">
												<i class="flaticon-mail-2"></i>
												<?php echo esc_html( $myhome_agent->get_email() ); ?>
											</a>
										</div>
									<?php endif; ?>

									<?php if ( $myhome_agent->has_phone() ) : ?>
										<div class="mh-agent-contact__element">
											<a href="tel:<?php echo esc_attr( $myhome_agent->get_phone_href() ); ?>">
												<i class="flaticon-phone"></i>
												<span itemprop="telephone">
													<?php echo esc_html( $myhome_agent->get_phone() ); ?>
												</span>
											</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( $myhome_agent->has_social_icons() ) : ?>
								<div class="mh-top-title__social-icons">
									<?php foreach ( $myhome_agent->get_social_icons() as $myhome_agent_social_icon ) : ?>
										<a href="<?php echo esc_url( $myhome_agent_social_icon->get_link() ); ?>" target="_blank">
											<i class="fa <?php echo esc_attr( $myhome_agent_social_icon->get_css_class() ); ?>"></i>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>
	</div>
<?php
endif;