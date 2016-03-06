<?php

use \ArticleDetails;

class Articles extends Eloquent {
	protected $table = 'web_news_articles';
	protected $primaryKey = 'id';

	public $timestamps = false;
	
	public static function getArticles(array $list_cat = null, $newest_items_number = 5) {	
		// lay tat ca bai viet trong cac chuyen muc
		if ( $list_cat == null || count($list_cat) == 0 ) {
			// lay tat ca cac chuyen muc
			$list_cat = DB::select('select * from web_news_categories order by orderno');
		}
		
		if ( $list_cat == null || count($list_cat) == 0 ) return array();
		
		$result = array();
		foreach ( $list_cat as $cat ) {
			// lay tim moi nhat
			$newest_articles = DB::select('select * from web_news_articles where cat_id='.
				$cat->id.' and IFNULL(daduyet,0)=1 and IFNULL(published,0)=1 order by sticky desc, post_date desc limit 0,'.$newest_items_number);
			if ( $newest_articles && count($newest_articles) > 0 ) {
				$cat->articles = array();
				
				foreach ( $newest_articles as $article ) {
					$cat->articles['article_'.$article->id] = $article;
				}
				
				$result['cat_'.$cat->id] = $cat;
			}
		}
		
		return $result;
	}

    /*
     * Lấy danh sách các danh mục + bài viết trong danh mục
     * @params:
     *  $num_article_show : số bài viết hiển thị phần tóm lượt
     *  $num_article_more : số bài viết hiển thi dạng link tiếp theo bài viết hiển thị phần tóm lượt
     * */
    public static function get_listcat_n_articles($num_article_show = 1, $num_article_more = 5)
    {
        $list_cats = DB::table('web_news_categories')
            ->orderBy('orderno')
            ->get();

        $data = array();
        foreach ( $list_cats as $cat ) {
            $article_show = DB::table('web_news_articles')
                ->join('web_news_articles_full','web_news_articles.id', '=', 'web_news_articles_full.article_id')
                ->where('cat_id', '=', $cat->id)
                ->whereRaw('IFNULL(daduyet,0)<>0 and IFNULL(published,0)<>0')
                ->orderBy('web_news_articles.sticky', 'desc')
                ->orderBy('web_news_articles.post_date', 'desc')
                ->take($num_article_show+$num_article_more)
                ->get();
            $cat->articles_show = $article_show;

            $data['cat_'.$cat->id] = $cat;
        }

        return $data;
    }

    /**
     * Lấy bài viết mới nhất
     *
     * @param int $num_articles
     * @param int $cat_id
     */
    public static function get_lastest_articles($num_articles = 5, $cat_id = 0) {
        $article_show = DB::table('web_news_articles')
            ->join('web_news_articles_full','web_news_articles.id', '=', 'web_news_articles_full.article_id');
        if ( $cat_id > 0 ) {
            $article_show = $article_show->where('cat_id', '=', $cat_id);
        }
        $article_show = $article_show->whereRaw('IFNULL(daduyet,0)<>0 and IFNULL(published,0)<>0')
            ->orderBy('web_news_articles.sticky', 'desc')
            ->orderBy('web_news_articles.post_date', 'desc')
            ->take($num_articles)
            ->get();

        return $article_show;
    }
}