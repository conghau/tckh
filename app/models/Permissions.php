<?php
class Permissions extends \Eloquent {
	protected $table = 'web_permissions';
	protected $primaryKey = 'id';

	public $timestamps = false;

    public static function listall()
    {
        $table = with(new Permissions())->getTable();
        $result = array();

        $list_mod = DB::table($table)
            ->select('mod_name')
            ->distinct()
            ->get();
        foreach ($list_mod as $mod) {
            $tmp = new stdClass();
            $tmp->mod_name = $mod->mod_name;
            $tmp->permissions = array();

            $perms = DB::table($table)
                ->where('mod_name', '=', $mod->mod_name)
                ->get();
            foreach ( $perms as $perm ) {
                $tmp->permissions[] = $perm;
            }

            $result[] = $tmp;
        }

        return $result;
    }
}