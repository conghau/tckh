<?php

class LoginedAllRequestLogs extends Eloquent {
    protected $connection = 'sislogs';
	protected $table = 'all_request_after_logined';
	protected $primaryKey = 'logid';

	public $timestamps = true;

}