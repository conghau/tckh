<?php namespace Andheiberg\Messenger\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config;

class Participant extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'web_pm_participants';

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['conversation_id', 'user_id', 'user_username', 'user_displayname', 'last_read'];

	/**
	 * Conversation relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function conversation()
	{
		return $this->belongsTo('Andheiberg\Messenger\Models\Conversation');
	}

	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function user()
	{
		return $this->belongsTo(Config::get('messenger::user_model'));
	}

	public function scopeMe($query, $user = null)
	{
		$user = $user ?: \Auth::user()->id;

		return $query->where('user_id', '=', $user);
	}

	public function scopeNotMe($query, $user = null)
	{
		$user = $user ?: \Auth::user()->id;

		return $query->where('user_id', '!=', $user);
	}

}