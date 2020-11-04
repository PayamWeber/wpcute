<?php include_view( 'home.slider' ); ?>
<?php include_view( 'home.ourService' ); ?>
<?php include_view( 'home.about' ); ?>
<?php include_view( 'home.articles' ); ?>
<?php include_view( 'home.customers' ); ?>
<?php if ( pmw_get_main_template() == 'tp1' ): ?>
	<?php include_view( 'home.gallery' ); ?>
<?php else: ?>
	<?php include_view( 'home.gallery' ); ?>
<?php endif; ?>
<?php include_view( 'home.appointment' ); ?>
