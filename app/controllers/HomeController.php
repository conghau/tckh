<?php

//# news module
use App\BaseController;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct() {
        parent::__construct();
	}

    public static function init_route() {
        Route::get('/','HomeController@frontpage');	# Any HTTP Verb
    }

	public function frontpage()
	{
        # articles
        $num_article_summary = Config::get('frontpage.news_items_in_cat');
        $num_article_more = Config::get('frontpage.news_items_in_cat_more');
        $list_cat = Articles::get_listcat_n_articles($num_article_summary, $num_article_more);

        return View::make('layout/frontpage-layout', array(
            'list_cat' => $list_cat,
            'num_article_summary' => $num_article_summary,
            'num_article_more' => $num_article_more,
        ));
	}

}
