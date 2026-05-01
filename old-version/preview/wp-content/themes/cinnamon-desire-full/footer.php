<footer class="cd-footer">
    <div class="footer-inner">
        <div class="footer-col col-main">
            <div class="footer-logo"><?php echo esc_html( cinnamon_setting( 'brand.name', 'CINNAMON DESIRE' ) ); ?></div>
            <div class="footer-tagline"><?php echo esc_html( cinnamon_setting( 'brand.tagline', 'ПИТОМНИК ШОТЛАНДСКИХ КОШЕК' ) ); ?></div>
            <p class="footer-about"><?php echo esc_html( cinnamon_setting( 'brand.footer_about', 'Питомник с более чем 10-летней историей. Мы выращиваем кошек с любовью и уважением к их природе.' ) ); ?></p>
            
            <div class="footer-socials">
                <a href="<?php echo esc_url( cinnamon_setting( 'brand.vk', '#' ) ); ?>" class="social-btn">VK</a>
                <a href="<?php echo esc_url( cinnamon_setting( 'brand.telegram', '#' ) ); ?>" class="social-btn">TG</a>
                <a href="<?php echo esc_url( cinnamon_setting( 'brand.whatsapp', '#' ) ); ?>" class="social-btn">WA</a>
            </div>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">РАЗДЕЛЫ</h4>
            <ul class="footer-links">
                <li><a href="<?php echo home_url(); ?>">Наши котята</a></li>
                <li><a href="<?php echo site_url('/reviews'); ?>">Отзывы</a></li>
                <li><a href="<?php echo site_url('/blog'); ?>">Блог</a></li>
                <li><a href="<?php echo site_url('/about-us'); ?>">О нас</a></li>
                <li><a href="<?php echo site_url('/contacts'); ?>" class="active-link">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОДДЕРЖКА</h4>
            <ul class="footer-links">
                <li><a href="<?php echo site_url('/adoption'); ?>">Усыновление</a></li>
                <li><a href="<?php echo site_url('/faq'); ?>">Вопросы</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОРОДА</h4>
            <ul class="footer-links">
                <li><a href="#">Scottish Fold</a></li>
                <li><a href="#">Scottish Straight</a></li>
                <li><a href="#">WCF Certified</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright-text">© <?php echo date('Y'); ?> CINNAMON DESIRE CATTERY. ALL RIGHTS RESERVED.</div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
