<?php

namespace Anspress\Tests;

use Yoast\WPTestUtils\WPIntegration\TestCase;

// Since this file is required only on admin pages so,
// we include it directly for testing.
require_once ANSPRESS_DIR . 'admin/anspress-admin.php';

class TestAnsPressAdmin extends TestCase {

	use Testcases\Common;

	/**
	 * @covers AnsPress_Admin::instance
	 */
	public function testInstance() {
		$class = new \ReflectionClass( 'AnsPress_Admin' );
		$this->assertTrue( $class->hasProperty( 'instance' ) && $class->getProperty( 'instance' )->isStatic() );
	}

	public function testClassProperties() {
		$class = new \ReflectionClass( 'AnsPress_Admin' );
		$this->assertTrue( $class->hasProperty( 'plugin_screen_hook_suffix' ) && $class->getProperty( 'plugin_screen_hook_suffix' )->isProtected() );
	}

	public function testMethodExists() {
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'init' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'includes' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'enqueue_admin_styles' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'enqueue_admin_scripts' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'menu_counts' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'add_plugin_admin_menu' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'fix_active_admin_menu' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'get_free_menu_position' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'tax_menu_correction' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'display_plugin_options_page' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'dashboard_page' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'display_select_question' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'add_action_links' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'init_actions' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'question_meta_box_class' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'save_user_roles_fields' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'change_post_menu_label' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'ans_parent_post' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'trashed_post' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'post_data_check' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'custom_post_location' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'ap_menu_metaboxes' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'render_menu' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'serach_qa_by_userid' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'filter_comments_query' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'join_by_author_name' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'get_pages' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'modify_answer_title' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'append_post_status_list' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'anspress_notice' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'check_pages_exists' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'update_db' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'anspress_create_base_page' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'register_options' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_general_pages' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_general_permalinks' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_general_layout' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_uac_reading' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_uac_posting' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_uac_other' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_postscomments' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'options_user_activity' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'page_select_field_opt' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'ap_addon_options' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'save_addon_options' ) );
		$this->assertTrue( method_exists( 'AnsPress_Admin', 'admin_footer' ) );
	}

	/**
	 * @covers AnsPress_Admin::admin_footer
	 */
	public function testAdminFooter() {
		ob_start();
		\AnsPress_Admin::admin_footer();
		$output = ob_get_clean();
		$this->assertStringContainsString( '#adminmenu .anspress-license-count', $output );
		$this->assertStringContainsString( 'background: #0073aa;', $output );
	}

