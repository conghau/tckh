<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# handle url for redirect login
# gan url redirect
$web_configs = DB::table('web_config')->whereRaw('1=1')->get();
foreach ( $web_configs as $config ) {
    Config::set($config->cfgname, $config->cfgvalue);
}

# counter
if ( !Session::has('visited') ) {
    DB::update('update web_counter set visitor=visitor+1');
    Session::put('visited', true);
}
DB::update('update web_counter set pageview=pageview+1');

# logs all request (chi cho user da login roi)
if ( Config::get('app.use_logs') == '1' ) {
    if (Session::has('userinfo')) {
        $tmp_userinfo = unserialize(Session::get('userinfo'));

        $log_request = new LoginedAllRequestLogs();
        $log_request->logid = cUtils::guid();
        $log_request->user_id = $tmp_userinfo->id;
        $log_request->username = $tmp_userinfo->username;
        $log_request->userinfo = Session::get('userinfo');
        $log_request->client_ip = cUtils::get_client_ip_server();
        $log_request->http_referer = !isset($_SERVER['HTTP_REFERER']) ? 'refresh page' : $_SERVER['HTTP_REFERER'];
        $log_request->http_request = $_SERVER['REQUEST_URI'];
        $log_request->created_at_unix = time();
        $log_request->save();
    } else {
        # chua dang nhap
        $log_request = new NotLoginedAllRequestLogs();
        $log_request->logid = cUtils::guid();
        $log_request->user_id = -1;
        $log_request->username = '';
        $log_request->userinfo = '';
        $log_request->client_ip = cUtils::get_client_ip_server();
        $log_request->http_referer = !isset($_SERVER['HTTP_REFERER']) ? 'refresh page' : $_SERVER['HTTP_REFERER'];
        $log_request->http_request = $_SERVER['REQUEST_URI'];
        $log_request->created_at_unix = time();
        $log_request->save();
    }
}
// info (check woman) : Ly8gbHVsdWNvbjowMTY4Mjk4Njc2OS1ob2FodW5nLTUwMA0KLy8gMDkyNjY0MDQwMS1xNi05MDAtZ29vZA0KLy8gMDEyMS44NzMuMDUwOCAtcTgtNS9o
// 0932494001-mai-q5,600s
// 0902296312 - w8 -700h - 809 ta quang buu
// 0903982395 - svh - 400h - ok
// 0903128552 - q10 - 500s
// Display all SQL executed in Eloquent
if ( Input::has('__sql') ) {
    Event::listen('illuminate.query', function ($sql, $bindings, $time) {
        //echo $sql;          // select * from my_table where id=?
        //print_r($bindings); // Array ( [0] => 4 )
        //echo $time;         // 0.58

        // To get the full sql query with bindings inserted
        $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $full_sql = vsprintf($sql, $bindings);
        print $full_sql . "\n\n";
    });
}

SystemController::init_route();
HomeController::init_route();
# User
UserController::init_route();
RolesController::init_route();
#
ArticleController::init_route();
PagesController::init_route();
MenuController::init_route();
TCKHController::init_route();
WebLinkController::init_route();