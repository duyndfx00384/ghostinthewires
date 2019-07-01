<li class="edgt-tl-item">
    <div class="edgt-tli-inner">
        <div class="edgt-tli-content">
            <div class="edgt-twitter-content-top">
                <div class="edgt-twitter-user clearfix">
                    <div class="edgt-twitter-image">
                        <img src="<?php echo esc_html( $twitter_api->getHelper()->getTweetProfileImage( $tweet ) ); ?>" alt="<?php echo esc_html( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>"/>
                    </div>
                    <div class="edgt-twitter-name">
                        <div class="edgt-twitter-autor">
                            <h5>
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>
                            </h5>
                        </div>
                        <div class="edgt-twitter-profile">
                            <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url">
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileScreenName( $tweet ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="edgt-twitter-icon">
                    <i class="social_twitter"></i>
                </div>
            </div>
            <div class="edgt-twitter-content-bottom">
                <div class="edgt-tweet-text">
                    <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                </div>
            </div>
            <div class="edgt-twitter-link-over">
                <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url"></a>
            </div>
        </div>
    </div>
</li>