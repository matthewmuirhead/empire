<?php
namespace App\Controllers;
class User {
	private $usersTable;
	private $get;
	private $post;

	public function __construct($usersTable, array $get, array $post) {
		$this->usersTable = $usersTable;
		$this->get = $get;
		$this->post = $post;
	}

  public function login() {
    return [
      'template' => '/login.html.php',
			'title' => 'Log In',
			'variables' => []
		];
  }

  function loginSubmit() {
    $stmt = $this->usersTable->findAll();
		$found = false;
    foreach ($stmt as $row) {
      if ($row['email'] == $this->post['username'] && $row['password'] == password_verify($this->post['password'], $row['password'])) { // Checl username and hashed password
        $_SESSION['loggedin'] = 'logged in'; // Store required information in session varaibles
				$_SESSION['id'] = $row['user_id'];
				$_SESSION['user'] = $row['name'];
				$_SESSION['account'] = $row['account_type'];
				$found = true;
				if ($_SESSION['account'] == 'Admin') { // Take user to admin area if account is Admin
					header('location: /admin');
				} else {
					header('location: /');
				}
      }
    }
		if ($found == false) {
			header('location: /login');
		}
  }

  public function logout() {
    unset($_SESSION['loggedin']);
    session_destroy();

    header('location: /');
  }

  function adminHome() {

    return [
      'template' => '/admin/home.html.php',
			'title' => 'Fotheby\'s Auction House - Admin Home',
			'variables' => []
		];
  }

	function list() {
		$usersVariables = [];
		$users = [$usersVariables];
		$i=0;

		$userList = $this->usersTable->findAll();
		foreach ($userList as $user) {
			$usersVariables = [
				'id' => $user['user_id'],
				'name' => $user['first_name'] . ' ' . $user['surname'],
				'username' => $user['username'],
				'account' => $user['account_type'],
				'creation' => date('d/m/Y', strtotime($user['account_creation']))
			];
			$users[$i++] = $usersVariables;
		}

		$vars = $users;

		return [
      'template' => '/admin/users.html.php',
			'title' => 'Fotheby\'s Auction House - Users',
			'categories' => $categories,
			'variables' => $vars
		];
	}

	function add(){
		return [
      'template' => '/admin/usersAdd.html.php',
			'title' => 'Fotheby\'s Auction House - User Add',
			'variables' => []
		];
	}

	function edit(){
		$vars = $this->usersTable->find('user_id', $this->get['id'])[0];

		return [
      'template' => '/admin/usersEdit.html.php',
			'title' => 'Fotheby\'s Auction House - User Edit',
			'variables' => $vars
		];
	}

	// function profile() {
	// 	$categories = $this->getCategories();
	//
	// 	$vars = [];
	// 	$vars[0] = $categories;
  //   $vars[1] = $this->getSellers();
  //   $vars[2] = $this->getLocations();
	// 	$vars[3] = $this->usersTable->find('user_id', $_SESSION['id'])[0];
	// 	$vars[4] = $this->artworkList($this->artworkTable->find('seller', $_SESSION['id']), 'Sold');
	// 	$vars[5] = $this->artworkList($this->artworkTable->find('seller', $_SESSION['id']), 'Ready');
	// 	$vars[6] = $this->artworkList($this->artworkTable->find('buyer', $_SESSION['id']), 'Sold');
	//
	// 	return [
  //     'template' => '/profile.html.php',
	// 		'title' => 'Fotheby\'s Auction House - My Profile',
	// 		'categories' => $categories,
	// 		'variables' => $vars
	// 	];
	// }
	//
	// function artworkList($artworkList, $status) {
  //   $artworkData = [];
  //   $k=0;
	//
  //   foreach($artworkList as $artwork) {
  //     if ($artwork['status'] == $status) {
  //       $artworkVariables = [
  //         'start_price' => $artwork['start_amount'],
	// 				'estimated_amount' => $artwork['estimated_amount'],
  //         'name'=> $artwork['name'],
  //         'id' => $artwork['artwork_id'],
  //         'status' => $artwork['status'],
  //         'number_of_images' => $artwork['number_of_images'],
  //         'category_id' => $artwork['category_id'],
  //         'auction_id' => '-1',
  //         'auction_location' => '',
  //         'auction_date' => '',
	// 				'sold_amount' => $artwork['sold_amount'],
	// 				'artist' => $artwork['artist'],
	// 				'year' => $artwork['year']
  //       ];
	//
  //       if(isset($artwork['next_auction'])) {
  //         $auctionDetails = $this->auctionsTable->find('auction_id', $artwork['next_auction']);
  //         foreach ($auctionDetails as $key) {
  //           $artworkVariables['auction_id'] = $key['auction_id'];
  //           $artworkVariables['auction_location'] = $this->locationsTable->find('location_id', $key['location_id'])[0]['name'];
  //           $artworkVariables['auction_date'] = strtotime($key['date']);
  //         }
  //       }
	//
  //       $artworkData[$k++] = $artworkVariables;
  //     }
  //   }
  //   return $artworkData;
  // }

	function save() {
		$user['name'] = $this->post['name'];
		$user['email'] = $this->post['email'];
		$user['phone'] = $this->post['phone'];
		$user['account_type'] = 'Customer';
		$user['password'] = password_hash($this->post['password'], PASSWORD_DEFAULT);
		$this->usersTable->save($user);
		$this->loginSubmit();
		header('location: /');
	}

	function delete() {
		$this->usersTable->delete($this->post['id']);
		header('location: /admin/user');
	}

}
