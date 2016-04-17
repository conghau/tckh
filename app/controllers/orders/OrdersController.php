<?php

class OrdersController extends BaseController {
	public static $admin_menu = array(
			array(
					'title' => 'Quản lý đặt hàng',
					'url' => 'orders',
					'permissions' => array(
							'admin_pages'
					),
			)
	);
	
	public function __construct() {
		parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth');
		
	}
	
	public static function init_route() {
		Route::any('orders','OrdersController@index');
		Route::any('orders/search','OrdersController@search');
		Route::any('orders/store','OrdersController@user_orders_store');
	}
	
	public function index() {
		$userinfo = unserialize(Session::get('userinfo'));
		var_dump($userinfo);
		return View::make('mod.orders.index', array (
				'user_info' => $userinfo
		));
	}
	public function user_orders_store() {
		return View::make('mod.orders.index');
	}
}
