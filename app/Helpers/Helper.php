<?php 
namespace App\Helpers;
use Hash, Validator, DB,Auth;
use App\Models\User;
class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function vendorRegistrationsCount($date = null, $added_by = null) {
    	$where = [];


    	if($added_by != null) {
    		$where['added_by_agent_user_id'] = $added_by;
    	}

    	$data = User::where('user_type', 'VND');
    	
    	if($date != null) {
    		$data = $data->whereDate('created_at', $date);
    	}

    	return $data->count();
    }


    public static function userRegistrationsCount($date = null, $added_by = null) {
        $where = [];


        if($added_by != null) {
            $where['added_by_agent_user_id'] = $added_by;
        }

        $data = User::where('user_type', 'USR');
        
        if($date != null) {
            $data = $data->whereDate('created_at', $date);
        }

        return $data->count();
    }
}