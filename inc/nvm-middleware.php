<?php

use PMW\Inc\Vendor\Routes;

/**
 * Config Helper
 */
ConfigHelper::initialize();

/**
 * Finalize Routes
 */
Routes::finalize();

/**
 * Elementor Helper
 */
new ElementorHelper();

/**
 * Shop Extender
 */
MyShopExtender::run();