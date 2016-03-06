<?php

class UserRoles extends Eloquent {
	protected $table = 'web_users_roles';
	protected $primaryKey = 'id';

	public $timestamps = false;
}