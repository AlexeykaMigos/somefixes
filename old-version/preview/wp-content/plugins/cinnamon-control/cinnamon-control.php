<?php
/**
 * Plugin Name: Cinnamon Control
 * Description: Visual admin panel for Cinnamon Desire content, kittens, media and SEO.
 * Version: 1.0.0
 * Author: Cinnamon Desire
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'CD_CONTROL_OPTION', 'cd_control_settings' );
define( 'CD_CONTROL_VERSION', '1.0.0' );

function cd_control_default_settings() {
    return array(
        'brand' => array(
            'name' => 'CINNAMON DESIRE',
            'tagline' => 'ПИТОМНИК ШОТЛАНДСКИХ КОШЕК',
            'phone' => '+7 (999) 843-68-11',
            'email' => 'hello@cinnamon.com',
            'address' => 'Moscow, Russia',
            'footer_about' => 'Питомник с более чем 10-летней историей. Мы выращиваем кошек с любовью и уважением к их природе.',
            'vk' => '#',
            'telegram' => '#',
            'whatsapp' => '#',
        ),
        'home' => array(
            'quote' => '"Each kitten is a piece of our soul, raised with boundless love"',
            'subtitle' => 'Посмотрите на наших шотландских котят, распределенных по пометам в удобных каруселях.',
            'offer_subtitle' => 'EXCLUSIVE OPPORTUNITY',
            'offer_title' => 'Offer for today',
            'offer_description' => 'Discover unique conditions for our most outstanding representatives.',
        ),
        'litters' => array(
            array(
                'title' => 'Litter F',
                'date' => '06.20.2024',
                'status' => '6 КОТЯТ В ПОМЕТЕ',
                'kittens' => array(
                    array( 'name' => 'Archie', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg', 'price' => '1500', 'old_price' => '1800', 'badge' => 'AVAILABLE', 'description' => 'Scottish kitten with a gentle character.' ),
                    array( 'name' => 'Misty', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/k22.jpg', 'price' => '1400', 'old_price' => '1650', 'badge' => 'AVAILABLE', 'description' => 'Playful, social and ready for reservation.' ),
                    array( 'name' => 'Casper', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/k333.jpg', 'price' => '1200', 'old_price' => '1500', 'badge' => 'RESERVE', 'description' => 'Calm and affectionate Scottish kitten.' ),
                    array( 'name' => 'Luna', 'sex' => 'female', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/k44.jpg', 'price' => '1600', 'old_price' => '', 'badge' => 'AVAILABLE', 'description' => 'Tender girl with expressive eyes.' ),
                ),
            ),
            array(
                'title' => 'Litter A',
                'date' => '01.20.2025',
                'status' => '4 КОТЕНКА В ПОМЕТЕ',
                'kittens' => array(
                    array( 'name' => 'Bruno', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/aa1.jpg', 'price' => '1100', 'old_price' => '1350', 'badge' => 'SPECIAL PRICE', 'description' => 'Compact, bright and very affectionate.' ),
                    array( 'name' => 'Oscar', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e.png', 'price' => '1300', 'old_price' => '', 'badge' => 'AVAILABLE', 'description' => 'A confident kitten for a loving family.' ),
                    array( 'name' => 'Mila', 'sex' => 'female', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e44.png', 'price' => '1450', 'old_price' => '', 'badge' => 'AVAILABLE', 'description' => 'Soft temperament and beautiful coat.' ),
                ),
            ),
        ),
        'offers' => array(
            array( 'name' => 'Archie', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg', 'price' => '1500', 'old_price' => '1800', 'badge' => 'SPECIAL PRICE' ),
            array( 'name' => 'Misty', 'sex' => 'female', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg', 'price' => '1400', 'old_price' => '1650', 'badge' => 'SPECIAL PRICE' ),
            array( 'name' => 'Bruno', 'sex' => 'male', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg', 'price' => '1100', 'old_price' => '1350', 'badge' => 'SPECIAL PRICE' ),
        ),
        'parents' => array(
            'father' => array( 'label' => 'ОТЕЦ', 'name' => 'Golden Leo King', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e44.png', 'tags' => 'SCOTTISH STRAIGHT, GICH WCF' ),
            'mother' => array( 'label' => 'МАТЬ', 'name' => 'Cinnamon Gracia', 'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/k44.jpg', 'tags' => 'SCOTTISH FOLD, CH WCF' ),
            'expected_date' => 'October 2024',
            'text' => 'Свяжитесь с нами, чтобы попасть в приоритетный список ожидания на этот помет.',
        ),
        'pages' => array(
            'about' => array(
                'title' => 'Cinnamon Desire',
                'description' => 'Узнайте историю нашего питомника, нашу миссию и то, как мы создаем идеальные условия для каждого пушистого сердца.',
                'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/k22.jpg',
                'body' => 'Все началось с любви к одной кошке, которая переросла в дело всей жизни. За десятилетие мы прошли путь от хобби до лицензированного питомника WCF.',
            ),
            'adoption' => array(
                'title' => 'Путь к усыновлению',
                'description' => 'От первого взгляда до первого мурлыканья в вашем доме — прозрачный пошаговый процесс.',
                'image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/photo1.jpg',
            ),
            'faq' => array(
                'title' => 'FAQ',
                'description' => 'Все, что вам нужно знать перед тем, как принести маленького шотландского друга домой.',
                'items' => array(
                    array( 'question' => 'Как забронировать котенка?', 'answer' => 'Для бронирования свяжитесь с нами для обсуждения деталей и внесения депозита.' ),
                    array( 'question' => 'В каком возрасте котенок может переехать?', 'answer' => 'Обычно котята готовы к переезду в возрасте 12-16 недель после полной вакцинации и карантина.' ),
                    array( 'question' => 'Есть ли доставка?', 'answer' => 'Да, мы организуем бережную и безопасную доставку по всему миру.' ),
                ),
            ),
            'contacts' => array( 'title' => 'Contacts', 'description' => 'Свяжитесь с нами, чтобы забронировать котенка или задать вопрос.' ),
            'blog' => array( 'title' => 'Blog', 'description' => 'Новости питомника и полезные материалы о шотландских кошках.' ),
            'reviews' => array( 'title' => 'Reviews', 'description' => 'Истории семей, которые уже нашли своего питомца.' ),
        ),
        'seo' => array(
            'global' => array(
                'site_title' => 'Cinnamon Desire Cattery',
                'separator' => '|',
                'robots' => 'index,follow',
                'og_image' => 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg',
                'schema_type' => 'PetStore',
            ),
            'pages' => array(
                'home' => array( 'title' => 'Scottish Fold Kittens for Sale', 'description' => 'Scottish Fold and Scottish Straight kittens raised with love by Cinnamon Desire.', 'keywords' => 'Scottish kittens, Scottish Fold, Scottish Straight, cattery' ),
                'adoption' => array( 'title' => 'Adoption Process', 'description' => 'Transparent adoption process for Cinnamon Desire Scottish kittens.', 'keywords' => 'kitten adoption, Scottish Fold adoption' ),
                'faq' => array( 'title' => 'FAQ', 'description' => 'Answers about booking, delivery, documents and kitten care.', 'keywords' => 'kitten faq, Scottish kitten documents' ),
                'about-us' => array( 'title' => 'About Cinnamon Desire', 'description' => 'Learn about Cinnamon Desire cattery, values and breeding philosophy.', 'keywords' => 'cattery, Scottish cats breeder' ),
                'contacts' => array( 'title' => 'Contacts', 'description' => 'Contact Cinnamon Desire to reserve a kitten.', 'keywords' => 'contact cattery, reserve kitten' ),
                'blog' => array( 'title' => 'Blog', 'description' => 'Cattery news and useful articles.', 'keywords' => 'cat blog, kitten care' ),
                'reviews' => array( 'title' => 'Reviews', 'description' => 'Reviews from Cinnamon Desire families.', 'keywords' => 'cattery reviews' ),
            ),
        ),
    );
}

function cd_control_array_merge_recursive_distinct( array $base, array $override ) {
    foreach ( $override as $key => $value ) {
        if ( is_array( $value ) && isset( $base[ $key ] ) && is_array( $base[ $key ] ) && ! wp_is_numeric_array( $value ) ) {
            $base[ $key ] = cd_control_array_merge_recursive_distinct( $base[ $key ], $value );
        } else {
            $base[ $key ] = $value;
        }
    }

    return $base;
}

function cd_control_get_settings() {
    $saved = get_option( CD_CONTROL_OPTION, array() );

    if ( ! is_array( $saved ) ) {
        $saved = array();
    }

    return cd_control_array_merge_recursive_distinct( cd_control_default_settings(), $saved );
}

function cd_control_update_settings( $settings ) {
    update_option( CD_CONTROL_OPTION, $settings, false );
}

function cd_control_get( $path, $default = '' ) {
    $value = cd_control_get_settings();

    foreach ( explode( '.', $path ) as $part ) {
        if ( ! is_array( $value ) || ! array_key_exists( $part, $value ) ) {
            return $default;
        }
        $value = $value[ $part ];
    }

    return $value;
}

function cd_control_sanitize_deep( $value ) {
    if ( is_array( $value ) ) {
        $clean = array();
        foreach ( $value as $key => $item ) {
            $clean[ sanitize_key( $key ) ] = cd_control_sanitize_deep( $item );
        }
        return $clean;
    }

    return is_string( $value ) ? wp_kses_post( wp_unslash( $value ) ) : $value;
}

add_action( 'admin_menu', 'cd_control_admin_menu' );
function cd_control_admin_menu() {
    add_menu_page(
        'Cinnamon Control',
        'Cinnamon Control',
        'manage_options',
        'cinnamon-control',
        'cd_control_admin_page',
        'dashicons-pets',
        3
    );
}

add_action( 'admin_enqueue_scripts', 'cd_control_admin_assets' );
function cd_control_admin_assets( $hook ) {
    if ( 'toplevel_page_cinnamon-control' !== $hook ) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_style( 'cd-control-admin', plugin_dir_url( __FILE__ ) . 'assets/admin.css', array(), CD_CONTROL_VERSION );
    wp_enqueue_script( 'cd-control-admin', plugin_dir_url( __FILE__ ) . 'assets/admin.js', array( 'jquery', 'wp-util' ), CD_CONTROL_VERSION, true );
}

function cd_control_field( $name, $value, $label, $type = 'text', $class = '' ) {
    $id = 'cd_' . md5( $name );
    ?>
    <label class="cd-field <?php echo esc_attr( $class ); ?>" for="<?php echo esc_attr( $id ); ?>">
        <span><?php echo esc_html( $label ); ?></span>
        <?php if ( 'textarea' === $type ) : ?>
            <textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="4"><?php echo esc_textarea( $value ); ?></textarea>
        <?php else : ?>
            <input id="<?php echo esc_attr( $id ); ?>" type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endif; ?>
    </label>
    <?php
}

function cd_control_media_field( $name, $value, $label ) {
    ?>
    <label class="cd-field cd-media-field">
        <span><?php echo esc_html( $label ); ?></span>
        <div class="cd-media-row">
            <input type="url" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" data-cd-preview>
            <button type="button" class="button cd-upload">Upload</button>
        </div>
        <img src="<?php echo esc_url( $value ); ?>" alt="" class="cd-thumb">
    </label>
    <?php
}

function cd_control_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_POST['cd_control_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cd_control_nonce'] ) ), 'cd_control_save' ) ) {
        $settings = isset( $_POST['cd'] ) ? cd_control_sanitize_deep( $_POST['cd'] ) : array();
        cd_control_update_settings( cd_control_array_merge_recursive_distinct( cd_control_default_settings(), $settings ) );
        echo '<div class="notice notice-success"><p>Настройки Cinnamon сохранены.</p></div>';
    }

    $settings = cd_control_get_settings();
    ?>
    <div class="wrap cd-admin">
        <div class="cd-hero-panel">
            <div>
                <p class="cd-kicker">Cinnamon Desire</p>
                <h1>Визуальная админка сайта</h1>
                <p>Меняйте тексты, фото, каталог котят, офферы, контакты и SEO. Справа и внутри карточек данные обновляются на лету во время ввода.</p>
            </div>
            <div class="cd-live-preview">
                <img src="<?php echo esc_url( $settings['seo']['global']['og_image'] ); ?>" alt="">
                <strong data-live="brand"><?php echo esc_html( $settings['brand']['name'] ); ?></strong>
                <span data-live="hero"><?php echo esc_html( $settings['home']['quote'] ); ?></span>
            </div>
        </div>

        <form method="post" class="cd-form">
            <?php wp_nonce_field( 'cd_control_save', 'cd_control_nonce' ); ?>
            <nav class="cd-tabs" aria-label="Cinnamon sections">
                <button type="button" class="active" data-tab="content">Контент</button>
                <button type="button" data-tab="catalog">Кошки</button>
                <button type="button" data-tab="pages">Страницы</button>
                <button type="button" data-tab="seo">SEO</button>
            </nav>

            <section class="cd-tab active" id="cd-tab-content">
                <div class="cd-grid">
                    <div class="cd-card">
                        <h2>Бренд и контакты</h2>
                        <?php
                        cd_control_field( 'cd[brand][name]', $settings['brand']['name'], 'Название' );
                        cd_control_field( 'cd[brand][tagline]', $settings['brand']['tagline'], 'Подпись под логотипом' );
                        cd_control_field( 'cd[brand][phone]', $settings['brand']['phone'], 'Телефон' );
                        cd_control_field( 'cd[brand][email]', $settings['brand']['email'], 'Email', 'email' );
                        cd_control_field( 'cd[brand][address]', $settings['brand']['address'], 'Адрес' );
                        cd_control_field( 'cd[brand][footer_about]', $settings['brand']['footer_about'], 'Текст в футере', 'textarea' );
                        ?>
                    </div>
                    <div class="cd-card">
                        <h2>Главная страница</h2>
                        <?php
                        cd_control_field( 'cd[home][quote]', $settings['home']['quote'], 'Главная цитата', 'textarea' );
                        cd_control_field( 'cd[home][subtitle]', $settings['home']['subtitle'], 'Описание под цитатой', 'textarea' );
                        cd_control_field( 'cd[home][offer_subtitle]', $settings['home']['offer_subtitle'], 'Надзаголовок офферов' );
                        cd_control_field( 'cd[home][offer_title]', $settings['home']['offer_title'], 'Заголовок офферов' );
                        cd_control_field( 'cd[home][offer_description]', $settings['home']['offer_description'], 'Описание офферов', 'textarea' );
                        ?>
                    </div>
                </div>
            </section>

            <section class="cd-tab" id="cd-tab-catalog">
                <div class="cd-card cd-repeater" data-repeater="litters">
                    <div class="cd-card-head">
                        <h2>Пометы и каталог кошек</h2>
                        <button type="button" class="button button-primary cd-add-litter">Добавить помет</button>
                    </div>
                    <div class="cd-litters">
                        <?php foreach ( $settings['litters'] as $litter_index => $litter ) : ?>
                            <?php cd_control_render_litter_editor( $litter, $litter_index ); ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="cd-card">
                    <h2>Офферы дня</h2>
                    <div class="cd-offers">
                        <?php foreach ( $settings['offers'] as $offer_index => $offer ) : ?>
                            <div class="cd-mini-card">
                                <?php
                                cd_control_field( "cd[offers][$offer_index][name]", $offer['name'], 'Имя' );
                                cd_control_field( "cd[offers][$offer_index][sex]", $offer['sex'], 'Пол: male/female' );
                                cd_control_media_field( "cd[offers][$offer_index][image]", $offer['image'], 'Фото' );
                                cd_control_field( "cd[offers][$offer_index][old_price]", $offer['old_price'], 'Старая цена' );
                                cd_control_field( "cd[offers][$offer_index][price]", $offer['price'], 'Новая цена' );
                                cd_control_field( "cd[offers][$offer_index][badge]", $offer['badge'], 'Бейдж' );
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="cd-card">
                    <h2>Родители и ожидание</h2>
                    <div class="cd-grid two">
                        <div>
                            <?php
                            cd_control_field( 'cd[parents][father][label]', $settings['parents']['father']['label'], 'Лейбл отца' );
                            cd_control_field( 'cd[parents][father][name]', $settings['parents']['father']['name'], 'Имя отца' );
                            cd_control_media_field( 'cd[parents][father][image]', $settings['parents']['father']['image'], 'Фото отца' );
                            cd_control_field( 'cd[parents][father][tags]', $settings['parents']['father']['tags'], 'Теги отца через запятую' );
                            ?>
                        </div>
                        <div>
                            <?php
                            cd_control_field( 'cd[parents][mother][label]', $settings['parents']['mother']['label'], 'Лейбл матери' );
                            cd_control_field( 'cd[parents][mother][name]', $settings['parents']['mother']['name'], 'Имя матери' );
                            cd_control_media_field( 'cd[parents][mother][image]', $settings['parents']['mother']['image'], 'Фото матери' );
                            cd_control_field( 'cd[parents][mother][tags]', $settings['parents']['mother']['tags'], 'Теги матери через запятую' );
                            ?>
                        </div>
                    </div>
                    <?php
                    cd_control_field( 'cd[parents][expected_date]', $settings['parents']['expected_date'], 'Ожидаемая дата' );
                    cd_control_field( 'cd[parents][text]', $settings['parents']['text'], 'Текст ожидания', 'textarea' );
                    ?>
                </div>
            </section>

            <section class="cd-tab" id="cd-tab-pages">
                <div class="cd-grid">
                    <?php foreach ( $settings['pages'] as $slug => $page ) : ?>
                        <div class="cd-card">
                            <h2><?php echo esc_html( ucfirst( str_replace( '-', ' ', $slug ) ) ); ?></h2>
                            <?php
                            cd_control_field( "cd[pages][$slug][title]", $page['title'] ?? '', 'Заголовок' );
                            cd_control_field( "cd[pages][$slug][description]", $page['description'] ?? '', 'Описание', 'textarea' );
                            if ( isset( $page['image'] ) ) {
                                cd_control_media_field( "cd[pages][$slug][image]", $page['image'], 'Главное фото' );
                            }
                            if ( isset( $page['body'] ) ) {
                                cd_control_field( "cd[pages][$slug][body]", $page['body'], 'Основной текст', 'textarea' );
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="cd-tab" id="cd-tab-seo">
                <div class="cd-card">
                    <h2>Глобальные SEO настройки</h2>
                    <?php
                    cd_control_field( 'cd[seo][global][site_title]', $settings['seo']['global']['site_title'], 'Название сайта' );
                    cd_control_field( 'cd[seo][global][separator]', $settings['seo']['global']['separator'], 'Разделитель title' );
                    cd_control_field( 'cd[seo][global][robots]', $settings['seo']['global']['robots'], 'Robots meta' );
                    cd_control_field( 'cd[seo][global][schema_type]', $settings['seo']['global']['schema_type'], 'Schema.org type' );
                    cd_control_media_field( 'cd[seo][global][og_image]', $settings['seo']['global']['og_image'], 'OG image по умолчанию' );
                    ?>
                </div>
                <div class="cd-grid">
                    <?php foreach ( $settings['seo']['pages'] as $slug => $seo ) : ?>
                        <div class="cd-card">
                            <h2>SEO: <?php echo esc_html( $slug ); ?></h2>
                            <?php
                            cd_control_field( "cd[seo][pages][$slug][title]", $seo['title'] ?? '', 'Meta title' );
                            cd_control_field( "cd[seo][pages][$slug][description]", $seo['description'] ?? '', 'Meta description', 'textarea' );
                            cd_control_field( "cd[seo][pages][$slug][keywords]", $seo['keywords'] ?? '', 'Keywords' );
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <div class="cd-savebar">
                <span>Изменения применятся на сайте сразу после сохранения.</span>
                <button type="submit" class="button button-primary button-hero">Сохранить настройки</button>
            </div>
        </form>
    </div>
    <?php
}

function cd_control_render_litter_editor( $litter, $litter_index ) {
    ?>
    <div class="cd-litter" data-litter-index="<?php echo esc_attr( $litter_index ); ?>">
        <div class="cd-litter-head">
            <strong><?php echo esc_html( $litter['title'] ?? 'New Litter' ); ?></strong>
            <button type="button" class="button cd-add-kitten">Добавить котенка</button>
            <button type="button" class="button cd-remove-block">Удалить помет</button>
        </div>
        <div class="cd-grid three">
            <?php
            cd_control_field( "cd[litters][$litter_index][title]", $litter['title'] ?? '', 'Название помета' );
            cd_control_field( "cd[litters][$litter_index][date]", $litter['date'] ?? '', 'Дата' );
            cd_control_field( "cd[litters][$litter_index][status]", $litter['status'] ?? '', 'Статус' );
            ?>
        </div>
        <div class="cd-kittens">
            <?php foreach ( ( $litter['kittens'] ?? array() ) as $kitten_index => $kitten ) : ?>
                <?php cd_control_render_kitten_editor( $kitten, $litter_index, $kitten_index ); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

function cd_control_render_kitten_editor( $kitten, $litter_index, $kitten_index ) {
    ?>
    <div class="cd-kitten cd-mini-card" data-kitten-index="<?php echo esc_attr( $kitten_index ); ?>">
        <div class="cd-mini-head">
            <strong><?php echo esc_html( $kitten['name'] ?? 'Kitten' ); ?></strong>
            <button type="button" class="button cd-remove-block">Удалить</button>
        </div>
        <div class="cd-grid three">
            <?php
            cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][name]", $kitten['name'] ?? '', 'Имя' );
            cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][sex]", $kitten['sex'] ?? 'male', 'Пол: male/female' );
            cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][badge]", $kitten['badge'] ?? '', 'Статус/бейдж' );
            cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][old_price]", $kitten['old_price'] ?? '', 'Старая цена' );
            cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][price]", $kitten['price'] ?? '', 'Цена' );
            cd_control_media_field( "cd[litters][$litter_index][kittens][$kitten_index][image]", $kitten['image'] ?? '', 'Фото' );
            ?>
        </div>
        <?php cd_control_field( "cd[litters][$litter_index][kittens][$kitten_index][description]", $kitten['description'] ?? '', 'Описание', 'textarea' ); ?>
    </div>
    <?php
}

add_filter( 'pre_get_document_title', 'cd_control_document_title' );
function cd_control_document_title( $title ) {
    $seo = cd_control_current_seo();
    $global = cd_control_get( 'seo.global', array() );

    if ( ! empty( $seo['title'] ) ) {
        return $seo['title'] . ' ' . ( $global['separator'] ?? '|' ) . ' ' . ( $global['site_title'] ?? get_bloginfo( 'name' ) );
    }

    return $title;
}

add_action( 'wp_head', 'cd_control_print_seo', 1 );
function cd_control_print_seo() {
    if ( is_admin() ) {
        return;
    }

    $settings = cd_control_get_settings();
    $seo = cd_control_current_seo();
    $description = $seo['description'] ?? '';
    $keywords = $seo['keywords'] ?? '';
    $robots = $settings['seo']['global']['robots'] ?? 'index,follow';
    $og_image = $settings['seo']['global']['og_image'] ?? '';
    $url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
    $title = ! empty( $seo['title'] ) ? $seo['title'] : get_bloginfo( 'name' );
    ?>
    <?php if ( $description ) : ?><meta name="description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>"><?php endif; ?>
    <?php if ( $keywords ) : ?><meta name="keywords" content="<?php echo esc_attr( wp_strip_all_tags( $keywords ) ); ?>"><?php endif; ?>
    <meta name="robots" content="<?php echo esc_attr( $robots ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <?php if ( $description ) : ?><meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>"><?php endif; ?>
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <?php if ( $og_image ) : ?><meta property="og:image" content="<?php echo esc_url( $og_image ); ?>"><?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json"><?php echo wp_json_encode( cd_control_schema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
    <?php
}

function cd_control_current_slug() {
    if ( is_front_page() || is_home() ) {
        return 'home';
    }

    $slug = trim( (string) get_query_var( 'pagename' ), '/' );
    if ( ! $slug && isset( $GLOBALS['wp']->request ) ) {
        $slug = trim( (string) $GLOBALS['wp']->request, '/' );
    }

    return $slug ?: 'home';
}

function cd_control_current_seo() {
    $pages = cd_control_get( 'seo.pages', array() );
    $slug = cd_control_current_slug();

    return $pages[ $slug ] ?? $pages['home'] ?? array();
}

function cd_control_schema() {
    $settings = cd_control_get_settings();

    return array(
        '@context' => 'https://schema.org',
        '@type' => $settings['seo']['global']['schema_type'] ?? 'PetStore',
        'name' => $settings['brand']['name'],
        'url' => home_url( '/' ),
        'email' => $settings['brand']['email'],
        'telephone' => $settings['brand']['phone'],
        'address' => $settings['brand']['address'],
        'image' => $settings['seo']['global']['og_image'],
    );
}

add_action( 'init', 'cd_control_static_routes' );
function cd_control_static_routes() {
    add_rewrite_rule( '^(contacts|blog|reviews)/?$', 'index.php?cd_static_page=$matches[1]', 'top' );

    if ( ! get_option( 'cd_control_rewrites_flushed' ) ) {
        flush_rewrite_rules( false );
        update_option( 'cd_control_rewrites_flushed', 1, false );
    }
}

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'cd_static_page';
    return $vars;
} );

add_filter( 'template_include', 'cd_control_static_template' );
function cd_control_static_template( $template ) {
    $slug = get_query_var( 'cd_static_page' );
    if ( ! $slug ) {
        return $template;
    }

    $candidate = get_stylesheet_directory() . '/page-' . sanitize_file_name( $slug ) . '.php';
    return file_exists( $candidate ) ? $candidate : $template;
}
