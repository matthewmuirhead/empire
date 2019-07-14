<?php
namespace App\Controllers;
class Home {
  private $usersTable;

	public function __construct($usersTable) {
    $this->usersTable = $usersTable;
	}

	public function home() {

    $vars = [];

    return [
      'template' => 'home.html.php', // Layout of page contents
			'variables' => $vars, // Variables
			'title' => 'Home' // Page Title
		];
	}


}
