<?php

class CheckoutPageTest extends FunctionalTest{

	public static $fixture_file = 'shop/tests/fixtures/shop.yml';
	public static $disable_theme = true;
	public static $use_draft_site = true;

	protected $controller;

	public function setUp() {
		parent::setUp();
		ShopTest::setConfiguration();
	}

	public function testActionsForm(){
		$order = $this->objFromFixture("Order","unpaid");
		OrderManipulation::add_session_order($order);
		$this->get("/checkout/order/".$order->ID);

		//make payment action
		$this->post("/checkout/order/ActionsForm",array(
			'OrderID' => $order->ID,
			'PaymentMethod' => 'Dummy',
			'action_dopayment' => 'submit'
		));

		//cancel action
		$this->post("/checkout/order/ActionsForm",array(
			'OrderID' => $order->ID,
			'action_docancel' => 'submit'
		));
	}

	//log user in
	//set the current order
	//visit order page

	public function testPayment(){

		//make payment
		$data = array(
			'name' => 'Joe Bloggs',
			'number' => '4242424242424242',
			'expiryMonth' => '',
			'expiryYear' => '',
			'cvv' => '123'
		);

		//$form->loadDataFrom($data);
		//$form->submitPayment($data, $form);

		//$payment = $order->Payments()->first();
		//$this->assertEquals("Dummy",$payment->Gateway);
	}

}
