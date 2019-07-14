<?php
namespace App;
class Routes implements \Web\Routes {
  public function getRoutes() {
    // Get database connection
    require '../database.php';

    // Table objects
    $usersTable = new \Web\DatabaseTable($pdo, 'users', 'user_id');
    $productsTable = new \Web\DatabaseTable($pdo, 'products', 'product_id');
    $ordersTable = new \Web\DatabaseTable($pdo, 'orders', 'order_id');
    $orderGoodsTable = new \Web\DatabaseTable($pdo, 'order_goods', 'order_good_id');
    $orderServicesTable = new \Web\DatabaseTable($pdo, 'order_services', 'order_service_id');
    $orderSubsTable = new \Web\DatabaseTable($pdo, 'order_subs', 'order_sub_id');

    // Controllers
    $homeController = new \App\Controllers\Home($usersTable);
    $userController = new \App\Controllers\User($usersTable, $_GET, $_POST);
    $productsController = new \App\Controllers\Product($productsTable, $_GET, $_POST);
    $ordersController = new \App\Controllers\Order($usersTable, $productsTable, $ordersTable, $orderSubsTable, $orderServicesTable, $orderGoodsTable, $_GET, $_POST);

    // Routes to pages
    $routes = [
      '' => [
        'GET' => [
          'controller' => $homeController,
          'function' => 'home'
        ]
      ],
      'subscriptions' => [
        'GET' => [
          'controller' => $productsController,
          'function' => 'subs'
        ],
        'POST' => [
          'controller' => $productsController,
          'function' => 'addBasket'
        ]
      ],
      'services' => [
        'GET' => [
          'controller' => $productsController,
          'function' => 'services'
        ],
        'POST' => [
          'controller' => $productsController,
          'function' => 'addBasket'
        ]
      ],
      'goods' => [
        'GET' => [
          'controller' => $productsController,
          'function' => 'goods'
        ],
        'POST' => [
          'controller' => $productsController,
          'function' => 'addBasket'
        ]
      ],
      'basket' => [
        'GET' => [
          'controller' => $ordersController,
          'function' => 'basket'
        ],
        'login' => true
      ],
      'checkout' => [
        'POST' => [
          'controller' => $ordersController,
          'function' => 'checkout'
        ],
        'login' => true
      ],
      'payment' => [
        'POST' => [
          'controller' => $ordersController,
          'function' => 'payment'
        ],
        'login' => true
      ],
      'register' => [
        'POST' => [
          'controller' => $userController,
          'function' => 'save'
        ]
      ],
      'login' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'login'
        ],
        'POST' => [
          'controller' => $userController,
          'function' => 'loginSubmit'
        ]
      ],
      'logout' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'logout'
        ]
      ],
      'search' => [
        'POST' => [
          'controller' => $productsController,
          'function' => 'search'
        ]
      ],
      'admin' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'adminHome'
        ]
      ],

      'admin/user' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'list'
        ],
        'login' => true,
        'admin' => true,
      ],
      'admin/user/add' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'add'
        ],
        'POST' => [
          'controller' => $userController,
          'function' => 'save'
        ],
        'login' => true,
        'admin' => true,
      ],
      'admin/user/edit' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'edit'
        ],
        'POST' => [
          'controller' => $userController,
          'function' => 'save'
        ],
        'login' => true,
        'admin' => true,
      ],
      'admin/user/delete' => [
        'POST' => [
          'controller' => $userController,
          'function' => 'delete'
        ],
        'login' => true,
        'admin' => true,
      ],
      'profile' => [
        'GET' => [
          'controller' => $userController,
          'function' => 'profile'
        ],
        'POST' => [
          'controller' => $userController,
          'function' => 'save'
        ],
        'login' => true,
      ],
    ];
    return $routes;
  }

  // Check if user is logged in
  public function checkLogin() {
    if (!isset($_SESSION['loggedin'])) {
      header('location: /login');
    }
  }

  // Check if logged in user is an admin
  public function checkAdmin() {
    if (!isset($_SESSION['loggedin'])) {
      header('location: /login');
    } else {
      if ($_SESSION['account'] != 'Admin') {
        header('location: /login');
      }
    }
  }
}
