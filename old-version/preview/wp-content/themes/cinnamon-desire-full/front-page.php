<?php
get_header();

$settings = cd_control_get_settings();
$home = $settings['home'] ?? array();
$litters = $settings['litters'] ?? array();
$offers = $settings['offers'] ?? array();
$parents = $settings['parents'] ?? array();
?>

<div class="custom-quote-section reveal">
    <h2 class="custom-quote-text"><?php echo wp_kses_post( nl2br( $home['quote'] ?? '' ) ); ?></h2>
    <p class="custom-quote-subtext"><?php echo esc_html( $home['subtitle'] ?? '' ); ?></p>
</div>

<?php foreach ( $litters as $litter ) : ?>
    <div class="custom-lt-container reveal">
        <span class="custom-lt-title"><?php echo esc_html( $litter['title'] ?? '' ); ?></span>
        <span class="custom-lt-date"><?php echo esc_html( $litter['date'] ?? '' ); ?></span>
        <span class="custom-lt-line"></span>
        <span class="custom-lt-status"><?php echo esc_html( $litter['status'] ?? '' ); ?></span>
    </div>

    <div class="mycat-slider-wrapper reveal">
        <button type="button" class="slider-arrow arrow-left" onclick="moveSliderNew(this, -1)">❮</button>
        <div class="mycat-viewport">
            <div class="mycat-section" data-pos="0">
                <?php foreach ( ( $litter['kittens'] ?? array() ) as $kitten ) : ?>
                    <div class="mycat-card-container reveal">
                        <div class="mycat-photo-box">
                            <img src="<?php echo esc_url( $kitten['image'] ?? '' ); ?>" alt="<?php echo esc_attr( $kitten['name'] ?? 'Котенок шотландской породы' ); ?>">
                            <div class="<?php echo 'female' === cinnamon_gender_class( $kitten['sex'] ?? '' ) ? 'mycat-sex-icon-female' : 'mycat-sex-icon'; ?>">
                                <?php echo esc_html( cinnamon_gender_symbol( $kitten['sex'] ?? '' ) ); ?>
                            </div>
                            <div class="mycat-fav-icon" onclick="toggleHeart(this)">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </div>
                            <?php if ( ! empty( $kitten['badge'] ) ) : ?>
                                <div class="coc-badge"><?php echo esc_html( $kitten['badge'] ); ?></div>
                            <?php endif; ?>
                        </div>
                        <a href="#" class="mycat-btn-about early-access-btn" data-kitten="<?php echo esc_attr( $kitten['name'] ?? '' ); ?>">About me</a>
                        <?php if ( ! empty( $kitten['price'] ) || ! empty( $kitten['description'] ) ) : ?>
                            <div class="cd-cat-meta">
                                <?php if ( ! empty( $kitten['name'] ) ) : ?><strong><?php echo esc_html( $kitten['name'] ); ?></strong><?php endif; ?>
                                <?php if ( ! empty( $kitten['description'] ) ) : ?><span><?php echo esc_html( $kitten['description'] ); ?></span><?php endif; ?>
                                <?php if ( ! empty( $kitten['price'] ) ) : ?><em><?php echo esc_html( cinnamon_price( $kitten['price'] ) ); ?></em><?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="button" class="slider-arrow arrow-right" onclick="moveSliderNew(this, 1)">❯</button>
    </div>

    <div style="height: 30px; background-color: #fceee9;"></div>
<?php endforeach; ?>

