<?php
namespace Roles;

class Roles extends Eloquent {
	protected $table = 'web_roles';
	protected $primaryKey = 'id';

	public $timestamps = false;
}