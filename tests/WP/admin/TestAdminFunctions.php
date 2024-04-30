<?php

namespace AnsPress\Tests\WP;

use Yoast\WPTestUtils\WPIntegration\TestCase;

class TestAdminFunctions extends TestCase {

	use Testcases\Common;

	public function setUp() : void
	{
		parent::setUp();
		$this->markTestIncomplete();
	}

	/**
	 * @covers ::ap_flagged_posts_count
	 */
	public function testAPFlaggedPostsCount() {
		$ids = $this->insert_answers( [], [], 5 );

		// Test begins.
		// Without adding any flag.
		$result = ap_flagged_posts_count();
		$this->assertEquals( 0, $result->publish );
		$this->assertEquals( 0, $result->future );
		$this->assertEquals( 0, $result->draft );
		$this->assertEquals( 0, $result->pending );
		$this->assertEquals( 0, $result->private );
		$this->assertEquals( 0, $result->trash );
		$this->assertEquals( 0, $result->{'auto-draft'} );
		$this->assertEquals( 0, $result->inherit );
		$this->assertEquals( 0, $result->{'request-pending'} );
		$this->assertEquals( 0, $result->{'request-confirmed'} );
		$this->assertEquals( 0, $result->{'request-failed'} );
		$this->assertEquals( 0, $result->{'request-completed'} );
		$this->assertEquals( 0, $result->moderate );
		$this->assertEquals( 0, $result->private_post );
		$this->assertEquals( 0, $result->total );

		// With adding flag.
		// Test 1.
		ap_add_flag( $ids['question'] );
		ap_update_flags_count( $ids['question'] );
		ap_add_flag( $ids['answers'][3] );
		ap_update_flags_count( $ids['answers'][3] );
		ap_add_flag( $ids['answers'][4] );
		ap_update_flags_count( $ids['answers'][4] );
		$result = ap_flagged_posts_count();
		$this->assertEquals( 3, $result->publish );
		$this->assertEquals( 3, $result->total );

		// Test 2.
		$question_id = $this->factory()->post->create( [ 'post_type' => 'question', 'post_status' => 'private' ] );
		ap_add_flag( $question_id );
		ap_update_flags_count( $question_id );
		$result = ap_flagged_posts_count();
		$this->assertEquals( 1, $result->private );
		$this->assertEquals( 4, $result->total );

		// Test 3.
		$question_id = $this->factory()->post->create( [ 'post_type' => 'question', 'post_status' => 'moderate' ] );
		ap_add_flag( $question_id );
		ap_update_flags_count( $question_id );
		$result = ap_flagged_posts_count();
		$this->assertEquals( 1, $result->moderate );
		$this->assertEquals( 5, $result->total );

		// Test 4.
		$question_id = $this->factory()->post->create( [ 'post_type' => 'question', 'post_status' => 'publish' ] );
		ap_add_flag( $question_id );
		ap_update_flags_count( $question_id );
		$result = ap_flagged_posts_count();
		$this->assertEquals( 4, $result->publish );
		$this->assertEquals( 6, $result->total );

		// Test 5.
		$question_id = $this->factory()->post->create( [ 'post_type' => 'question', 'post_status' => 'moderate' ] );
		ap_add_flag( $question_id );
		ap_update_flags_count( $question_id );
		$result = ap_flagged_posts_count();
		$this->assertEquals( 2, $result->moderate );
		$this->assertEquals( 7, $result->total );

		// Test 6.
		$result = ap_flagged_posts_count();
		$this->assertEquals( 4, $result->publish );
		$this->assertEquals( 0, $result->future );
		$this->assertEquals( 0, $result->draft );
		$this->assertEquals( 0, $result->pending );
		$this->assertEquals( 1, $result->private );
		$this->assertEquals( 0, $result->trash );
		$this->assertEquals( 0, $result->{'auto-draft'} );
		$this->assertEquals( 0, $result->inherit );
		$this->assertEquals( 0, $result->{'request-pending'} );
		$this->assertEquals( 0, $result->{'request-confirmed'} );
		$this->assertEquals( 0, $result->{'request-failed'} );
		$this->assertEquals( 0, $result->{'request-completed'} );
		$this->assertEquals( 2, $result->moderate );
		$this->assertEquals( 0, $result->private_post );
		$this->assertEquals( 7, $result->total );
	}

	private function get_base_caps() {
		$ap_roles = new \AP_Roles();
		return $ap_roles->base_caps;
	}

	private function get_mod_caps() {
		$ap_roles = new \AP_Roles();
		return $ap_roles->mod_caps;
	}

	/**
	 * @covers ::ap_update_caps_for_role
	 */
	public function testAPUpdateCapsForRole() {
		// Test 1.
		$result = ap_update_caps_for_role( '' );
		$this->assertFalse( $result );

		// Test 2.
		$result = ap_update_caps_for_role( 'test_role', '' );
		$this->assertFalse( $result );

		// Test 3.
		$test_role = 'test_role';
		add_role( $test_role, 'Test Role' );
		$caps = [
			'ap_read_question' => true,
			'ap_read_answer'   => true,
			'ap_read_comment'  => true,
			'read'             => true,
			'publish_posts'    => true,
			'switch_themes'    => true,
			'manage_options'   => true,
		];
		$result = ap_update_caps_for_role( $test_role, $caps );
		$this->assertNotFalse( $result );
		$this->assertTrue( $result );

		// Additional tests.
		$role = get_role( $test_role );
		$all_caps = $this->get_base_caps() + $this->get_mod_caps();
		foreach ( $all_caps as $cap => $val ) {
			if ( isset( $caps[ $cap ] ) ) {
				$this->assertTrue( $role->has_cap( $cap ) );
			} else {
				$this->assertFalse( $role->has_cap( $cap ) );
			}
		}
	}

	/**
	 * Filter callback for ap_load_admin_assets.
	 */
	public function APLoadAdminAssets( $load ) {
		return true;
	}

	/**
	 * @covers ::ap_load_admin_assets
	 */
	public function testAPLoadAdminAssets() {
		// Test 1.
		set_current_screen( 'question' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 2.
		set_current_screen( 'answer' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 3.
		set_current_screen( 'admin_page_custom_page' );
		$this->assertFalse( ap_load_admin_assets() );

		// Test 4.
		set_current_screen( 'anspress' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 5.
		set_current_screen( 'nav-menus' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 6.
		set_current_screen( 'admin_page_ap_select_question' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 7.
		set_current_screen( 'admin_page_anspress_update' );
		$this->assertTrue( ap_load_admin_assets() );

		// Test 8.
		set_current_screen( 'custom-page' );
		$this->assertFalse( ap_load_admin_assets() );
		add_filter( 'ap_load_admin_assets', [ $this, 'APLoadAdminAssets' ] );
		$this->assertTrue( ap_load_admin_assets() );
		remove_filter( 'ap_load_admin_assets', [ $this, 'APLoadAdminAssets' ] );

		// Test 9.
		set_current_screen( 'front' );
		$this->assertFalse( ap_load_admin_assets() );
		add_filter( 'ap_load_admin_assets', [ $this, 'APLoadAdminAssets' ] );
		$this->assertTrue( ap_load_admin_assets() );
		remove_filter( 'ap_load_admin_assets', [ $this, 'APLoadAdminAssets' ] );

		// Test 10.
		set_current_screen( 'dashboard' );
		$this->assertFalse( ap_load_admin_assets() );
	}
}
