<?php
namespace App\Models\News;
use Eloquent;
class Categories extends Eloquent {
	protected $table = 'web_news_categories';
	protected $primaryKey = 'id';

	public $timestamps = false;
	
	public static function getRootCatList() {
		return DB::select('select * from '.with(new Categories())->getTable().' where IFNULL(parent_id,0) = ?', array(0));
	}
	
	public static function getCatListAsTree_combobox($cat_id = 0) {
		$tablename = with(new Categories())->getTable();
	
		$cats = null;
		if ( $cat_id == 0 ) {
			# get all cats
			$cats = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0)=0 order by orderno');
		}
		else {
			$cats = DB::select('select * from '.$tablename.' where id = ?', array($cat_id));
		}

		$html = '';
		$tree_level = 0;
		foreach ( $cats as $cat ) {
			$html .= '<option value="'.$cat->id.'">'.$cat->catname.'</option>';
		
			Categories::getSubCatList($cat->id, $html, $tree_level, $tablename);
		}
		
		return $html;
	}
	
	private static function getSubCatList($parent_cat_id, &$html, &$tree_level, $tablename) {
		if ( !$parent_cat_id ) $parent_cat_id = 0;
	
		$sub_cats = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$parent_cat_id.' order by orderno');
		
		$tree_level++;
		$padding_str = '';
		for ( $i=0; $i<$tree_level; $i++ ) {
			$padding_str .= '|' . str_repeat('-',4);
		}
		
		foreach ( $sub_cats as $sub_cat ) {
			$html .= '<option value="'.$sub_cat->id.'">'.$padding_str . $sub_cat->catname.'</option>';
			Categories::getSubCatList($sub_cat->id, $html, $tree_level, $tablename);
		}
		$tree_level--;
	}
	
	public static function deleteCat($cat_id) {
		$tablename = with(new Categories())->getTable();
		
		$catinfo = Categories::find($cat_id);
		if ( $catinfo ) {			
			Categories::deleteSubCat($catinfo->id, $tablename);
			$catinfo->delete();
			
			// xoa cai bai viet thuoc cat
			$articles = DB::table('web_news_articles')
				->where('cat_id','=',$cat_id)
				->get();
			foreach ( $articles as $article ) {
				DB::delete('delete from web_news_articles where id='.$article->id);
				// xoa bai viet full
				DB::delete('delete from web_news_articles_full where article_id='.$article->id);
			}			

			// update childcount
			if ( $catinfo->parent_id ) {
				$countcat = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$catinfo->parent_id);
				$cnt = ($countcat ? count($countcat) : 0);
				DB::update('update '.$tablename.' set childcount='.$cnt.
						' where id = '.$catinfo->parent_id);
			}
		}
	}
	
	private static function deleteSubCat($parent_cat_id, $tablename) {
		$sub_cats = Categories::where('parent_id', '=', $parent_cat_id)->get();
		foreach ( $sub_cats as $sub_cat ) {
			Categories::deleteSubCat($sub_cat->id, $tablename);
			$sub_cat->delete();
			
			// xoa cai bai viet thuoc cat
			$articles = DB::table('web_news_articles')
				->where('cat_id','=',$sub_cat->id)
				->get();
			foreach ( $articles as $article ) {
				DB::delete('delete from web_news_articles where id='.$article->id);
				// xoa bai viet full
				DB::delete('delete from web_news_articles_full where article_id='.$article->id);
			}	
			
			// update childcount
			$countcat = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$sub_cat->parent_id);
			$cnt = ($countcat ? count($countcat) : 0);
			DB::update('update '.$tablename.' set childcount='.$cnt.
					' where id = '.$sub_cat->parent_id);
		}
	}
}