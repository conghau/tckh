<?php

class LoginLogs extends Eloquent {
    protected $connection = 'sislogs';
	protected $table = 'login_request';
	protected $primaryKey = 'logid';

	public $timestamps = true;

}