<?php
class ArticleDetails extends Eloquent {
	protected $table = 'web_news_articles_full';
	protected $primaryKey = 'article_id';

	public $timestamps = false;
}