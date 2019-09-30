<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Users extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'email', 'phone_number', 'created_at', 'updated_at','position_id','password','date_payday'];

     public static function getAll()
    {

        $input = Input::get('search.value');
        $get = Input::all();
       
        $where = "";
        if (!empty($get['email']) && !empty($get['password'])) {
            if (!empty($where)) {
                $where .= " and users.email  = '".$get['email']."'";
                $where .= " adn users.password = '".md5($get['password'])."' ";
            } else {
                $where .= " WHERE users.email = '".$get['email']."' ";
                $where .= " and users.password  = '".md5($get['password'])."' ";
            }
        }

        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if (!empty($start) AND !empty($length)) {
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select users.id,users.name,users.email,users.phone_number,users.created_at,users.updated_at from users
                ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
    public static function getByID($id)
    {
        $where = "where users.id = '".$id."'";
        $query = " select users.password,users.id,users.name,users.email,users.phone_number,users.created_at,users.updated_at from users
                    ".$where."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
    
}