	/**
	 * @covers AnsPress_Admin::register_options
	 */
	public function testRegisterOptions() {
		\AnsPress_Admin::register_options();

		// Test begins.
		$this->assertEquals( 10, has_filter( 'ap_form_options_general_pages', [ 'AnsPress_Admin', 'options_general_pages' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_general_permalinks', [ 'AnsPress_Admin', 'options_general_permalinks' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_general_layout', [ 'AnsPress_Admin', 'options_general_layout' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_postscomments', [ 'AnsPress_Admin', 'options_postscomments' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_uac_reading', [ 'AnsPress_Admin', 'options_uac_reading' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_uac_posting', [ 'AnsPress_Admin', 'options_uac_posting' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_uac_other', [ 'AnsPress_Admin', 'options_uac_other' ] ) );
		$this->assertEquals( 10, has_filter( 'ap_form_options_user_activity', [ 'AnsPress_Admin', 'options_user_activity' ] ) );
	}

	/**
	 * @covers AnsPress_Admin::includes
	 */
	public function testIncludes() {
		// Test before the method is called.
		$this->assertFalse( function_exists( 'ap_flagged_posts_count' ) );
		$this->assertFalse( function_exists( 'ap_update_caps_for_role' ) );
		$this->assertFalse( function_exists( 'ap_load_admin_assets' ) );

		// Test after the method is called.
		\AnsPress_Admin::includes();
		$this->assertTrue( function_exists( 'ap_flagged_posts_count' ) );
		$this->assertTrue( function_exists( 'ap_update_caps_for_role' ) );
		$this->assertTrue( function_exists( 'ap_load_admin_assets' ) );
		$this->assertTrue( class_exists( 'AP_license' ) );
		$this->assertInstanceOf('AP_license', new \AP_license() );
	}

	/**
	 * @covers AnsPress_Admin::add_action_links
	 */
	public function testAddActionLinks() {
		$links = \AnsPress_Admin::init();

		$links = \AnsPress_Admin::add_action_links( [] );
		$this->assertArrayHasKey( 'settings', $links );
		$this->assertStringContainsString( admin_url( 'admin.php?page=anspress_options' ), $links['settings'] );
		$this->assertStringContainsString( 'Settings', $links['settings'] );
		$this->assertEquals( '<a href="' . admin_url( 'admin.php?page=anspress_options' ) . '">Settings</a>', $links['settings'] );
	}

	/**
	 * @covers AnsPress_Admin::question_meta_box_class
	 */
	public function testQuestionMetaBoxClass() {
		// Test before the method is called.
		$this->assertFalse( class_exists( 'AP_Question_Meta_Box' ) );

		// Test after the method is called.
		\AnsPress_Admin::question_meta_box_class();
		$this->assertTrue( class_exists( 'AP_Question_Meta_Box' ) );
		$this->assertInstanceOf( 'AP_Question_Meta_Box', new \AP_Question_Meta_Box() );
	}

	/**
	 * @covers AnsPress_Admin::anspress_notice
	 */
	public function testAnsPressNotice() {
		// Test for displaying notice.
		// For db version.
		update_option( 'anspress_db_version', 0 );
		ob_start();
		\AnsPress_Admin::anspress_notice();
		$output = ob_get_clean();
		$this->assertStringContainsString( '<div class="ap-notice notice notice-error apicon-anspress-icon">', $output );
		$this->assertStringContainsString( 'AnsPress database is not updated.', $output );
		$this->assertStringContainsString( '<a class="button" href="' . admin_url( 'admin-post.php?action=anspress_update_db' ) . '">Update now</a>', $output );

		// For missing pages.
		$this->assertStringContainsString( '<div class="ap-notice notice notice-error apicon-anspress-icon">', $output );
		$this->assertStringContainsString( 'One or more AnsPress page(s) does not exists.', $output );
		$this->assertStringContainsString( '<a href="' . admin_url( 'admin-post.php?action=anspress_create_base_page' ) . '">Set automatically</a> Or <a href="' . admin_url( 'admin.php?page=anspress_options' ) . '">Set set by yourself</a>', $output );

		// Test for not displaying notice.
		// Generate required pages.
		$this->setRole( 'administrator' );
		ap_create_base_page();
		flush_rewrite_rules();
		delete_transient( 'ap_pages_check' );

		// For db version.
		update_option( 'anspress_db_version', AP_DB_VERSION );
		ob_start();
		\AnsPress_Admin::anspress_notice();
		$output = ob_get_clean();
		$this->assertStringNotContainsString( '<div class="ap-notice notice notice-error apicon-anspress-icon">', $output );
		$this->assertStringNotContainsString( 'AnsPress database is not updated.', $output );
		$this->assertStringNotContainsString( '<a class="button" href="' . admin_url( 'admin-post.php?action=anspress_update_db' ) . '">Update now</a>', $output );

		// For missing pages.
		$this->assertStringNotContainsString( '<div class="ap-notice notice notice-error apicon-anspress-icon">', $output );
		$this->assertStringNotContainsString( 'One or more AnsPress page(s) does not exists.', $output );
		$this->assertStringNotContainsString( '<a href="' . admin_url( 'admin-post.php?action=anspress_create_base_page' ) . '">Set automatically</a> Or <a href="' . admin_url( 'admin.php?page=anspress_options' ) . '">Set set by yourself</a>', $output );
		$this->logout();
	}

	/**
	 * @covers AnsPress_Admin::modify_answer_title
	 */
	public function testModifyAnswerTitle() {
		$question_id = $this->factory->post->create(
			[
				'post_type'    => 'question',
				'post_title'   => 'Question title',
				'post_content' => 'Question content'
			]
		);
		$answer_id = $this->factory->post->create(
			[
				'post_type'    => 'answer',
				'post_title'   => 'Answer title',
				'post_content' => 'Answer content',
				'post_parent'  => $question_id
			]
		);
		$post_id = $this->factory->post->create(
			[
				'post_type'    => 'post',
				'post_title'   => 'Post title',
				'post_content' => 'Post content'
			]
		);
		$page_id = $this->factory->post->create(
			[
				'post_type'    => 'page',
				'post_title'   => 'Page title',
				'post_content' => 'Page content'
			]
		);

		// Test begins.
		// Test for post post type.
		$result = \AnsPress_Admin::modify_answer_title( (array) get_post( $post_id ) );
		$this->assertEquals( 'Post title', $result['post_title'] );

		// Test for page post type.
		$result = \AnsPress_Admin::modify_answer_title( (array) get_post( $page_id ) );
		$this->assertEquals( 'Page title', $result['post_title'] );

		// Test for question post type.
		$result = \AnsPress_Admin::modify_answer_title( (array) get_post( $question_id ) );
		$this->assertEquals( 'Question title', $result['post_title'] );

		// Test for answer post type.
		$result = \AnsPress_Admin::modify_answer_title( (array) get_post( $answer_id ) );
		$this->assertEquals( 'Question title', $result['post_title'] );
	}

	/**
	 * @covers AnsPress_Admin::save_user_roles_fields
	 */
	public function testSaveUserRolesFields() {
		// Test 1.
		$user_id = $this->factory->user->create();
		$_REQUEST['ap_role'] = 'administrator';
		\AnsPress_Admin::save_user_roles_fields( $user_id );
		$saved_role = get_user_meta( $user_id, 'ap_role', true );
		$this->assertEquals( ap_sanitize_unslash( 'ap_role', 'p' ), $saved_role );

		// Test 2.
		$user_id = $this->factory->user->create();
		$_REQUEST['ap_role'] = [ 'moderator', 'editor' ];
		\AnsPress_Admin::save_user_roles_fields( $user_id );
		$saved_role = get_user_meta( $user_id, 'ap_role', true );
		$this->assertEquals( ap_sanitize_unslash( 'ap_role', 'p' ), $saved_role );

		// Reset $_REQUEST.
		unset( $_REQUEST['ap_role'] );
	}

	/**
	 * @covers AnsPress_Admin::custom_post_location
	 */
	public function testCustomPostLocation() {
		$initial_location = 'http://example.com/sample-post/';
		$updated_location = \AnsPress_Admin::custom_post_location( $initial_location );

		// Test begins.
		$this->assertStringNotContainsString( 'message=99', $initial_location );
		$this->assertStringContainsString( 'message=99', $updated_location );
		$this->assertEquals( $initial_location . '?message=99', $updated_location );
	}

	/**
	 * @covers AnsPress_Admin::change_post_menu_label
	 */
	public function testChangePostMenuLabel() {
		// Test before the method is called.
		global $submenu;
		$submenu['anspress'][0][0] = 'Old Menu';
		$this->assertEquals( 'Old Menu', $submenu['anspress'][0][0] );

		// Test after the method is called.
		\AnsPress_Admin::change_post_menu_label();
		$this->assertEquals( 'AnsPress', $submenu['anspress'][0][0] );
	}

	/**
	 * @covers AnsPress_Admin::options_general_pages
	 */
	public function testOptionsGeneralPages() {
		$form = \AnsPress_Admin::options_general_pages();

		// Test starts.
		$this->assertArrayHasKey( 'submit_label', $form );
		$this->assertEquals( 'Save Pages', $form['submit_label'] );
		$this->assertArrayHasKey( 'fields', $form );

		// Test for author_credits field.
		$this->assertArrayHasKey( 'author_credits', $form['fields'] );
		$this->assertEquals( 'Hide author credits', $form['fields']['author_credits']['label'] );
		$this->assertEquals( 'Hide link to AnsPress project site.', $form['fields']['author_credits']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['author_credits']['type'] );
		$this->assertEquals( 0, $form['fields']['author_credits']['order'] );
		$this->assertEquals( ap_opt( 'author_credits' ), $form['fields']['author_credits']['value'] );

		// Test for sep-warning field.
		$this->assertArrayHasKey( 'sep-warning', $form['fields'] );
		$this->assertEquals( '<div class="ap-uninstall-warning">If you have created main pages manually then make sure to have [anspress] shortcode in all pages.</div>', $form['fields']['sep-warning']['html'] );

		// For pages field.
		foreach ( ap_main_pages() as $slug => $args ) {
			$this->assertArrayHasKey( $slug, $form['fields'] );
			$this->assertEquals( $args['label'], $form['fields'][ $slug ]['label'] );
			$this->assertEquals( $args['desc'], $form['fields'][ $slug ]['desc'] );
			$this->assertEquals( 'select', $form['fields'][ $slug ]['type'] );
			$this->assertEquals( 'posts', $form['fields'][ $slug ]['options'] );
			$this->assertArrayHasKey( 'post_type', $form['fields'][ $slug ]['posts_args'] );
			$this->assertArrayHasKey( 'showposts', $form['fields'][ $slug ]['posts_args'] );
			$this->assertEquals( [ 'post_type' => 'page', 'showposts' => -1 ], $form['fields'][ $slug ]['posts_args'] );
			$this->assertEquals( ap_opt( $slug ), $form['fields'][ $slug ]['value'] );
			$this->assertEquals( 'absint', $form['fields'][ $slug ]['sanitize'] );
		}
	}

	/**
	 * @covers AnsPress_Admin::options_general_permalinks
	 */
	public function testOptionsGeneralPermalinks() {
		$form = \AnsPress_Admin::options_general_permalinks();

		// Test starts.
		$this->assertArrayHasKey( 'submit_label', $form );
		$this->assertEquals( 'Save Permalinks', $form['submit_label'] );
		$this->assertArrayHasKey( 'fields', $form );

		// Test for question_page_slug field.
		$this->assertArrayHasKey( 'question_page_slug', $form['fields'] );
		$this->assertEquals( 'Question slug', $form['fields']['question_page_slug']['label'] );
		$this->assertEquals( 'Slug for single question page.', $form['fields']['question_page_slug']['desc'] );
		$this->assertEquals( ap_opt( 'question_page_slug' ), $form['fields']['question_page_slug']['value'] );
		$this->assertEquals( 'required', $form['fields']['question_page_slug']['validate'] );

		// Test for question_page_permalink field.
		$this->assertArrayHasKey( 'question_page_permalink', $form['fields'] );
		$this->assertEquals( 'Question permalink', $form['fields']['question_page_permalink']['label'] );
		$this->assertEquals( 'Select single question permalink structure.', $form['fields']['question_page_permalink']['desc'] );
		$this->assertEquals( 'radio', $form['fields']['question_page_permalink']['type'] );
		$options_args = [
			'question_perma_1' => home_url( '/' . ap_base_page_slug() ) . '/<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/question-name/',
			'question_perma_2' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/question-name/',
			'question_perma_3' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/213/',
			'question_perma_4' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/213/question-name/',
			'question_perma_5' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/question-name/213/',
			'question_perma_6' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/213-question-name/',
			'question_perma_7' => home_url( '/' ) . '<b class="ap-base-slug">' . ap_opt( 'question_page_slug' ) . '</b>/question-name-213/',
		];
		$this->assertEquals( $options_args, $form['fields']['question_page_permalink']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['question_page_permalink']['options'] );
			$this->assertEquals( $value, $form['fields']['question_page_permalink']['options'][ $key ] );
		}
		$this->assertEquals( ap_opt( 'question_page_permalink' ), $form['fields']['question_page_permalink']['value'] );
		$this->assertEquals( 'required', $form['fields']['question_page_permalink']['validate'] );

		// Test for base_page_title field.
		$this->assertArrayHasKey( 'base_page_title', $form['fields'] );
		$this->assertEquals( 'Base page title', $form['fields']['base_page_title']['label'] );
		$this->assertEquals( 'Main questions list page title', $form['fields']['base_page_title']['desc'] );
		$this->assertEquals( ap_opt( 'base_page_title' ), $form['fields']['base_page_title']['value'] );
		$this->assertEquals( 'required', $form['fields']['base_page_title']['validate'] );

		// Test for search_page_title field.
		$this->assertArrayHasKey( 'search_page_title', $form['fields'] );
		$this->assertEquals( 'Search page title', $form['fields']['search_page_title']['label'] );
		$this->assertEquals( 'Title of the search page', $form['fields']['search_page_title']['desc'] );
		$this->assertEquals( ap_opt( 'search_page_title' ), $form['fields']['search_page_title']['value'] );
		$this->assertEquals( 'required', $form['fields']['search_page_title']['validate'] );

		// Test for author_page_title field.
		$this->assertArrayHasKey( 'author_page_title', $form['fields'] );
		$this->assertEquals( 'Author page title', $form['fields']['author_page_title']['label'] );
		$this->assertEquals( 'Title of the author page', $form['fields']['author_page_title']['desc'] );
		$this->assertEquals( ap_opt( 'author_page_title' ) ?? 'User', $form['fields']['author_page_title']['value'] );
		$this->assertEquals( 'required', $form['fields']['author_page_title']['validate'] );
	}

	/**
	 * @covers AnsPress_Admin::options_general_layout
	 */
	public function testoptions_general_layout() {
		$form = \AnsPress_Admin::options_general_layout();

		// Test starts.
		$this->assertArrayHasKey( 'fields', $form );

		// Test for load_assets_in_anspress_only field.
		$this->assertArrayHasKey( 'load_assets_in_anspress_only', $form['fields'] );
		$this->assertEquals( '', $form['fields']['load_assets_in_anspress_only']['name'] );
		$this->assertEquals( 'Load assets in AnsPress page only?', $form['fields']['load_assets_in_anspress_only']['label'] );
		$this->assertEquals( 'Check this to load AnsPress JS and CSS on the AnsPress page only. Be careful, this might break layout.', $form['fields']['load_assets_in_anspress_only']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['load_assets_in_anspress_only']['type'] );
		$this->assertEquals( ap_opt( 'load_assets_in_anspress_only' ), $form['fields']['load_assets_in_anspress_only']['value'] );

		// Test for avatar_size_list field.
		$this->assertArrayHasKey( 'avatar_size_list', $form['fields'] );
		$this->assertEquals( 'List avatar size', $form['fields']['avatar_size_list']['label'] );
		$this->assertEquals( 'User avatar size for questions list.', $form['fields']['avatar_size_list']['desc'] );
		$this->assertEquals( 'number', $form['fields']['avatar_size_list']['subtype'] );
		$this->assertEquals( ap_opt( 'avatar_size_list' ), $form['fields']['avatar_size_list']['value'] );

		// Test for avatar_size_qquestion field.
		$this->assertArrayHasKey( 'avatar_size_qquestion', $form['fields'] );
		$this->assertEquals( 'Question avatar size', $form['fields']['avatar_size_qquestion']['label'] );
		$this->assertEquals( 'User avatar size for question.', $form['fields']['avatar_size_qquestion']['desc'] );
		$this->assertEquals( 'number', $form['fields']['avatar_size_qquestion']['subtype'] );
		$this->assertEquals( ap_opt( 'avatar_size_qquestion' ), $form['fields']['avatar_size_qquestion']['value'] );

		// Test for avatar_size_qanswer field.
		$this->assertArrayHasKey( 'avatar_size_qanswer', $form['fields'] );
		$this->assertEquals( 'Answer avatar size', $form['fields']['avatar_size_qanswer']['label'] );
		$this->assertEquals( 'User avatar size for answer.', $form['fields']['avatar_size_qanswer']['desc'] );
		$this->assertEquals( 'number', $form['fields']['avatar_size_qanswer']['subtype'] );
		$this->assertEquals( ap_opt( 'avatar_size_qanswer' ), $form['fields']['avatar_size_qanswer']['value'] );

		// Test for avatar_size_qcomment field.
		$this->assertArrayHasKey( 'avatar_size_qcomment', $form['fields'] );
		$this->assertEquals( 'Comment avatar size', $form['fields']['avatar_size_qcomment']['label'] );
		$this->assertEquals( 'User avatar size for comments.', $form['fields']['avatar_size_qcomment']['desc'] );
		$this->assertEquals( 'number', $form['fields']['avatar_size_qcomment']['subtype'] );
		$this->assertEquals( ap_opt( 'avatar_size_qcomment' ), $form['fields']['avatar_size_qcomment']['value'] );

		// Test for question_per_page field.
		$this->assertArrayHasKey( 'question_per_page', $form['fields'] );
		$this->assertEquals( 'Questions per page', $form['fields']['question_per_page']['label'] );
		$this->assertEquals( 'Questions to show per page.', $form['fields']['question_per_page']['desc'] );
		$this->assertEquals( 'number', $form['fields']['question_per_page']['subtype'] );
		$this->assertEquals( ap_opt( 'question_per_page' ), $form['fields']['question_per_page']['value'] );

		// Test for answers_per_page field.
		$this->assertArrayHasKey( 'answers_per_page', $form['fields'] );
		$this->assertEquals( 'Answers per page', $form['fields']['answers_per_page']['label'] );
		$this->assertEquals( 'Answers to show per page.', $form['fields']['answers_per_page']['desc'] );
		$this->assertEquals( 'number', $form['fields']['answers_per_page']['subtype'] );
		$this->assertEquals( ap_opt( 'answers_per_page' ), $form['fields']['answers_per_page']['value'] );
	}

	/**
	 * @covers AnsPress_Admin::options_uac_reading
	 */
	public function testOptionsUACReading() {
		$form = \AnsPress_Admin::options_uac_reading();

		// Test starts.
		$this->assertArrayHasKey( 'fields', $form );

		// Test for read_question_per field.
		$this->assertArrayHasKey( 'read_question_per', $form['fields'] );
		$this->assertEquals( 'Who can read question?', $form['fields']['read_question_per']['label'] );
		$this->assertEquals( 'Set who can view or read a question.', $form['fields']['read_question_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['read_question_per']['type'] );
		$this->assertEquals( ap_opt( 'read_question_per' ), $form['fields']['read_question_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_read_question capability',
		];
		$this->assertEquals( $options_args, $form['fields']['read_question_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['read_question_per']['options'] );
			$this->assertEquals( $value, $form['fields']['read_question_per']['options'][ $key ] );
		}

		// Test for read_answer_per field.
		$this->assertArrayHasKey( 'read_answer_per', $form['fields'] );
		$this->assertEquals( 'Who can read answers?', $form['fields']['read_answer_per']['label'] );
		$this->assertEquals( 'Set who can view or read a answer.', $form['fields']['read_answer_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['read_answer_per']['type'] );
		$this->assertEquals( ap_opt( 'read_answer_per' ), $form['fields']['read_answer_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_read_answer capability',
		];
		$this->assertEquals( $options_args, $form['fields']['read_answer_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['read_answer_per']['options'] );
			$this->assertEquals( $value, $form['fields']['read_answer_per']['options'][ $key ] );
		}

		// Test for read_comment_per field.
		$this->assertArrayHasKey( 'read_comment_per', $form['fields'] );
		$this->assertEquals( 'Who can read comment?', $form['fields']['read_comment_per']['label'] );
		$this->assertEquals( 'Set who can view or read a comment.', $form['fields']['read_comment_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['read_comment_per']['type'] );
		$this->assertEquals( ap_opt( 'read_comment_per' ), $form['fields']['read_comment_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_read_comment capability',
		];
		$this->assertEquals( $options_args, $form['fields']['read_comment_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['read_comment_per']['options'] );
			$this->assertEquals( $value, $form['fields']['read_comment_per']['options'][ $key ] );
		}
	}

	/**
	 * @covers AnsPress_Admin::options_uac_posting
	 */
	public function testOptionsUACPosting() {
		$form = \AnsPress_Admin::options_uac_posting();

		// Test starts.
		$this->assertArrayHasKey( 'fields', $form );

		// Test for post_question_per field.
		$this->assertArrayHasKey( 'post_question_per', $form['fields'] );
		$this->assertEquals( 'Who can post question?', $form['fields']['post_question_per']['label'] );
		$this->assertEquals( 'Set who can submit a question from frontend.', $form['fields']['post_question_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['post_question_per']['type'] );
		$this->assertEquals( ap_opt( 'post_question_per' ), $form['fields']['post_question_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_new_question capability',
		];
		$this->assertEquals( $options_args, $form['fields']['post_question_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['post_question_per']['options'] );
			$this->assertEquals( $value, $form['fields']['post_question_per']['options'][ $key ] );
		}

		// Test for post_answer_per field.
		$this->assertArrayHasKey( 'post_answer_per', $form['fields'] );
		$this->assertEquals( 'Who can post answer?', $form['fields']['post_answer_per']['label'] );
		$this->assertEquals( 'Set who can submit an answer from frontend.', $form['fields']['post_answer_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['post_answer_per']['type'] );
		$this->assertEquals( ap_opt( 'post_answer_per' ), $form['fields']['post_answer_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_new_answer capability',
		];
		$this->assertEquals( $options_args, $form['fields']['post_answer_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['post_answer_per']['options'] );
			$this->assertEquals( $value, $form['fields']['post_answer_per']['options'][ $key ] );
		}

		// Test for create_account field.
		$this->assertArrayHasKey( 'create_account', $form['fields'] );
		$this->assertEquals( 'Create account for non-registered', $form['fields']['create_account']['label'] );
		$this->assertEquals( 'Allow non-registered users to create account by entering their email in question. After submitting post a confirmation email will be sent to the user.', $form['fields']['create_account']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['create_account']['type'] );
		$this->assertEquals( ap_opt( 'create_account' ), $form['fields']['create_account']['value'] );

		// Test for multiple_answers field.
		$this->assertArrayHasKey( 'multiple_answers', $form['fields'] );
		$this->assertEquals( 'Multiple answers', $form['fields']['multiple_answers']['label'] );
		$this->assertEquals( 'Allow users to submit multiple answer per question.', $form['fields']['multiple_answers']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['multiple_answers']['type'] );
		$this->assertEquals( ap_opt( 'multiple_answers' ), $form['fields']['multiple_answers']['value'] );

		// Test for disallow_op_to_answer field.
		$this->assertArrayHasKey( 'disallow_op_to_answer', $form['fields'] );
		$this->assertEquals( 'OP can answer?', $form['fields']['disallow_op_to_answer']['label'] );
		$this->assertEquals( 'OP: Original poster/asker. Enabling this option will prevent users to post an answer on their question.', $form['fields']['disallow_op_to_answer']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['disallow_op_to_answer']['type'] );
		$this->assertEquals( ap_opt( 'disallow_op_to_answer' ), $form['fields']['disallow_op_to_answer']['value'] );

		// Test for post_comment_per field.
		$this->assertArrayHasKey( 'post_comment_per', $form['fields'] );
		$this->assertEquals( 'Who can post comment?', $form['fields']['post_comment_per']['label'] );
		$this->assertEquals( 'Set who can submit a comment from frontend.', $form['fields']['post_comment_per']['desc'] );
		$this->assertEquals( 'select', $form['fields']['post_comment_per']['type'] );
		$this->assertEquals( ap_opt( 'post_comment_per' ), $form['fields']['post_comment_per']['value'] );
		$options_args = [
			'anyone'    => 'Anyone, including non-loggedin',
			'logged_in' => 'Only logged in',
			'have_cap'  => 'Only user having ap_new_comment capability',
		];
		$this->assertEquals( $options_args, $form['fields']['post_comment_per']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['post_comment_per']['options'] );
			$this->assertEquals( $value, $form['fields']['post_comment_per']['options'][ $key ] );
		}

		// Test for new_question_status field.
		$this->assertArrayHasKey( 'new_question_status', $form['fields'] );
		$this->assertEquals( 'Status of new question', $form['fields']['new_question_status']['label'] );
		$this->assertEquals( 'Default status of new question.', $form['fields']['new_question_status']['desc'] );
		$this->assertEquals( 'select', $form['fields']['new_question_status']['type'] );
		$options_args = [
			'publish'  => 'Publish',
			'moderate' => 'Moderate',
		];
		$this->assertEquals( $options_args, $form['fields']['new_question_status']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['new_question_status']['options'] );
			$this->assertEquals( $value, $form['fields']['new_question_status']['options'][ $key ] );
		}
		$this->assertEquals( ap_opt( 'new_question_status' ), $form['fields']['new_question_status']['value'] );

		// Test for edit_question_status field.
		$this->assertArrayHasKey( 'edit_question_status', $form['fields'] );
		$this->assertEquals( 'Status of edited question', $form['fields']['edit_question_status']['label'] );
		$this->assertEquals( 'Default status of edited question.', $form['fields']['edit_question_status']['desc'] );
		$this->assertEquals( 'select', $form['fields']['edit_question_status']['type'] );
		$options_args = [
			'publish'  => 'Publish',
			'moderate' => 'Moderate',
		];
		$this->assertEquals( $options_args, $form['fields']['edit_question_status']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['edit_question_status']['options'] );
			$this->assertEquals( $value, $form['fields']['edit_question_status']['options'][ $key ] );
		}

		// Test for new_answer_status field.
		$this->assertArrayHasKey( 'new_answer_status', $form['fields'] );
		$this->assertEquals( 'Status of new answer', $form['fields']['new_answer_status']['label'] );
		$this->assertEquals( 'Default status of new answer.', $form['fields']['new_answer_status']['desc'] );
		$this->assertEquals( 'select', $form['fields']['new_answer_status']['type'] );
		$options_args = [
			'publish'  => 'Publish',
			'moderate' => 'Moderate',
		];
		$this->assertEquals( $options_args, $form['fields']['new_answer_status']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['new_answer_status']['options'] );
			$this->assertEquals( $value, $form['fields']['new_answer_status']['options'][ $key ] );
		}
		$this->assertEquals( ap_opt( 'new_answer_status' ), $form['fields']['new_answer_status']['value'] );

		// Test for edit_answer_status field.
		$this->assertArrayHasKey( 'edit_answer_status', $form['fields'] );
		$this->assertEquals( 'Status of edited answer', $form['fields']['edit_answer_status']['label'] );
		$this->assertEquals( 'Default status of edited answer.', $form['fields']['edit_answer_status']['desc'] );
		$this->assertEquals( 'select', $form['fields']['edit_answer_status']['type'] );
		$options_args = [
			'publish'  => 'Publish',
			'moderate' => 'Moderate',
		];
		$this->assertEquals( $options_args, $form['fields']['edit_answer_status']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['edit_answer_status']['options'] );
			$this->assertEquals( $value, $form['fields']['edit_answer_status']['options'][ $key ] );
		}
		$this->assertEquals( ap_opt( 'edit_answer_status' ), $form['fields']['edit_answer_status']['value'] );

		// Test for anonymous_post_status field.
		$this->assertArrayHasKey( 'anonymous_post_status', $form['fields'] );
		$this->assertEquals( 'Status of non-loggedin post', $form['fields']['anonymous_post_status']['label'] );
		$this->assertEquals( 'Default status of question or answer submitted by non-loggedin user.', $form['fields']['anonymous_post_status']['desc'] );
		$this->assertEquals( 'select', $form['fields']['anonymous_post_status']['type'] );
		$options_args = [
			'publish'  => 'Publish',
			'moderate' => 'Moderate',
		];
		$this->assertEquals( $options_args, $form['fields']['anonymous_post_status']['options'] );
		foreach ( $options_args as $key => $value ) {
			$this->assertArrayHasKey( $key, $form['fields']['anonymous_post_status']['options'] );
			$this->assertEquals( $value, $form['fields']['anonymous_post_status']['options'][ $key ] );
		}
		$this->assertEquals( ap_opt( 'anonymous_post_status' ), $form['fields']['anonymous_post_status']['value'] );
	}

	/**
	 * @covers AnsPress_Admin::options_uac_other
	 */
	public function testOptionsUACOther() {
		$form = \AnsPress_Admin::options_uac_other();

		// Test starts.
		$this->assertArrayHasKey( 'fields', $form );

		// Test for allow_upload field.
		$this->assertArrayHasKey( 'allow_upload', $form['fields'] );
		$this->assertEquals( 'Allow image upload', $form['fields']['allow_upload']['label'] );
		$this->assertEquals( 'Allow logged-in users to upload image.', $form['fields']['allow_upload']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['allow_upload']['type'] );
		$this->assertEquals( ap_opt( 'allow_upload' ), $form['fields']['allow_upload']['value'] );

		// Test for uploads_per_post field.
		$this->assertArrayHasKey( 'uploads_per_post', $form['fields'] );
		$this->assertEquals( 'Max uploads per post', $form['fields']['uploads_per_post']['label'] );
		$this->assertEquals( 'Set numbers of media user can upload for each post.', $form['fields']['uploads_per_post']['desc'] );
		$this->assertEquals( ap_opt( 'uploads_per_post' ), $form['fields']['uploads_per_post']['value'] );

		// Test for max_upload_size field.
		$this->assertArrayHasKey( 'max_upload_size', $form['fields'] );
		$this->assertEquals( 'Max upload size', $form['fields']['max_upload_size']['label'] );
		$this->assertEquals( 'Set maximum upload size.', $form['fields']['max_upload_size']['desc'] );
		$this->assertEquals( ap_opt( 'max_upload_size' ), $form['fields']['max_upload_size']['value'] );

		// Test for allow_private_posts field.
		$this->assertArrayHasKey( 'allow_private_posts', $form['fields'] );
		$this->assertEquals( 'Allow private posts', $form['fields']['allow_private_posts']['label'] );
		$this->assertEquals( 'Allows users to create private question and answer. Private Q&A are only visible to admin and moderators.', $form['fields']['allow_private_posts']['desc'] );
		$this->assertEquals( 'checkbox', $form['fields']['allow_private_posts']['type'] );
		$this->assertEquals( ap_opt( 'allow_private_posts' ), $form['fields']['allow_private_posts']['value'] );
	}
}
