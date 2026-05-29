<?php
/**
 * Integration tests for NExT Hide Private Post Prefix.
 */

class NhppIntegrationTest extends WP_UnitTestCase {

	public function test_hook_is_registered(): void {
		$this->assertEquals(
			10,
			has_action( 'pre_get_posts', 'nhpp_exclude_private_posts_from_loop' )
		);
	}

	public function test_private_post_excluded_for_logged_in_user(): void {
		// 管理者ユーザーでログイン
		$user_id = self::factory()->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );

		// プライベート投稿を作成
		$private_id = self::factory()->post->create(
			array( 'post_status' => 'private' )
		);
		// 公開投稿を作成
		$public_id = self::factory()->post->create(
			array( 'post_status' => 'publish' )
		);

		// フロントエンドのメインループを模倣したクエリを実行
		$query = new WP_Query(
			array(
				'post_type'      => 'post',
				'posts_per_page' => -1,
				'is_singular'    => false,
			)
		);

		$post_ids = wp_list_pluck( $query->posts, 'ID' );

		$this->assertNotContains( $private_id, $post_ids, 'ログインユーザーにも非公開記事が表示されてはいけない' );
		$this->assertContains( $public_id, $post_ids, '公開記事は表示されるべき' );
	}
}
