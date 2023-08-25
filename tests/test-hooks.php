<?php

namespace Anspress\Tests;

use Yoast\WPTestUtils\WPIntegration\TestCase;
use AnsPress\Tests\Testcases\Common;

class TestHooks extends TestCase {

	/**
	 * @covers AnsPress_Hooks::comment_subscription
	 * @covers AnsPress_Hooks::delete_comment_subscriptions
	 */
	public function testCommentSubscription() {
		global $wpdb;
		$wpdb->query( "TRUNCATE {$wpdb->ap_subscribers}" );

		$this->assertEquals( 10, has_action( 'ap_publish_comment', [ 'AnsPress_Hooks', 'comment_subscription' ] ) );
		$this->assertEquals( 10, has_action( 'deleted_comment', [ 'AnsPress_Hooks', 'delete_comment_subscriptions' ] ) );
		Common::setRole( 'subscriber' );

		$question_id = Common::insert_question();
		$comment_id  = $this->factory->comment->create_object(
			array(
				'comment_type'    => 'anspress',
				'post_status'     => 'publish',
				'comment_post_ID' => $question_id,
				'user_id'         => get_current_user_id(),
			)
		);
		$comment = get_comment( $comment_id );

		do_action( 'ap_publish_comment', get_comment( $comment_id ) );
		$this->assertTrue( null !== ap_get_subscriber( false, 'question_' . $question_id, $comment_id ) );

		wp_delete_comment( $comment_id, true );
		$this->assertTrue(
			[] === ap_get_subscribers(
				[
					'subs_event'  => 'question_' . $question_id,
					'subs_ref_id' => $comment_id,
				]
			)
		);

		Common::setRole( 'subscriber' );
		$ids        = Common::insert_answer();
		$comment_id = $this->factory->comment->create_object(
			array(
				'comment_type'    => 'anspress',
				'post_status'     => 'publish',
				'comment_post_ID' => $ids->a,
				'user_id'         => get_current_user_id(),
			)
		);
		$comment = get_comment( $comment_id );

		do_action( 'ap_publish_comment', get_comment( $comment_id ) );
		$this->assertTrue( null !== ap_get_subscriber( false, 'answer_' . $ids->a, $comment_id ) );

		wp_delete_comment( $comment_id, true );
		$this->assertTrue(
			[] === ap_get_subscribers(
				[
					'subs_event'  => 'answer_' . $ids->a,
					'subs_ref_id' => $comment_id,
				]
			)
		);
	}
}