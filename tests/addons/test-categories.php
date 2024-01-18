<?php

namespace Anspress\Tests;

use Yoast\WPTestUtils\WPIntegration\TestCase;

class TestAddonCategories extends TestCase {

	/**
	 * @covers Anspress\Addons\Categories::instance
	 */
	public function testInstance() {
		$class = new \ReflectionClass( 'Anspress\Addons\Categories' );
		$this->assertTrue( $class->hasProperty( 'instance' ) && $class->getProperty( 'instance' )->isStatic() );
	}

	public function testMethodExists() {
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', '__construct' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'category_page' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'categories_page' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'register_question_categories' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'load_options' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'register_general_settings_form' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'admin_enqueue_scripts' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_load_admin_assets' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'admin_category_menu' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_display_question_metas' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_assets_js' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'term_link_filter' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_question_form_fields' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'after_new_question' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_breadcrumbs' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'terms_clauses' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_list_filters' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'image_field_new' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'image_field_edit' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'save_image_field' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'rewrite_rules' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_main_questions_args' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'subscribers_action_id' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_ask_btn_link' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_canonical_url' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'category_feed' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'load_filter_category' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'filter_active_category' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'column_header' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'column_content' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'ap_current_page' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'modify_query_category_archive' ) );
		$this->assertTrue( method_exists( 'Anspress\Addons\Categories', 'widget' ) );
	}

	/**
	 * @covers Anspress\Addons\Categories::instance
	 */
	public function testInit() {
		$instance1 = \Anspress\Addons\Categories::init();
		$this->assertInstanceOf( 'Anspress\Addons\Categories', $instance1 );
		$instance2 = \Anspress\Addons\Categories::init();
		$this->assertSame( $instance1, $instance2 );
	}

	/**
	 * @covers Anspress\Addons\Categories::load_options
	 */
	public function testLoadOptions() {
		$instance = \Anspress\Addons\Categories::init();

		// Call the method.
		$groups = $instance->load_options( [] );

		// Test if the Category group is added to the settings page.
		$this->assertArrayHasKey( 'category', $groups );
		$this->assertEquals( 'Category', $groups['category']['label'] );

		// Test by adding new group.
		$groups = $instance->load_options( [ 'some_other_group' => [ 'label' => 'Some Other Group' ] ] );

		// Test if the new group is added to the settings page.
		$this->assertArrayHasKey( 'some_other_group', $groups );
		$this->assertEquals( 'Some Other Group', $groups['some_other_group']['label'] );

		// Test if the existing group are retained to the settings page.
		$this->assertArrayHasKey( 'category', $groups );
		$this->assertEquals( 'Category', $groups['category']['label'] );
	}

	/**
	 * @covers Anspress\Addons\Categories::register_general_settings_form
	 */
	public function testRegisterGeneralSettingsForm() {
		$instance = \Anspress\Addons\Categories::init();

		// Add form_category_orderby, categories_page_order, categories_page_orderby, category_page_slug, categories_per_page and categories_image_height options.
		ap_add_default_options(
			array(
				'form_category_orderby'   => 'count',
				'categories_page_order'   => 'DESC',
				'categories_page_orderby' => 'count',
				'category_page_slug'      => 'category',
				'categories_per_page'     => 20,
				'categories_image_height' => 150,
			)
		);

		// Call the method.
		$forms = $instance->register_general_settings_form();

		// Test begins.
		$this->assertNotEmpty( $forms );
		$this->assertArrayHasKey( 'categories_page_info', $forms['fields'] );
		$this->assertArrayHasKey( 'form_category_orderby', $forms['fields'] );
		$this->assertArrayHasKey( 'categories_page_orderby', $forms['fields'] );
		$this->assertArrayHasKey( 'categories_page_order', $forms['fields'] );
		$this->assertArrayHasKey( 'categories_per_page', $forms['fields'] );
		$this->assertArrayHasKey( 'categories_image_height', $forms['fields'] );

		// Test for categories_page_info field.
		$this->assertArrayHasKey( 'html', $forms['fields']['categories_page_info'] );
		$this->assertStringContainsString( '<label class="ap-form-label" for="form_options_category_general-categories_page_info">Categories base page</label>', $forms['fields']['categories_page_info']['html'] );
		$this->assertStringContainsString( 'Base page for categories can be configured in general settings of AnsPress.', $forms['fields']['categories_page_info']['html'] );

		// Test for form_category_orderby field.
		$this->assertArrayHasKey( 'label', $forms['fields']['form_category_orderby'] );
		$this->assertEquals( 'Ask form category order', $forms['fields']['form_category_orderby']['label'] );
		$this->assertArrayHasKey( 'description', $forms['fields']['form_category_orderby'] );
		$this->assertEquals( 'Set how you want to order categories in form.', $forms['fields']['form_category_orderby']['description'] );
		$this->assertArrayHasKey( 'type', $forms['fields']['form_category_orderby'] );
		$this->assertEquals( 'select', $forms['fields']['form_category_orderby']['type'] );
		$this->assertArrayHasKey( 'options', $forms['fields']['form_category_orderby'] );
		$options_array = [
			'ID'         => 'ID',
			'name'       => 'Name',
			'slug'       => 'Slug',
			'count'      => 'Count',
			'term_group' => 'Group',
		];
		$this->assertEquals( $options_array, $forms['fields']['form_category_orderby']['options'] );
		$this->assertArrayHasKey( 'ID', $forms['fields']['form_category_orderby']['options'] );
		$this->assertEquals( 'ID', $forms['fields']['form_category_orderby']['options']['ID'] );
		$this->assertArrayHasKey( 'name', $forms['fields']['form_category_orderby']['options'] );
		$this->assertEquals( 'Name', $forms['fields']['form_category_orderby']['options']['name'] );
		$this->assertArrayHasKey( 'slug', $forms['fields']['form_category_orderby']['options'] );
		$this->assertEquals( 'Slug', $forms['fields']['form_category_orderby']['options']['slug'] );
		$this->assertArrayHasKey( 'count', $forms['fields']['form_category_orderby']['options'] );
		$this->assertEquals( 'Count', $forms['fields']['form_category_orderby']['options']['count'] );
		$this->assertArrayHasKey( 'term_group', $forms['fields']['form_category_orderby']['options'] );
		$this->assertEquals( 'Group', $forms['fields']['form_category_orderby']['options']['term_group'] );
		$this->assertArrayHasKey( 'value', $forms['fields']['form_category_orderby'] );
		$this->assertEquals( ap_opt( 'form_category_orderby' ), $forms['fields']['form_category_orderby']['value'] );

		// Test for categories_page_orderby field.
		$this->assertArrayHasKey( 'label', $forms['fields']['categories_page_orderby'] );
		$this->assertEquals( 'Categories page order by', $forms['fields']['categories_page_orderby']['label'] );
		$this->assertArrayHasKey( 'description', $forms['fields']['categories_page_orderby'] );
		$this->assertEquals( 'Set how you want to order categories in categories page.', $forms['fields']['categories_page_orderby']['description'] );
		$this->assertArrayHasKey( 'type', $forms['fields']['categories_page_orderby'] );
		$this->assertEquals( 'select', $forms['fields']['categories_page_orderby']['type'] );
		$this->assertArrayHasKey( 'options', $forms['fields']['categories_page_orderby'] );
		$options_array = [
			'ID'         => 'ID',
			'name'       => 'Name',
			'slug'       => 'Slug',
			'count'      => 'Count',
			'term_group' => 'Group',
		];
		$this->assertEquals( $options_array, $forms['fields']['categories_page_orderby']['options'] );
		$this->assertArrayHasKey( 'ID', $forms['fields']['categories_page_orderby']['options'] );
		$this->assertEquals( 'ID', $forms['fields']['categories_page_orderby']['options']['ID'] );
		$this->assertArrayHasKey( 'name', $forms['fields']['categories_page_orderby']['options'] );
		$this->assertEquals( 'Name', $forms['fields']['categories_page_orderby']['options']['name'] );
		$this->assertArrayHasKey( 'slug', $forms['fields']['categories_page_orderby']['options'] );
		$this->assertEquals( 'Slug', $forms['fields']['categories_page_orderby']['options']['slug'] );
		$this->assertArrayHasKey( 'count', $forms['fields']['categories_page_orderby']['options'] );
		$this->assertEquals( 'Count', $forms['fields']['categories_page_orderby']['options']['count'] );
		$this->assertArrayHasKey( 'term_group', $forms['fields']['categories_page_orderby']['options'] );
		$this->assertEquals( 'Group', $forms['fields']['categories_page_orderby']['options']['term_group'] );
		$this->assertArrayHasKey( 'value', $forms['fields']['categories_page_orderby'] );
		$this->assertEquals( ap_opt( 'categories_page_orderby' ), $forms['fields']['categories_page_orderby']['value'] );

		// Test for categories_page_order field.
		$this->assertArrayHasKey( 'label', $forms['fields']['categories_page_order'] );
		$this->assertEquals( 'Categories page order', $forms['fields']['categories_page_order']['label'] );
		$this->assertArrayHasKey( 'description', $forms['fields']['categories_page_order'] );
		$this->assertEquals( 'Set how you want to order categories in categories page.', $forms['fields']['categories_page_order']['description'] );
		$this->assertArrayHasKey( 'type', $forms['fields']['categories_page_order'] );
		$this->assertEquals( 'select', $forms['fields']['categories_page_order']['type'] );
		$this->assertArrayHasKey( 'options', $forms['fields']['categories_page_order'] );
		$options_array = [
			'ASC'  => 'Ascending',
			'DESC' => 'Descending',
		];
		$this->assertEquals( $options_array, $forms['fields']['categories_page_order']['options'] );
		$this->assertArrayHasKey( 'ASC', $forms['fields']['categories_page_order']['options'] );
		$this->assertEquals( 'Ascending', $forms['fields']['categories_page_order']['options']['ASC'] );
		$this->assertArrayHasKey( 'DESC', $forms['fields']['categories_page_order']['options'] );
		$this->assertEquals( 'Descending', $forms['fields']['categories_page_order']['options']['DESC'] );
		$this->assertArrayHasKey( 'value', $forms['fields']['categories_page_order'] );
		$this->assertEquals( ap_opt( 'categories_page_order' ), $forms['fields']['categories_page_order']['value'] );

		// Test for categories_per_page field.
		$this->assertArrayHasKey( 'label', $forms['fields']['categories_per_page'] );
		$this->assertEquals( 'Category per page', $forms['fields']['categories_per_page']['label'] );
		$this->assertArrayHasKey( 'desc', $forms['fields']['categories_per_page'] );
		$this->assertEquals( 'Category to show per page', $forms['fields']['categories_per_page']['desc'] );
		$this->assertArrayHasKey( 'subtype', $forms['fields']['categories_per_page'] );
		$this->assertEquals( 'number', $forms['fields']['categories_per_page']['subtype'] );
		$this->assertArrayHasKey( 'value', $forms['fields']['categories_per_page'] );
		$this->assertEquals( ap_opt( 'categories_per_page' ), $forms['fields']['categories_per_page']['value'] );

		// Test for categories_image_height field.
		$this->assertArrayHasKey( 'label', $forms['fields']['categories_image_height'] );
		$this->assertEquals( 'Categories image height', $forms['fields']['categories_image_height']['label'] );
		$this->assertArrayHasKey( 'desc', $forms['fields']['categories_image_height'] );
		$this->assertEquals( 'Image height in categories page', $forms['fields']['categories_image_height']['desc'] );
		$this->assertArrayHasKey( 'subtype', $forms['fields']['categories_image_height'] );
		$this->assertEquals( 'number', $forms['fields']['categories_image_height']['subtype'] );
		$this->assertArrayHasKey( 'value', $forms['fields']['categories_image_height'] );
		$this->assertEquals( ap_opt( 'categories_image_height' ), $forms['fields']['categories_image_height']['value'] );
	}
}
