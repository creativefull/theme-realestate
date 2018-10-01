<?php
/* @var \MyHomeCore\Terms\Term[] $myhome_terms */
global $myhome_terms;
/* @var array $myhome_attribute_carousel */
global $myhome_attribute_carousel;

if ( count( $myhome_terms ) ) :
	?>
    <div class="owl-carousel <?php echo esc_attr( $myhome_attribute_carousel['class'] ); ?>">
		<?php foreach ( $myhome_terms as $myhome_term ) : ?>
            <div class="item">
                <div class="mh-box__content">
                    <a href="<?php echo esc_url( $myhome_term->get_link() ); ?>"
                       title="<?php echo esc_attr( $myhome_term->get_name() ); ?>"
                       class="mh-box">
                        <span class="mh-box__img-wrapper">
                            <?php if ( $myhome_term->has_image() ) :
	                            \MyHomeCore\Common\Image::the_image(
		                            $myhome_term->get_image_id(),
		                            'standard',
		                            $myhome_term->get_name()
	                            );
                            endif; ?>
                        </span>
                        <div class="mh-box__middle">
                            <h3 class="mh-box__title mh-heading mh-heading--style-3">
								<?php echo esc_attr( $myhome_term->get_name() ); ?>
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
		<?php endforeach ?>
    </div>
	<?php
endif;