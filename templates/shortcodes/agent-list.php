<?php
global $myhome_agents_list;
?>

<div class="mh-agent-list">

	<?php foreach ( $myhome_agents_list['agents'] as $myhome_agent ) :
		/* @var \MyHomeCore\Users\Agent $myhome_agent */
		?>
		<div class="mh-agent-list__element">
			<article class="mh-agent <?php echo esc_attr( $myhome_agents_list['agent_style'] ); ?>">
				<a href="<?php echo esc_url( $myhome_agent->get_link() ); ?>"
				   class="mh-agent__thumbnail" title="<?php echo esc_attr( $myhome_agent->get_name() ); ?>">
					<?php
					if ( $myhome_agent->has_image() ) :
						$myhome_agent->image();
					endif;
					?>
				</a>

				<div class="mh-agent__content">
					<h3 class="mh-agent__heading">
						<a href="<?php echo esc_url( $myhome_agent->get_link() ); ?>">
							<?php echo esc_attr( $myhome_agent->get_name() ); ?>
						</a>
					</h3>

					<?php if ( ! empty( $myhome_agents_list['description_show'] ) ) : ?>
						<?php if ( $myhome_agent->get_description() != '' ) : ?>
							<div class="mh-agent__text">
								<?php
								echo esc_html(
									wp_trim_words(
										$myhome_agent->get_description(),
										35,
										'...'
									)
								);
								?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

                    <?php if ( ! empty( $myhome_agents_list['additional_fields_show'] ) ) : ?>
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
						<?php if ( ! empty( $myhome_agents_list['email_show'] ) ) : ?>
							<?php if ( $myhome_agent->has_email() ) : ?>
								<div class="mh-agent-contact__element">
									<a href="mailto:<?php echo esc_attr( $myhome_agent->get_email() ); ?>">
										<i class="flaticon-mail-2"></i>
										<?php echo esc_html( $myhome_agent->get_email() ); ?>
									</a>
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( ! empty( $myhome_agents_list['phone_show'] ) ) : ?>
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

					<?php if ( ! empty( $myhome_agents_list['social_icons_show'] ) && $myhome_agent->has_social_icons() ) : ?>
						<div class="mh-agent__social-wrapper">
							<div class="mh-agent__social">
								<?php foreach ( $myhome_agent->get_social_icons() as $myhome_agent_social ) : ?>
									<a href="<?php echo esc_url( $myhome_agent_social->get_link() ); ?>"
									   title="<?php esc_attr( $myhome_agent_social->get_css_class() ); ?>"
									   target="_blank">
										<i class="fa fa-<?php echo esc_attr( $myhome_agent_social->get_css_class() ); ?>"></i>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $myhome_agents_list['button_show'] ) ) : ?>
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
			</article>
		</div>

	<?php endforeach; ?>
</div>