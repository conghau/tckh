<?php
namespace App\Models\Menu;

class Menu extends Eloquent {
	protected $table = 'web_menus';
	protected $primaryKey = 'id';

	public $timestamps = false;
	
	public static function getMenuTree_ComboBox($menu_id = 0) {
		$tablename = with(new Menu())->getTable();
		
		$menus = null;
		if ( $menu_id == 0 ) {
			# get all cats
			$menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0)=0 order by orderno');
		}
		else {
			$menus = DB::select('select * from '.$tablename.' where id = ?', array($menu_id));
		}
		
		$html = '';
		$tree_level = 0;
		foreach ( $menus as $menu ) {
			$html .= '<option value="'.$menu->id.'">'.$menu->title.'</option>';
		
			Menu::getSubMenu_ComboBox($menu->id, $html, $tree_level, $tablename);
		}
		
		return $html;
	}
	
	private static function getSubMenu_ComboBox($parent_menu_id, &$html, &$tree_level, $tablename) {
		if ( !$parent_menu_id ) $parent_menu_id = 0;
	
		$sub_menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$parent_menu_id.' order by orderno');
		
		$tree_level++;
		$padding_str = '';
		for ( $i=0; $i<$tree_level; $i++ ) {
			$padding_str .= '|' . str_repeat('-',4);
		}
		
		if ( $sub_menus && count($sub_menus) > 0 ) {
			foreach ( $sub_menus as $sub_menu ) {
				$html .= '<option value="'.$sub_menu->id.'">'.$padding_str.$sub_menu->title.'</option>';
						
				Menu::getSubMenu_ComboBox($sub_menu->id, $html, $tree_level, $tablename);
			}
		}
		$tree_level--;
	}
	
	public static function getMenuTree_UL($menu_id = 0) {
		$tablename = with(new Menu())->getTable();
		
		$menus = null;
		if ( $menu_id == 0 ) {
			# get all cats
			$menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0)=0 order by orderno');
		}
		else {
			$menus = DB::select('select * from '.$tablename.' where id = ?', array($menu_id));
		}
		
		$html = '<ul class="unstyled mul">';
		$tree_level = 0;
		foreach ( $menus as $menu ) {
			$html .= '<li>'.
				'<div class="m_menu_action">'.
				'<a href="javascript:;" onclick="mod_menu_do_add_newmenu(\''.$menu->id.'\')"><span class="icon-plus tip" title="Thêm"></span></a>&nbsp;&nbsp;&nbsp;'.
				'<a href="javascript:;" onclick="mod_menu_do_edit_newmenu('.$menu->id.')"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;&nbsp;'.
				'<a href="javascript:;" onclick="mod_menu_do_del_menu('.$menu->id.')"><span class="icon-remove tip" title="Xóa"></span></a> '.
				'</div> ';
			if ( $menu->link != '#' && $menu->link != '' ) {
				$html .= '<a target="_blank" href="'.url($menu->link).'">'.$menu->title.'</a>';
			}
			else {
				$html .= $menu->title;
			}
		
			Menu::getSubMenu_UL($menu->id, $html, $tree_level, $tablename);
			
			$html .= '</li>';
		}
		$html .= '</ul>';

        # script delete menu


		return $html;
	}
	
	private static function getSubMenu_UL($parent_menu_id, &$html, &$tree_level, $tablename) {
		if ( !$parent_menu_id ) $parent_menu_id = 0;
	
		$sub_menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$parent_menu_id.' order by orderno');
		
		$tree_level++;
		$padding_str = '';
		for ( $i=0; $i<$tree_level; $i++ ) {
			$padding_str .= '|' . str_repeat('-',4);
		}
		
		if ( $sub_menus && count($sub_menus) > 0 ) {
			$html .= '<ul class="unstyled">';
			foreach ( $sub_menus as $sub_menu ) {
				$html .= '<li>'.
					'<div class="m_menu_action">'.
					'<a href="javascript:;" onclick="mod_menu_do_add_newmenu('.$sub_menu->id.')"><span class="icon-plus tip" title="Thêm"></span></a>&nbsp;&nbsp;&nbsp;'.
					'<a href="javascript:;" onclick="mod_menu_do_edit_newmenu('.$sub_menu->id.')"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;&nbsp;'.
					'<a href="javascript:;" onclick="mod_menu_do_del_menu('.$sub_menu->id.')"><span class="icon-remove tip" title="Xóa"></span></a> '.
					'</div> ';
					
				if ( $sub_menu->link != '#' && $sub_menu->link != '' ) {
					$html .= '<a target="_blank" href="'.url($sub_menu->link).'">'.$sub_menu->title.'</a>';
				}
				else {
					$html .= $sub_menu->title;
				}
					
				Menu::getSubMenu_UL($sub_menu->id, $html, $tree_level, $tablename);
				
				$html .= '</li>';
			}
			$html .= '</ul>';
		}
		$tree_level--;
	}
	
	public static function deleteMenu($menu_id) {
		$tablename = with(new Menu())->getTable();
		
		$menuinfo = Menu::find($menu_id);
		if ( $menuinfo ) {			
			Menu::deleteSubMenu($menuinfo->id, $tablename);
			$menuinfo->delete();
		}
	}
	
	private static function deleteSubMenu($parent_menu_id, $tablename) {
		$sub_menus = Menu::where('parent_id', '=', $parent_menu_id)->get();
		foreach ( $sub_menus as $sub_menu ) {
			Menu::deleteSubMenu($sub_menu->id, $tablename);
			$sub_menu->delete();			
		}
	}
}