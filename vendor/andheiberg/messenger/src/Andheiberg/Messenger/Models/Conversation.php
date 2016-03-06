<?php namespace Andheiberg\Messenger\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config;

class Conversation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'web_pm_conversations';

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['subject', 'conv_type'];

	/**
	 * Messages relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('Andheiberg\Messenger\Models\Message');
	}

	/**
	 * Participants relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function participants()
	{
		return $this->hasMany('Andheiberg\Messenger\Models\Participant');
	}

	public function scopeForUser($query, $user = null)
	{
		$user = $user ?: \Auth::user()->id;

		return $query->join('web_pm_participants', 'web_pm_conversations.id', '=', 'web_pm_participants.conversation_id')
		->where('web_pm_participants.user_id', $user)
		->select('web_pm_conversations.*');
	}

	public function scopeWithNewMessages($query, $user = null)
	{
		$user = $user ?: \Auth::user()->id;

		return $query->join('web_pm_participants', 'web_pm_conversations.id', '=', 'web_pm_participants.conversation_id')
		->where('web_pm_participants.user_id', $user)
		->where('web_pm_conversations.updated_at', '>', \DB::raw('web_pm_participants.last_read'))
		->select('web_pm_conversations.*');
	}

	public function participantsString($user = null)
	{
		$user = $user ?: \Auth::user()->id;

		$participantNames = \DB::table('web_users')
		->join('web_pm_participants', 'web_users.id', '=', 'web_pm_participants.user_id')
		->where('web_users.id', '!=', $user)
		->where('web_pm_participants.conversation_id', $this->id)
		->select(\DB::raw("concat(web_users.first_name, ' ', web_users.last_name) as name"))
		->lists('web_users.name');

		return implode(', ', $participantNames);
	}

	/**
	 * addUser
	 *
	 * adds users to this conversation
	 *
	 * @param array $participantEmails list of all participants
	 * @return void
	 */
	public function addParticipants(array $participants)
	{
		$userModel = Config::get('messenger::user_model');
		$userModel = new $userModel;

		$participant_ids = [];

		if (is_array($participants))
		{
			if (is_numeric($participants[0]))
			{
				$participant_ids = $participants;
			}
			else
			{
				$participant_ids = $userModel->whereIn('email', $participants)->lists('id');
			}
		}
		else
		{
			if (is_numeric($participants))
			{
				$participant_ids = [$participants];
			}
			else
			{
				$participant_ids = $userModel->where('email', $participants)->lists('id');
			}
		}

		if(count($participant_ids))
		{
			foreach ($participant_ids as $user_id)
			{
				Participant::create([
					'user_id' => $user_id,
					'conversation_id' => $this->id,
				]);
			}
		}
	}

}