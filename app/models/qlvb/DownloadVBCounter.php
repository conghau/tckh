<?php

class DownloadVBCounter extends Eloquent {
	protected $table = 'web_qlvb_downloadvb_counter';
	protected $primaryKey = 'counterid';

    public $timestamps = false;
}