<?php if ( $offers ) : ?>
    <div class="main-offer-wrapper reveal">
        <div class="offer-header-block">
            <div class="offer-subtitle"><?php echo esc_html( $home['offer_subtitle'] ?? '' ); ?></div>
            <h2 class="offer-title"><?php echo esc_html( $home['offer_title'] ?? '' ); ?></h2>
            <p class="offer-description"><?php echo esc_html( $home['offer_description'] ?? '' ); ?></p>
        </div>

        <div class="kittens-flex-container reveal">
            <?php foreach ( $offers as $offer ) : ?>
                <?php
                $old = (float) preg_replace( '/[^0-9.]/', '', (string) ( $offer['old_price'] ?? '' ) );
                $new = (float) preg_replace( '/[^0-9.]/', '', (string) ( $offer['price'] ?? '' ) );
                $save = $old && $new && $old > $new ? $old - $new : 0;
                ?>
                <div class="cat-offer-card reveal">
                    <div class="coc-media">
                        <img src="<?php echo esc_url( $offer['image'] ?? '' ); ?>" alt="<?php echo esc_attr( $offer['name'] ?? 'Cat' ); ?>" class="coc-img">
                        <?php if ( ! empty( $offer['badge'] ) ) : ?><div class="coc-badge"><?php echo esc_html( $offer['badge'] ); ?></div><?php endif; ?>
                        <div class="coc-fav">♡</div>
                        <div class="coc-gender <?php echo esc_attr( cinnamon_gender_class( $offer['sex'] ?? '' ) ); ?>"><?php echo esc_html( cinnamon_gender_symbol( $offer['sex'] ?? '' ) ); ?></div>
                    </div>
                    <a href="#" class="coc-btn-about early-access-btn" data-kitten="<?php echo esc_attr( $offer['name'] ?? '' ); ?>">About me</a>
                    <div class="coc-price-box">
                        <div class="coc-price-row">
                            <?php if ( ! empty( $offer['old_price'] ) ) : ?><span class="coc-old-price"><?php echo esc_html( cinnamon_price( $offer['old_price'] ) ); ?></span><?php endif; ?>
                            <?php if ( ! empty( $offer['price'] ) ) : ?><span class="coc-new-price"><?php echo esc_html( cinnamon_price( $offer['price'] ) ); ?></span><?php endif; ?>
                        </div>
                        <?php if ( $save ) : ?><div class="coc-save-label">SAVE <?php echo esc_html( cinnamon_price( $save ) ); ?></div><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div style="height: 40px; background-color: #fceee9;"></div>
<?php endif; ?>

<div class="litter-parent-section reveal">
    <div class="litter-flex-row">
        <?php foreach ( array( 'father', 'mother' ) as $role ) : ?>
            <?php $parent = $parents[ $role ] ?? array(); ?>
            <div class="parent-card reveal">
                <div class="parent-media">
                    <img src="<?php echo esc_url( $parent['image'] ?? '' ); ?>" alt="<?php echo esc_attr( $parent['name'] ?? '' ); ?>">
                </div>
                <div class="parent-info">
                    <span class="parent-label"><?php echo esc_html( $parent['label'] ?? '' ); ?></span>
                    <h3 class="parent-name"><?php echo esc_html( $parent['name'] ?? '' ); ?></h3>
                    <div class="parent-tags"><?php cinnamon_tags( $parent['tags'] ?? '' ); ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="expectation-card reveal">
            <div class="date-highlight-box">
                <span class="date-label">ОЖИДАЕМАЯ ДАТА РОЖДЕНИЯ</span>
                <div class="date-value"><?php echo esc_html( $parents['expected_date'] ?? '' ); ?></div>
            </div>
            <p class="expectation-text"><?php echo esc_html( $parents['text'] ?? '' ); ?></p>
            <a href="#" class="early-access-btn">ПОЛУЧИТЬ РАННИЙ ДОСТУП</a>
        </div>
    </div>
</div>

<div id="contactModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Reserve a Kitten</h2>
        <form id="kittenForm">
            <input type="text" name="user_name" placeholder="Your Name" required>
            <input type="email" name="user_email" placeholder="Your Email" required>
            <textarea name="user_message" placeholder="Which kitten are you interested in?" required></textarea>
            <button type="submit" class="submit-btn">Send Request</button>
            <div id="formStatus"></div>
        </form>
    </div>
</div>

<?php get_footer(); ?>
