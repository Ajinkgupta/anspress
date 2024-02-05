<?php

namespace Anspress\Tests;

use Yoast\WPTestUtils\WPIntegration\TestCase;

class TestQustionLoop extends TestCase {

	use Testcases\Common;

	/**
	 * @covers ::ap_questions_the_pagination
	 */
	public function testAPQuestionsThePagination() {
		// Test for front page.
		$page_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		update_option( 'page_on_front', $page_id );
		update_option( 'show_on_front', 'page' );

		// Test 1.
		$this->go_to( home_url() );
		set_query_var( 'page', 1 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">1</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringNotContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 2.
		$this->go_to( home_url() );
		set_query_var( 'page', 2 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">2</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 3.
		$this->go_to( home_url() );
		set_query_var( 'page', 3 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">3</span>', $pagination );
		$this->assertStringNotContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Reset the front page.
		update_option( 'page_on_front', 0 );
		update_option( 'show_on_front', 'posts' );

		// Test for other pages.
		$base_page_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		ap_opt( 'categories_page', $base_page_id );

		// Test on ap_paged query var.
		// Test 1.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'ap_paged', 1 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">1</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringNotContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 2.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'ap_paged', 2 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">2</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 3.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'ap_paged', 3 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">3</span>', $pagination );
		$this->assertStringNotContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test on paged query var.
		// Test 1.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'paged', 1 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">1</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringNotContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 2.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'paged', 2 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">2</span>', $pagination );
		$this->assertStringContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );

		// Test 3.
		$this->go_to( '?post_type=page&p=' . $base_page_id );
		set_query_var( 'paged', 3 );
		anspress()->questions = (object) [ 'max_num_pages' => 3 ];
		ob_start();
		ap_questions_the_pagination();
		$pagination = ob_get_clean();
		$this->assertNotEmpty( $pagination );
		$this->assertStringContainsString( '<div class="ap-pagination clearfix">', $pagination );
		$this->assertStringContainsString( '<span aria-current="page" class="page-numbers current">3</span>', $pagination );
		$this->assertStringNotContainsString( 'class="next page-numbers" rel="next"', $pagination );
		$this->assertStringContainsString( 'class="prev page-numbers" rel="prev"', $pagination );
	}
}
