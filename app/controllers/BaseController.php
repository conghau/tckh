<?php
class BaseController extends \Controller {
    protected $userinfo;

	public function __construct() {
        # share var for all template
        if (Session::has('userinfo'))
        {
            $this->userinfo = unserialize(Session::get('userinfo'));
            View::share('userinfo', $this->userinfo);
        }
        else {
            $this->userinfo = null;
        }
	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
        # share detect action is open in popup dialog
        View::share('action_is_popup', Input::has('popup') ? '?popup=true' : '');
        View::share('action_is_blank', Input::has('blank') ? '?blank=true' : '');

        # counter
        $counter = DB::select('select * from web_counter limit 0,1');
        if ( $counter ) {
            View::share('visitor_count', str_pad($counter[0]->visitor, 10, '0', STR_PAD_LEFT));
        }

        # weblink
        //$list_weblink = WebLink::orderBy('link_order')->get();
        //View::share('list_weblink', $list_weblink);
				# bai bao duoc quan tam
				$list_baibao_quantam = DB::table('web_tckh_baiviet')
					->orderBy('quantam', 'desc')
					->orderBy('viewno', 'desc')
					->paginate(Config::get('tapchikhoahoc.quantam_paging_size'));
				View::share('list_baibao_quantam', $list_baibao_quantam);
				
				# tap chi so moi nhat
				$list_tapchi_moinhat = DB::table('web_tckh_tapchi')
					->orderBy('namtapchi', 'desc')
					->orderBy('sotapchi', 'desc')
					->paginate(Config::get('tapchikhoahoc.tapchimoinhat_paging_size'));
				View::share('list_tapchi_moinhat', $list_tapchi_moinhat);

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
