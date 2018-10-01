<?php
global $myhome_estate;
global $myhome_agent;
?>
<div class="position-relative">
    <div id="mh_rev_slider_single_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
         data-alias="single-estate-slider">
        <div id="mh_rev_slider_single" class="rev_slider myhome-rev_slider fullwidthabanner" data-version="5.3.0">
            <ul class="mh-popup-group">
                <?php
                if ( $myhome_estate->has_gallery() ) :
                    foreach ( $myhome_estate->get_gallery() as $myhome_key => $myhome_image ) : ?>
                        <li data-index="<?php echo esc_attr( $myhome_key ); ?>"
							data-transition="<?php echo esc_attr( $myhome_estate->get_gallery_transition() ); ?>"
							data-slotamount="1,default"
                            data-hideafterloop="0"
                            data-hideslideonmobile="off"
                            data-easein="default,default"
                            data-easeout="default,default"
                            data-masterspeed="100">
                            <img src="<?php echo esc_url( $myhome_image['url'] ); ?>">
                            <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme mh-mask-strong-dark"
                                 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                 data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                 data-width="full"
                                 data-height="full"
                                 data-whitespace="nowrap"
                                 data-type="shape"
                                 data-basealign="slide"
                                 data-responsive_offset="on"
                                 data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                 data-textAlign="['inherit','inherit','inherit','inherit']"
                                 data-paddingtop="[0,0,0,0]"
                                 data-paddingright="[0,0,0,0]"
                                 data-paddingbottom="[0,0,0,0]"
                                 data-paddingleft="[0,0,0,0]"></div>
                            <a href="<?php echo esc_url( $myhome_image['url'] ); ?>" class="mh-popup-group__element">
                                <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                                     data-x="['center','center','center','center']" data-hoffset="['2','2','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                     data-width="full"
                                     data-height="full"
                                     data-whitespace="normal"
                                     data-type="shape"
                                     data-basealign="slide"
                                     data-responsive_offset="on"
                                     data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['inherit','inherit','inherit','inherit']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"></div>
                            </a>
                        </li>
                    <?php
                    endforeach;
                endif;
                ?>
            </ul>
        </div>
    </div>

</div>