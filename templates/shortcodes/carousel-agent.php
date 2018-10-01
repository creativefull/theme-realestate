<?php
/* @var \MyHomeCore\Users\User[] $myhome_carousel_agents */
global $myhome_carousel_agents;
/* @var array $myhome_carousel_settings */
global $myhome_carousel_settings;

?>
<div class="owl-carousel <?php echo esc_attr( $myhome_carousel_settings['class'] ); ?>">

	<?php foreach ( $myhome_carousel_agents as $myhome_agent ) : ?>

		<div class="mh-agent <?php echo esc_attr( $myhome_carousel_settings['style'] ); ?>">
			<a href="<?php echo esc_url( $myhome_agent->get_link() ); ?>"
			   class="mh-agent__thumbnail"
			   title="<?php echo esc_attr( $myhome_agent->get_name() ); ?>">
				<?php if ( $myhome_agent->has_image() ) :
					$myhome_agent->image();
				endif; ?>
			</a>

			<div class="mh-agent__content">
				<h3 class="mh-agent__heading">
					<a href="<?php echo esc_url( $myhome_agent->get_link() ); ?>"
					   title="<?php echo esc_attr( $myhome_agent->get_name() ); ?>">
						<?php echo esc_html( $myhome_agent->get_name() ); ?>
					</a>
				</h3>

				<?php if ( ! empty( $myhome_carousel_settings['description_show'] ) ) :
					$short_description = $myhome_agent->get_short_description();
					if ( ! empty( $short_description ) ) : ?>
						<div class="mh-agent__text">
							<?php echo esc_html( $short_description ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

                <?php if ( ! empty( $myhome_carousel_settings['additional_fields_show'] ) ) : ?>
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
                <?php endif; ?>

				<div class="mh-agent-contact">
					<?php if ( ! empty( $myhome_carousel_settings['email_show'] ) ) : ?>
						<?php if ( $myhome_agent->has_email() ) : ?>
							<div class="mh-agent-contact__element">
								<a href="mailto:<?php echo esc_attr( $myhome_agent->get_email() ); ?>">
									<i class="flaticon-mail-2"></i>
									<?php echo esc_html( $myhome_agent->get_email() ); ?>
								</a>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( ! empty( $myhome_carousel_settings['phone_show'] ) ) : ?>
						<?php if ( $myhome_agent->get_phone() != '' ) : ?>
							<div class="mh-agent-contact__element">
								<a href="tel:<?php echo esc_attr( $myhome_agent->get_phone_href() ); ?>">
									<i class="flaticon-phone"></i>
									<?php echo esc_html( $myhome_agent->get_phone() ); ?>
								</a>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $myhome_carousel_settings['social_icons_show'] ) && $myhome_agent->has_social_icons() ) : ?>
					<div class="mh-agent__social-wrapper">
						<div class="mh-agent__social">
							<?php foreach ( $myhome_agent->get_social_icons() as $myhome_agent_social_icon ) :
								$myhome_agent_social_icon->display();
							endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $myhome_carousel_settings['button_show'] ) ) : ?>
					<div class="mh-agent__button-wrapper">
						<div class="mh-agent__button">
							<a href="<?php echo esc_url( $myhome_agent->get_link() ); ?>"
							   title="<?php echo esc_attr( $myhome_agent->get_name() ); ?>"
							   class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary-ghost">
								<?php esc_html_e( 'Full Profile', 'myhome' ); ?>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

	<?php endforeach; ?>

</div>