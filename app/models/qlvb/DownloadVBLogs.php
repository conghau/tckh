<?php

class DownloadVBLogs extends Eloquent {
	protected $table = 'web_qlvb_downloadvb_logs';
	protected $primaryKey = 'downloadid';

    public $timestamps = false;
}