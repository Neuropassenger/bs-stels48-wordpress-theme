<?php if( is_active_sidebar( 'phone-sidebar' ) ): ?>
    <span class="phone">
        <i class="fas fa-phone"></i>
        <?php dynamic_sidebar( 'phone-sidebar' ) ?>
    </span>
<?php endif; ?>