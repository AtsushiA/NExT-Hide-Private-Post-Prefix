<?php
/**
 * Unit tests for NExT Hide Private Post Prefix.
 *
 * WordPress をロードせず関数の定義確認のみ行う.
 */

use Yoast\WPTestUtils\BrainMonkey\TestCase;

class NhppUnitTest extends TestCase {

	public function test_main_function_is_defined(): void {
		$this->assertTrue( function_exists( 'nhpp_exclude_private_posts_from_loop' ) );
	}
}
