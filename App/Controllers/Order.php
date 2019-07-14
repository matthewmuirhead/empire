<?php
namespace App\Controllers;
class Order {
  private $usersTable;
  private $productsTable;
  private $ordersTable;
  private $orderSubsTable;
  private $orderServicesTable;
  private $orderGoodsTable;
  private $get;
	private $post;

	public function __construct($usersTable, $productsTable, $ordersTable, $orderSubsTable, $orderServicesTable, $orderGoodsTable, $get, $post) {
    $this->usersTable = $usersTable;
    $this->productsTable = $productsTable;
    $this->ordersTable = $ordersTable;
    $this->orderSubsTable = $orderSubsTable;
    $this->orderServicesTable = $orderServicesTable;
    $this->orderGoodsTable = $orderGoodsTable;
    $this->get = $get;
		$this->post = $post;
	}

	public function basket() {
    $vars[0] = $_SESSION['basket'];
    $vars[1] = $this->productsTable->findAll();

    return [
      'template' => 'basket.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Basket' // Page Title
		];
	}

  public function checkout() {
    $vars = [];
    $vars[0] = $this->post['total'];
    $vars[1] = $this->post['order'];

    return [
      'template' => 'checkout.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Checkout' // Page Title
		];
	}

  public function payment() {
    $order = [
      'user_id' => $_SESSION['id'],
      'total' => $this->post['total']
    ];
    $this->ordersTable->save($order); // Save to database
    $orderID = $this->ordersTable->getLastInsertID(); // Get Order ID

    $orderDetails = unserialize(base64_decode($this->post['order']));

    foreach ($orderDetails as $item) {
      $itemDetails = [];
      if ($item['type'] == 'Subscription') {
        $itemDetails = [ // Set Variables for insert
          'order_id' => $orderID,
          'product_id' => $item['product_id'],
          'price' => $item['price'],
          'start' => $item['start'],
          'end' => $item['end'],
        ];
        $this->orderSubsTable->save($itemDetails); // Save to database
      } else if ($item['type'] == 'Service') {
        $itemDetails = [ // Set Variables for insert
          'order_id' => $orderID,
          'product_id' => $item['product_id'],
          'price' => $item['price'],
          'day' => $item['day'],
          'start_time' => $item['start_time'],
          'end_time' => $item['end_time'],
          'duration' => $item['duration'],
        ];
        $this->orderServicesTable->save($itemDetails); // Save to database
      } else if ($item['type'] == 'Good') {
        $itemDetails = [ // Set Variables for insert
          'order_id' => $orderID,
          'product_id' => $item['product_id'],
          'price' => $item['price'],
          'quantity' => $item['quantity'],
        ];
        print_r($itemDetails);
        $this->orderGoodsTable->save($itemDetails); // Save to database
      }
    }
    $_SESSION['basket'] = [];
    header('location: /');
  }
}
