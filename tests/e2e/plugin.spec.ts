import { test, expect } from '@wordpress/e2e-test-utils-playwright';

test.describe( 'NExT Hide Private Post Prefix', () => {
	test( 'プラグインが有効化されている', async ( { admin, page } ) => {
		await admin.visitAdminPage( 'plugins.php' );
		const pluginRow = page.locator( 'tr[data-slug="next-hide-private-post-prefix"]' );
		await expect( pluginRow ).toHaveClass( /active/ );
	} );

	test.describe( 'フロントエンド（未ログイン）', () => {
		test.use( { storageState: { cookies: [], origins: [] } } );

		test( 'トップページが表示される', async ( { page, baseURL } ) => {
			await page.goto( baseURL! );
			await expect( page ).toHaveTitle( /.+/ );
		} );
	} );
} );
