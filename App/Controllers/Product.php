<?php
namespace App\Controllers;
class Product {
  private $productsTable;
  private $get;
	private $post;

	public function __construct($productsTable, $get, $post) {
    $this->productsTable = $productsTable;
    $this->get = $get;
		$this->post = $post;
	}

	public function subs() {
    $vars = [];
    $vars[0] = 'Subscriptions';
    $vars[1] = 'Area Description';
    $vars[2] = $this->productsTable->find('type', 'Subscription');

    return [
      'template' => 'products.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Subscriptions' // Page Title
		];
	}

  public function services() {
    $vars = [];
    $vars[0] = 'Services';
    $vars[1] = 'Area Description';
    $vars[2] = $this->productsTable->find('type', 'Service');

    return [
      'template' => 'products.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Services' // Page Title
		];
	}

  public function goods() {
    $vars = [];
    $vars[0] = 'Goods';
    $vars[1] = 'Area Description';
    $vars[2] = $this->productsTable->find('type', 'Good');

    return [
			'template' => 'products.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Goods' // Page Title
		];
	}

  public function addBasket() {
    if ($this->post['method'] == 'add') {
      // Build Basket Item Details
      $item = [];
      $item['product_id'] = $this->post['product_id'];
      $item['type'] = $this->post['type'];
      $item['name'] = $this->post['name'];
      if (isset($this->post['start'])) { // Subscription Varaibles
        $item['start_day'] = date('Y-m-d', strtotime($this->post['start']));
        $item['end_day'] = date('Y-m-d', strtotime($this->post['end']));
      } else if (isset($this->post['quantity'])) { // Goods Variables
        $item['quantity'] = $this->post['quantity'];
      } else if (isset($this->post['day'])) {
        $item['day'] = $this->post['day'];
        $item['duration'] = $this->post['duration'];
        $start = strtotime('1970-01-01 '.$this->post['starthour'].':'.$this->post['startminute']);
        $item['start_time'] = date('Y-m-d H:i', $start);
        $end = strtotime('1970-01-01 '.$this->post['endhour'].':'.$this->post['endminute']);
        $item['end_time'] = date('Y-m-d H:i', $end);
      }

      array_push($_SESSION['basket'], $item); // Add item to basket array
    } else {
      $key = searchForId($this->post['product_id'], $_SESSION['basket']); // Get position of selected item in array
      unset($_SESSION['basket'][$key]); // Remove selected item from array
    }

    header('location: '.explode('/', $_SERVER['HTTP_REFERER'])[3]); // Redirect back to original page
  }
}

function searchForId($id, $array) {
  foreach ($array as $key => $val) {
    if ($val['product_id'] == $id) {
      return $key;
    }
  }
  return null;
}
