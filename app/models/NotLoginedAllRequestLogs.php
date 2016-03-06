<?php

class NotLoginedAllRequestLogs extends Eloquent {
    protected $connection = 'sislogs';
	protected $table = 'all_request_not_logined';
	protected $primaryKey = 'logid';

	public $timestamps = true;

}