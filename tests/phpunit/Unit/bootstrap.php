<?php
/**
 * PHPUnit bootstrap file for Unit tests.
 */

require_once dirname( __DIR__, 2 ) . '/../vendor/autoload.php';

// WordPress 定数を定義してプラグインの早期 exit を防ぐ.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__, 3 ) . '/' );
}

// add_action をスタブしてプラグインファイルを読み込む.
if ( ! function_exists( 'add_action' ) ) {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	function add_action(): void {}
}

require_once dirname( __DIR__, 3 ) . '/next-hide-private-post-prefix.php';
