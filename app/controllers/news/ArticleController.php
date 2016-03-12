<?php

use App\Models\News\Categories;
use App\Models\News\ArticleDetails;
use App\BaseController;

class ArticleController extends BaseController {

    public static $admin_menu = array(
        array(
            'title' => 'Danh sách bài viết',
            'url' => 'news',
            'permissions' => array('xem_ds_baiviet'),
        ),
        array(
            'title' => 'Đăng bài viết',
            'url' => 'news/article/createarticle',
            'permissions' => array('viet_bai_viet'),
        ),
        array(
            'title' => 'Danh sách chuyên mục',
            'url' => 'news/cat/listcat',
            'permissions' => array('xem_ds_baiviet'),
        ),
        array(
            'title' => 'Tạo chuyên mục',
            'url' => 'news/cat/createcat',
            'permissions' => array('admin_news'),
        ),

    );

	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
                'view_article',
                'view_articlecat'
			))
		);
		
		// clear ckfinder module
		unset($_SESSION['ckfinder_module_info']);
	
		# share var for all template
		if ($this->userinfo)
		{
			if ( $this->userinfo->sa != 1 ) {
				return View::make('error', array(
					'error_message' => 'Không có quyền truy cập !!!'
				));
			}
		}
		else {
			return View::make('error', array(
				'error_message' => 'Không tìm thấy thông tin tài khoản sử dụng !!!'
			));
		}
	}

    public static function init_route() {
        Route::any('news/cat','CatController@admin_index');
        Route::any('news/cat/listcat/{parent_cat_id?}','CatController@admin_listcat');
        Route::any('news/cat/createcat/{parent_cat_id?}','CatController@admin_createcat');
        Route::any('news/cat/editcat/{cat_id?}','CatController@admin_editcat');
        Route::any('news/cat/deletecat/{cat_id?}','CatController@admin_deletecat');

        Route::any('news','ArticleController@admin_listarticle');
        Route::any('news/article/listarticle/{cat_id?}','ArticleController@admin_listarticle');
        Route::any('news/article/createarticle/{cat_id?}','ArticleController@admin_createarticle');
        Route::any('news/article/editarticle/{article_id}','ArticleController@admin_editarticle');
        Route::any('news/article/deletearticle/{article_id}','ArticleController@admin_deletearticle');
        Route::any('news/article/duyetbaiviet/{article_id}','ArticleController@admin_duyetbaiviet');
        Route::any('news/article/publishbaiviet/{article_id}','ArticleController@admin_publishbaiviet');
        Route::any('news/article/sethot/{article_id}','ArticleController@admin_sethot');
        Route::any('news/view/{article_title_seo}','ArticleController@view_article');
        Route::any('news/viewartilces/{cat_id}','ArticleController@view_articlecat');
    }

    public static function admin_menu() {
        $userinfo = unserialize(Session::get('userinfo'));
        $perms = $userinfo->get_permissions();

        $menu_html = '';
        $menu_allow_items = 0;
        if ( self::$admin_menu && count(self::$admin_menu) > 0 ) {
            foreach ( self::$admin_menu as $amenu ) {
                if ( $amenu['permissions'] && count($amenu['permissions']) > 0 ) {
                    foreach ( $amenu['permissions'] as $perm ) {
                        if ( $userinfo->sa == 1 ){
                            $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                            $menu_allow_items++;
                        }
                        else {
                            if ( in_array($perm, $perms) ) {
                                $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                                $menu_allow_items++;
                            }
                        }
                    }
                }
            }
        }

        if ( $menu_allow_items > 0 )  {
            $menu_html = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Quản lý Thông báo/Tin tức <span class="icon-angle-down"></span></a>' .
                '<ul class="dropdown-menu">' . $menu_html .
                '</ul></li>';
        }
        else $menu_html = '';

        return $menu_html;
    }
	
	public function admin_listarticle($cat_id = 0) {
        if ( !$this->userinfo->is_access(array('admin_news','xem_ds_baiviet')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }
		$list_articles = null;
	
		$catinfo = null;
		$qResult = null;
		if ( $cat_id == 0 ) {
			# list all bai viet
			$qResult = DB::table('web_news_articles')
                ->join('web_news_categories', 'web_news_articles.cat_id', '=', 'web_news_categories.id')
                ->orderBy('sticky','desc')->orderBy('post_date','desc')->orderBy('create_at','desc')
                ->select('web_news_articles.*', 'web_news_categories.catname', 'web_news_categories.orderno');
		}
		else {
			$catinfo = Categories::find($cat_id);
		
			$qResult = DB::table('web_news_articles')
                ->join('web_news_categories', 'web_news_articles.cat_id', '=', 'web_news_categories.id')
                ->where('web_news_articles.cat_id','=',$cat_id)
                ->orderBy('sticky','desc')->orderBy('post_date','desc')->orderBy('create_at','desc')
                ->select('web_news_articles.*', 'web_news_categories.catname', 'web_news_categories.orderno');
		}
		
		if ( Input::has('kw') && Input::get('kw') != '' ) {
			# search
			$kw = Input::get('kw');
			$list_articles = $qResult
                ->where('title','like','%'.$kw.'%')
                ->orWhere('summary_text','like','%'.$kw.'%')
                ->orderBy('sticky','desc')->orderBy('post_date','desc')->orderBy('create_at','desc')
                ->paginate(Config::get('news.list_page_size'));
		}
		else {
			$list_articles = $qResult->paginate(Config::get('news.list_page_size'));
		}
		
		if ( !$list_articles || count($list_articles) == 0 ) {
			cUtils::set_app_message('Không có bài viết !!!', cUtils::WARNING_MSG);
		}
		
		return View::make('mod/news/admin/list_articles', array(
			'list_articles' => $list_articles,
			'catinfo' => $catinfo
		));
	}
	
	public function admin_createarticle($cat_id = 0) {
		# check permission
		if ( !$this->userinfo->is_access(array('admin_news','viet_bai_viet')) ) {
			return View::make('403')->with('message','Không có quyền truy cập !!!');
		}
	
		if ( Input::has('do_save') ) {
			$cat_id = Input::get('cboParentCat');
			$title = Input::get('txtTitle');
			$post_content = Input::get('txtContent');
			$post_date = Input::get('txtNgayDang');
			$sticky = (Input::has('chkSticky') ? Input::get('chkSticky') : 0);			
			$hot = (Input::has('chkHot') ? Input::get('chkHot') : 0);			
			
			# validate data
			$is_error = false;
			if ( $cat_id <= 0 ) {
				$is_error = true;
				cUtils::set_app_message('Chưa chọn danh mục !!!', cUtils::ERROR_MSG);
			}
			if ( empty($title) || $title == '' ) {
				$is_error = true;
				cUtils::set_app_message('Chưa nhập tiêu đề bài viết !!!', cUtils::ERROR_MSG);
			}
			if ( empty($post_content) || $post_content == '' ) {
				$is_error = true;
				cUtils::set_app_message('Chưa nội dung bài viết !!!', cUtils::ERROR_MSG);
			}
			
			//$post = explode(Config::get('news.summary_break'), $post_content);	// [0] = summary, [0]+[1] = full post
            //$post = preg_split('/<div class="my_summary" style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post_content);
            $post = preg_split('/<div style="summary-break: true"><span style="border-radius:0px">&nbsp;<\/span><\/div>/', $post_content);
			/*if ( count($post) != 2 ) {
				$is_error = true;
				cUtils::set_app_message('Nội dung bài viết phải có phần tóm lượt !!!', cUtils::ERROR_MSG);
			}*/
			if ( count($post) == 1 ) {
				# ko co phan summary
				array_splice($post, 0, 0, '');
			}
			
			if ( !$is_error ) {
				$post_date_array = null;
				if ( !empty($post_date) && $post_date != '' ) {
					$tmp = explode(' ', $post_date);	//[0] = ngay, [1] = gio
					$tmp1 = explode('/', $tmp[0]);
					if ( count($tmp) == 2 ) {
						$tmp2 = explode(':', $tmp[1]);
					}
					
					$post_date_array = array(
						'd' => @$tmp1[0],
						'm' => @$tmp1[1],
						'Y' => @$tmp1[2],
						'H' => @$tmp2[0],
						'i' => @$tmp2[1],
						's' => @$tmp2[2]
					);
					
					$post_date = mktime($post_date_array['H'], $post_date_array['i'], $post_date_array['s'], $post_date_array['m'], $post_date_array['d'], $post_date_array['Y']);
				}
				else {
					$post_date = time();
				}

                $html_tags_allow = Config::get('news.strip_tags_allow');
				
				$title = strip_tags($title);
				$summary_text = strip_tags($post[0], $html_tags_allow);
				$post_full_text = strip_tags($post_content, $html_tags_allow);
				
				$article = new Articles();
				$article->cat_id = $cat_id;
				$article->title = $title;
				//$article->title_seo = substr(cUtils::str_normalize($title,'-'),0,200);
				$article->summary_text = $summary_text;
				$article->summary_html = $post[0];
				$article->sticky = $sticky;
				$article->post_date = $post_date;
				$article->create_at = time();				
				$article->create_user = $this->userinfo->id;
				$article->daduyet = Config::get('news.default_daduyet');
				$article->published = Config::get('news.default_published');
				$article->hot = $hot;
				$article->notshowsummaryindetail = Input::get('chkNotShowSummaryInViewDetail');

				if ( $article->save() ) {
					# update title seo
					$article->title_seo = $article->id . '-' . substr(cUtils::str_normalize($title,'-',false,true),0,190);
					$article->save();
					# save detail
					$article_detail = new ArticleDetails();
					$article_detail->article_id = $article->id;
					$article_detail->full_content_text = $post_full_text;
					$article_detail->full_content_html = $post_content;
					
					if ( $article_detail->save() ) {
						cUtils::set_app_message('Lưu bài viết thành công !!!', cUtils::SUCCESS_MSG);
					
						#return Redirect::to('news/article/listarticle/'.$cat_id);
						return Redirect::to('news/view/'.$article->title_seo);
					}
					else {
						# xao bai viet vua dang
						$article->delete();
						
						cUtils::set_app_message('Lỗi khi lưu bài viết !!!', cUtils::ERROR_MSG);
					
						return Redirect::to('news/article/listarticle/'.$cat_id);
					}
				}
				else {
					cUtils::set_app_message('Lỗi khi lưu bài viết !!!', cUtils::ERROR_MSG);
					
					return Redirect::to('news/article/listarticle/'.$cat_id);
				}
			}
		}

		$cats_tree = Categories::getCatListAsTree_combobox();
		return View::make('mod/news/admin/article_form', array(
			'cats_tree' => $cats_tree,
			'cat_id' => $cat_id
		));
	}
	
	public function admin_editarticle($article_id) {
		// lay thong tin bai viet cu
		$article = Articles::find($article_id);
		if ( !$article ) {
			cUtils::set_app_message('Không tìm thấy thông tin bài viết (1) !!!', cUtils::ERROR_MSG);
					
			return Redirect::to('news/article/listarticle');
		}
		$article_full = ArticleDetails::find($article_id);
		if ( !$article_full ) {
			cUtils::set_app_message('Không tìm thấy thông tin bài viết (2) !!!', cUtils::ERROR_MSG);
					
			return Redirect::to('news/article/listarticle');
		}
		$cats_tree = Categories::getCatListAsTree_combobox();		
	
		if ( !$this->userinfo->is_access(array('admin_news','sua_bai_viet')) ) {
			# xem co phai la sua bai viet cua chinh mình khong
			if ( $this->userinfo->id != $article->create_user ) {
				return View::make('403')->with('message','Không có quyền truy cập !!!');
			}
		}
	
		if ( Input::has('do_save') && $article_id > 0 ) {
			# xu ly update
			$cat_id = Input::get('cboParentCat');
			$title = Input::get('txtTitle');
			$post_content = Input::get('txtContent');
			$post_date = Input::get('txtNgayDang');
			$sticky = (Input::has('chkSticky') ? Input::get('chkSticky') : 0);			
			$hot = (Input::has('chkHot') ? Input::get('chkHot') : 0);			
			
			# validate data
			$is_error = false;
			if ( $cat_id <= 0 ) {
				$is_error = true;
				cUtils::set_app_message('Chưa chọn danh mục !!!', cUtils::ERROR_MSG);
			}
			if ( empty($title) || $title == '' ) {
				$is_error = true;
				cUtils::set_app_message('Chưa nhập tiêu đề bài viết !!!', cUtils::ERROR_MSG);
			}
			if ( empty($post_content) || $post_content == '' ) {
				$is_error = true;
				cUtils::set_app_message('Chưa nội dung bài viết !!!', cUtils::ERROR_MSG);
			}

            //$post = preg_split('/<div class="my_summary" style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post_content);
            $post = preg_split('/<div style="summary-break: true"><span style="border-radius:0px">&nbsp;<\/span><\/div>/', $post_content);
			//$post = explode(Config::get('news.summary_break'), $post_content);	// [0] = summary, [0]+[1] = full post
			/*if ( count($post) != 2 ) {
				$is_error = true;
				cUtils::set_app_message('Nội dung bài viết phải có phần tóm lượt !!!', cUtils::ERROR_MSG);
			}*/
			if ( count($post) == 1 ) {
				# ko co phan summary
				array_splice($post, 0, 0, '');
			}
			
			if ( !$is_error ) {
				$post_date_array = null;
				if ( !empty($post_date) && $post_date != '' ) {
					$tmp = explode(' ', $post_date);	//[0] = ngay, [1] = gio
					$tmp1 = explode('/', $tmp[0]);
					if ( count($tmp) == 2 ) {
						$tmp2 = explode(':', $tmp[1]);
					}
					
					$post_date_array = array(
						'd' => @$tmp1[0],
						'm' => @$tmp1[1],
						'Y' => @$tmp1[2],
						'H' => @$tmp2[0],
						'i' => @$tmp2[1],
						's' => @$tmp2[2]
					);
					
					$post_date = mktime($post_date_array['H'], $post_date_array['i'], $post_date_array['s'], $post_date_array['m'], $post_date_array['d'], $post_date_array['Y']);
				}
				else {
					$post_date = time();
				}

                $html_tags_allow = Config::get('news.strip_tags_allow');
				
				$title = strip_tags($title);
				$summary_text = strip_tags($post[0], $html_tags_allow);
				$post_full_text = strip_tags($post_content, $html_tags_allow);
								
				$article->cat_id = $cat_id;
				$article->title = $title;
				$article->title_seo = $article->id . '-' . substr(cUtils::str_normalize($title,'-',false,true),0,190);
				$article->summary_text = $summary_text;
				$article->summary_html = $post[0];
				$article->sticky = $sticky;
				$article->post_date = $post_date;
				$article->hot = $hot;
				#$article->create_at = time();				
				#$article->create_user = Session::get('userinfo')->id;				
				$article->daduyet = Config::get('news.default_daduyet');	// reset trang thai duyet
				$article->published = Config::get('news.default_published');	// reset trang thai publish
                $article->notshowsummaryindetail = Input::get('chkNotShowSummaryInViewDetail');

				if ( $article->save() ) {
					# save detail
					$article_detail = ArticleDetails::find($article_id);
					$article_detail->article_id = $article->id;
					$article_detail->full_content_text = $post_full_text;
					$article_detail->full_content_html = $post_content;
					
					if ( $article_detail->save() ) {
						cUtils::set_app_message('Lưu bài viết thành công !!!', cUtils::SUCCESS_MSG);
					
						#return Redirect::to('news/article/listarticle/'.$article->cat_id);
						return Redirect::to('news/view/'.$article->title_seo);
					}
					else {
						# xao bai viet vua dang
						$article->delete();
						
						cUtils::set_app_message('Lỗi khi lưu bài viết !!!', cUtils::ERROR_MSG);
					
						return Redirect::to('news/article/listarticle/'.$article->cat_id);
					}
				}
				else {
					cUtils::set_app_message('Lỗi khi lưu bài viết !!!', cUtils::ERROR_MSG);
					
					return Redirect::to('news/article/listarticle/'.$article->cat_id);
				}
			}
		}				
		
		return View::make('mod/news/admin/article_form', array(
			'cats_tree' => $cats_tree,
			'cat_id' => $article->cat_id,
			'articleinfo' => $article,
			'articleinfo_full' => $article_full
		));
	}
	
	public function admin_sethot($article_id) {
        if ( !$this->userinfo->is_access(array('admin_news','viet_bai_viet', 'sua_bai_viet')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

		$articleinfo = Articles::find($article_id);
		
		$result = array();
		if ( $articleinfo ) {
			$articleinfo->hot = $articleinfo->hot == 1 ? 0 : 1;
			$articleinfo->save();
			
			$result = array(
				'code' => 0,
				'message' => $articleinfo->hot == 1 ? 'Thiết lập là tin nóng thành công !' : 'Bỏ thiết lập tin nóng thành công !'
			);
		}
		else {
			// article not found
			$result = array(
				'code' => -1,
				'message' => 'Không tìm thấy bài viết !!!'
			);
		}
		
		return $result;
	}
	
	public function admin_deletearticle($article_id) {
		$article = Articles::find($article_id);
		if ( !$article ) {
			cUtils::set_app_message('Không tìm thấy thông tin bài viết (1) !!!', cUtils::ERROR_MSG);
					
			return Redirect::to('news/article/listarticle');
		}
		else {
			$article_full = ArticleDetails::find($article_id);
			if ( !$article_full ) {
				cUtils::set_app_message('Không tìm thấy thông tin bài viết (2) !!!', cUtils::ERROR_MSG);
					
				return Redirect::to('news/article/listarticle');
			}
			else {
				// kiem tra quyen duoc xoa
				if ( !$this->userinfo->is_access(array('admin_news','xoa_bai_viet')) ) {
					# xem co phai la sua bai viet cua chinh mình khong
					if ( $this->userinfo->id != $article->create_user ) {
						return View::make('403')->with('message', 'Không có quyền truy cập !!!');
					}
				}
			
				// thuc hien xoa
				$article->delete();
				$article_full->delete();
				
				cUtils::set_app_message('Xóa bài viết thành công', cUtils::SUCCESS_MSG);
					
				return Redirect::to('news/article/listarticle');
			}
		}
	}
	
	public function admin_duyetbaiviet($article_id) {
		// su dung ajax
		// kiem tra quyen duyet bai viet
		if ( !$this->userinfo->is_access(array('admin_news','duyet_bai_viet')) ) {
			$result = array(
				'code' => -1,
				'message' => 'Không có quyền duyệt bài viết !!!'
			);
			
			return json_encode($result);
		}
		
		$article = Articles::find($article_id);
		if ( $article ) {
			$duyet= Input::get('duyet');
		
			$article->daduyet = $duyet;
			$article->user_duyet = $this->userinfo->id;
			$article->ngay_duyet = time();
			
			$result = array();
			if ( $article->save() ) {
				$result = array(
					'code' => 0,
					'message' => 'Duyệt bài viết thành công !'
				);
			}
			else {
				$result = array(
					'code' => -3,
					'message' => 'Duyệt bài viết không thành công !!!'
				);
			}
			return json_encode($result);
		}
		else {
			$result = array(
				'code' => -2,
				'message' => 'Không tìm thấy thông tin bài viết !!!'
			);
			return json_encode($result);
		}
	}
	
	public function admin_publishbaiviet($article_id) {
		// su dung ajax
		// kiem tra quyen xuat ban bai viet
		if ( !$this->userinfo->is_access(array('admin_news','xuat_ban_bai_viet')) ) {
			$result = array(
				'code' => -1,
				'message' => 'Không có quyền Publish bài viết !!!'
			);
			
			return json_encode($result);
		}
		
		$article = Articles::find($article_id);
		if ( $article ) {
			$publish = Input::get('publish');
		
			$article->published = $publish;
			$article->user_published = $this->userinfo->id;
			$article->ngay_published = time();
			
			$result = array();
			if ( $article->save() ) {
				$result = array(
					'code' => 0,
					'message' => 'Xuất bản bài viết thành công !'
				);
			}
			else {
				$result = array(
					'code' => -3,
					'message' => 'Xuất bản bài viết không thành công !!!'
				);
			}
			return json_encode($result);
		}
		else {
			$result = array(
				'code' => -2,
				'message' => 'Không tìm thấy thông tin bài viết !!!'
			);
			return json_encode($result);
		}
	}
	
	/************** user view *******************/
	public function view_article($article_title_seo) {
		$tmp = explode('-', $article_title_seo);	//[0] = article_id, [1] = title
		
		$article = Articles::find($tmp[0]);
		if ( !$article ) {
			// article not found
            return View::make('404');
		}
		else {
            $is_admin = false;
            if ( $this->userinfo ) {
                $is_admin = $this->userinfo->is_access(array('sua_bai_viet','xuat_ban_bai_viet','duyet_bai_viet'));
            }
            // kiem tra xem co duyet+publish chua
            if ( $article->daduyet != 1 && !$is_admin ) return View::make('404');
            if ( $article->published != 1 && !$is_admin ) return View::make('404');

            $message = '';
            if ( $article->daduyet != 1 || $article->published != 1 ) {
                $message = 'Bài viết chưa được duyệt hoặc chưa publish !!!';
            }

			$article_full = ArticleDetails::find($tmp[0]);
			$catinfo = Categories::find($article->cat_id);
			
			# lay cat tin khac cung chuyen muc
			$more_articles = DB::select('select * from '.$article->getTable().' where cat_id='.$catinfo->id.
				' and id<>'.$article->id.' and IFNULL(daduyet,0)=1 and IFNULL(published,0)=1 '.
				'order by sticky desc,post_date desc,create_at desc limit 0,'.Config::get('news.more_article_items'));

			return View::make('mod/news/viewarticle', array(
				'catinfo' => $catinfo,
				'articleinfo' => $article,
				'articleinfo_full' => $article_full,
				'more_articles' => $more_articles,
                'message' => $message
			));
		}
	}
	
	public function view_articlecat($cat_id) {
		$catinfo = Categories::find($cat_id);
		if ( $catinfo ) {
			$list_articles = DB::table('web_news_articles')
				->join('web_news_articles_full', 'web_news_articles.id', '=', 'web_news_articles_full.article_id')
				->where('cat_id','=',$cat_id)->where('daduyet','=',1)->where('published','=',1)
				->orderBy('sticky','desc')
                ->orderBy('post_date','desc')
                ->orderBy('create_at','desc')
				->select('web_news_articles.*', 'web_news_articles_full.full_content_text')
				->paginate(Config::get('news_common_cat_articleitems'));
		
			if ( !$list_articles || count($list_articles) == 0 ) {
				cUtils::set_app_message('Không có bài viết trong danh mục này !!!', cUtils::WARNING_MSG);
			}

			return View::make('mod/news/catarticles', array(
				'catinfo' => $catinfo,
				'list_articles' => $list_articles
			));
		}
		else {
			// cat not found
		}
	}
}
