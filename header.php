<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php wp_head(); ?>
</head>

<body id="myhome-app" <?php body_class( 'myhome-' . str_replace( '.', '-', My_Home_Theme()->version ) ); ?>>
<?php
$myhome_top_header_style        = My_Home_Theme()->layout->top_header_style();
$myhome_top_wide                = My_Home_Theme()->layout->top_wide();
$myhome_sticky_menu             = My_Home_Theme()->layout->sticky_menu();
$myhome_sticky_menu_transparent = My_Home_Theme()->layout->sticky_menu_transparent();
$myhome_menu_primary            = My_Home_Theme()->layout->menu_primary();
$myhome_top_header_class        = '';
if ( $myhome_sticky_menu == 1 ) { ?>

<div class="mh-fixed-menu mh-fixed-menu--transparent-<?php echo $myhome_sticky_menu_transparent; ?>">
	<?php }

	if ( $myhome_top_header_style == 'small-primary' ) {
		$myhome_top_header_class = 'mh-top-header--primary';
	} elseif ( $myhome_top_header_style == 'small' ) {
		$myhome_top_header_class = 'mh-top-header--default';
	}

	if ( $myhome_top_wide == 1 ) : ?>
	<div class="mh-top-wide">
		<?php endif;

		if ( $myhome_menu_primary == 1 ) : ?>
		<div class="mh-menu-primary-color-background">
			<?php endif;

			if ( $myhome_top_header_style == 'small' || $myhome_top_header_style == 'small-primary' ) : ?>
				<div class="mh-top-header <?php echo esc_attr( $myhome_top_header_class ); ?>">

					<div class="mh-layout">

						<?php
						$myhome_currency_switcher    = My_Home_Theme()->settings->get( 'currency_switcher' );
						$myhome_default_currency     = My_Home_Theme()->settings->get( 'currency_switcher-default' );

						if ( ! empty( $myhome_currency_switcher ) && class_exists( '\MyHomeCore\Attributes\Price_Attribute_Options_Page' ) ) :
							$myhome_currencies = \MyHomeCore\Attributes\Price_Attribute_Options_Page::get_currencies();
							$myhome_default_currency = empty( $myhome_default_currency ) ? 'any' : $myhome_default_currency;
							?>
							<div class="mh-menu-currency-wrapper">
								<span class="mh-currency-switcher__label"><?php esc_html_e( 'Currency ', 'myhome' ); ?></span>
								<select id="mh-menu-currency_switcher" class="selectpicker mh-currency-switcher">
									<option
										value="any"
										<?php if ( \MyHomeCore\My_Home_Core()->currency == 'any' ) : ?>
											selected="selected"
										<?php endif; ?>
									><?php esc_html_e( 'Any', 'myhome' ); ?></option>
									<?php foreach ( $myhome_currencies as $myhome_currency ) : ?>
										<option
											value="<?php echo esc_attr( $myhome_currency['key'] ); ?>"
											<?php if ( \MyHomeCore\My_Home_Core()->currency == $myhome_currency['key'] ) : ?>
												selected="selected"
											<?php endif; ?>
										>
											<?php echo esc_html( $myhome_currency['sign'] ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>

						<?php
						endif;

						if ( My_Home_Theme()->layout->show_language_switcher() ) : ?>
							<div class="mh-wpml-top-bar">
								<?php foreach ( My_Home_Theme()->layout->get_language_flags() as $myhome_lang ) : ?>
									<?php if ( ! empty( $myhome_lang['url'] ) ) : ?>
										<div class="mh-wpml-top-bar__item
                                            <?php if ( ! empty( $myhome_lang['active'] ) && $myhome_lang['active'] == '1' ) : ?>
                                                mh-active-lang
                                            <?php endif; ?>
                                        ">
											<a href="<?php echo esc_url( $myhome_lang['url'] ); ?>">
												<img src="<?php echo esc_attr( $myhome_lang['country_flag_url'] ); ?>" alt="">
											</a>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->has_header_phone() ) : ?>
							<span class="mh-top-header__element mh-top-header__element--phone">
								<a href="tel:<?php echo esc_html( My_Home_Theme()->layout->get_header_phone_href() ); ?>">
									<i class="flaticon-phone"></i>
									<?php echo esc_html( My_Home_Theme()->layout->get_header_phone() ); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->has_header_address() ) : ?>
							<span class="mh-top-header__element">
								<address>
									<i class="flaticon-pin"></i>
									<?php echo esc_html( My_Home_Theme()->layout->get_header_address() ); ?>
								</address>
							</span>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->has_header_email() ) : ?>
							<span class="mh-top-header__element mh-top-header__element--mail">
								<a href="mailto:<?php echo esc_html( My_Home_Theme()->layout->get_header_email() ); ?>">
									<i class="flaticon-mail-2"></i>
									<?php echo esc_html( My_Home_Theme()->layout->get_header_email() ); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->has_header_social_icons() ) : ?>
							<span class="mh-top-header__element mh-top-header__element--social-icons">
								<?php get_template_part( 'templates/header', 'social-icons' ); ?>
							</span>
						<?php endif; ?>

						<div class="mh-top-bar-user-panel-small">
							<?php if ( My_Home_Theme()->layout->agent_mode() ) : ?>
								<div class="mh-top-bar-user-panel">
									<user-bar id="myhome-user-bar"></user-bar>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php elseif ( $myhome_top_header_style == 'big' ): ?>

				<div class="mh-top-header-big">
					<div class="mh-top-header-big__content">

						<?php if ( My_Home_Theme()->layout->has_big_top_logo() ) : ?>
							<div class="mh-top-header-big__logo-placeholder">
								<a href="<?php echo esc_url( site_url() ); ?>" class="mh-top-header-big__logo">
									<img src="<?php echo esc_url( My_Home_Theme()->layout->get_big_top_logo() ); ?>"
										 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
								</a>
							</div>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->has_header_phone() ) : ?>
							<div class="mh-top-header-big__element  mh-top-header-big__element--phone">
								<a href="tel:<?php echo esc_html( My_Home_Theme()->layout->get_header_phone_href() ); ?>">
									<i class="flaticon-phone mh-top-header-big__element__icon-big"></i>
									<div class="mh-top-header-big__value">
										<?php echo esc_html( My_Home_Theme()->layout->get_header_phone() ); ?>
									</div>
								</a>
							</div>
						<?php endif;

						if ( My_Home_Theme()->layout->has_header_address() ) : ?>
							<div class="mh-top-header-big__element mh-top-header-big__element--address">
								<i class="flaticon-pin mh-top-header-big__element__icon-big"></i>
								<div class="mh-top-header-big__value">
									<?php echo esc_html( My_Home_Theme()->layout->get_header_address() ); ?>
								</div>
							</div>
						<?php endif;

						if ( My_Home_Theme()->layout->has_header_email() ) : ?>
							<div class="mh-top-header-big__element mh-top-header-big__element--email">
								<a href="mailto:<?php echo esc_html( My_Home_Theme()->layout->get_header_email() ); ?>">
									<i class="flaticon-mail-2 mh-top-header-big__element__icon-big"></i>
									<div class="mh-top-header-big__value">
										<?php echo esc_html( My_Home_Theme()->layout->get_header_email() ); ?>
									</div>
								</a>
							</div>
						<?php endif;

						if ( My_Home_Theme()->layout->has_header_social_icons() ) : ?>
							<div class="mh-top-header-big__social-icons">
								<?php get_template_part( 'templates/header', 'social-icons' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( My_Home_Theme()->layout->agent_mode() ) : ?>
							<div class="mh-top-bar-user-panel">
								<user-bar id="myhome-user-bar"></user-bar>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( My_Home_Theme()->layout->is_mega_main_menu_active() && has_nav_menu( 'mh-primary' ) ) : ?>
				<div class="<?php echo esc_attr( My_Home_Theme()->layout->header_class() ); ?>">
					<?php wp_nav_menu( array( 'theme_location' => 'mh-primary' ) ); ?>
				</div>
			<?php else : ?>
				<div class="mh-navbar__wrapper">
					<nav class="mh-navbar">
						<div class="mh-navbar__container">
							<div class="mh-navbar__header">
								<?php if ( My_Home_Theme()->layout->has_logo() ) : ?>
									<a href="<?php echo esc_url( home_url() ); ?>" class="mh-navbar__brand"
									   title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
										<img src="<?php echo esc_url( My_Home_Theme()->layout->get_logo() ); ?>"
											 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
									</a>
								<?php else : ?>
									<a href="<?php echo esc_url( home_url() ); ?>" class="mh-navbar__blog-name"
									   title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
										<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
									</a>
								<?php endif; ?>
								<div class="mh-navbar__toggle">
                                    <span class="mh-navbar__toggle-icon">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </span>
								</div>
							</div>

							<div class="mh-navbar__menu">
								<?php
								if ( has_nav_menu( 'mh-primary' ) ) :
									wp_nav_menu( array( 'theme_location' => 'mh-primary' ) );
								else:
									wp_nav_menu();
								endif;
								?>
							</div>
						</div>
					</nav>
				</div>
			<?php endif;

			if ( $myhome_menu_primary == 1 ) : ?>
		</div>
	<?php endif;

	if ( $myhome_top_wide ) : ?>
	</div>
<?php endif;

if ( $myhome_sticky_menu == 1 ) : ?>
</div>
	<div
		class="mh-sticky-menu-placeholder"
		<?php if ( My_Home_Theme()->layout->set_sticky_height() ) : ?>
			style="height: <?php echo esc_attr( My_Home_Theme()->layout->get_sticky_holder_height() ); ?>px;"
		<?php endif; ?>
	></div>
<?php endif; ?>
