<?php
class CatController extends BaseController {
	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
			))
		);
	
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
	
	public function admin_index() {
		return $this->admin_listcat();
	}
	
	public function admin_listcat($parent_cat_id = 0) {
		$cats = null;
		if ( $parent_cat_id == 0 ) {
			$cats = Categories::getRootCatList();
			
			return View::make('mod/news/admin/listcat', array(
				'cats' => $cats
			));
		}
		else {
			# ajax
			$cats = Categories::where('parent_id', '=', $parent_cat_id)->get();
			return json_encode(array(
				'code' => 0,
				'data' => $cats
			));
		}		
	}
	
	public function admin_createcat($parent_cat_id = 0) {
		// kiem tra quyen
		if ( !$this->userinfo->inRoleByRoleCode('them_chuyen_muc') ) {
			cUtils::set_app_message('Không có quyền truy cập !!!', cUtils::ERROR_MSG);
			
			return Redirect::to('/news/cat/listcat');
		}
	
		if ( Input::has('do_save') ) {
			$cat = new Categories();
			$cat->catname = Input::get('txtCatName');
			$cat->catdesc = Input::get('txtDesc');
			$cat->parent_id = Input::get('cboParentCat');
			if ( $cat->save() ) {
				# update child count
				if ( Input::has('cboParentCat') ) {
					$countcat = DB::select('select * from '.$cat->getTable().' where IFNULL(parent_id,0) = '.$cat->parent_id);
					$cnt = ($countcat ? count($countcat) : 0);
					DB::update('update '.$cat->getTable().' set childcount='.$cnt.
							' where id = '.$cat->parent_id);
				}
				cUtils::set_app_message('Lưu chuyên mục thành công !', cUtils::SUCCESS_MSG);
				
				return Redirect::to('news/cat/listcat');
			}
			else {
				cUtils::set_app_message('Lưu chuyên mục lỗi !', cUtils::ERROR_MSG);
			}
		}

		$cats_tree = Categories::getCatListAsTree_combobox();
		
		return View::make('mod/news/admin/cat_form', array(
			'cats_tree' => $cats_tree,
			'parent_cat_id' => $parent_cat_id
		));
	}
	
	public function admin_editcat($cat_id) {
		# lay thong tin cat
		$catinfo = Categories::find($cat_id);
		if ( !$catinfo ) {
			cUtils::set_app_message('Không tìm thấy thông tin chuyên mục !', cUtils::ERROR_MSG);
			return Redirect::to('news/cat/listcat');
		}
		
		// kiem tra quyen
		if ( !$this->userinfo->inRoleByRoleCode('sua_chuyen_muc') ) {
			# xem co phai la sua bai viet cua chinh mình khong
			if ( $this->userinfo->id != $catinfo->create_user ) {
				cUtils::set_app_message('Không có quyền truy cập !!!', cUtils::ERROR_MSG);
			
				return Redirect::to('news/cat/listcat');
			}
		}
	
		if ( Input::has('do_save') ) {
			$old_parent_id = -1;
			if ( $catinfo->parent_id != Input::get('cboParentCat') ) {
				// co chuyen cat
				$old_parent_id = $catinfo->parent_id;
			}		
		
			$catinfo->catname = Input::get('txtCatName');
			$catinfo->catdesc = Input::get('txtDesc');
			$catinfo->parent_id = Input::get('cboParentCat');
			if ( $catinfo->save() ) {
				# update child count
				if ( Input::has('cboParentCat') ) {
					$countcat = DB::select('select * from '.$catinfo->getTable().' where IFNULL(parent_id,0) = '.$catinfo->parent_id);
					$cnt = ($countcat ? count($countcat) : 0);
					DB::update('update '.$catinfo->getTable().' set childcount='.$cnt.
							' where id = '.$catinfo->parent_id);
					
					if ( $old_parent_id > 0 ) {
						// update lai cat cu
						$countcat = DB::select('select * from '.$catinfo->getTable().' where IFNULL(parent_id,0) = '.$old_parent_id);
						$cnt = ($countcat ? count($countcat) : 0);
						DB::update('update '.$catinfo->getTable().' set childcount='.$cnt.
								' where id = '.$old_parent_id);
					}
				}
			
				cUtils::set_app_message('Lưu chuyên mục thành công !', cUtils::SUCCESS_MSG);
				
				return Redirect::to('news/cat/listcat');
			}
			else {
				cUtils::set_app_message('Lưu chuyên mục lỗi !', cUtils::ERROR_MSG);
				
				return Redirect::to('news/cat/listcat');
			}
		}
		
		$cats_tree = Categories::getCatListAsTree_combobox();
		
		return View::make('mod/news/admin/cat_form', array(
			'cats_tree' => $cats_tree,
			'parent_cat_id' => $catinfo->parent_id,
			'catinfo' => $catinfo
		));
	}
	
	public function admin_deletecat($cat_id) {
		$catinfo = Categories::find($cat_id);
		if ( $catinfo ) {
			// kiem tra quyen
			if ( !$this->userinfo->inRoleByRoleCode('xoa_chuyen_muc') ) {
				# xem co phai la sua bai viet cua chinh mình khong
				if ( $this->userinfo->id != $catinfo->create_user ) {
					cUtils::set_app_message('Không có quyền truy cập !!!', cUtils::ERROR_MSG);
				
					return Redirect::to('news/cat/listcat');
				}
			}
		
			Categories::deleteCat($catinfo->id);
			
			cUtils::set_app_message('Xóa chuyên mục thành công !', cUtils::SUCCESS_MSG);
			return Redirect::to('news/cat/listcat');
		}
		else {
			cUtils::set_app_message('Không tìm thấy thông tin chuyên mục !', cUtils::ERROR_MSG);
			return Redirect::to('news/cat/listcat');
		}
	}
}
