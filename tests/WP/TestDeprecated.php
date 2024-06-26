<?php

namespace AnsPress\Tests\WP;

use Yoast\WPTestUtils\WPIntegration\TestCase;

class TestDeprecated extends TestCase {

	/**
	 * @covers ::ap_get_hover_card_attr
	 */
	public function testAPGetHoverCardAttr() {
		$this->setExpectedDeprecated( 'ap_get_hover_card_attr' );
		ap_get_hover_card_attr();
	}

	/**
	 * @covers ::ap_hover_card_attr
	 */
	public function testAPHoverCardAttr() {
		$this->setExpectedDeprecated( 'ap_hover_card_attr' );
		ap_hover_card_attr();
	}

	/**
	 * @covers ::ap_responce_message
	 */
	public function testAPResponceMessage() {
		$this->setExpectedDeprecated( 'ap_responce_message' );
		ap_responce_message( 'id' );
	}

	/**
	 * @covers ::ap_verify_nonce
	 */
	public function testAPVerifyNonce() {
		$this->setExpectedDeprecated( 'ap_verify_nonce' );
		ap_verify_nonce( 'anspress-tests' );
	}
}
