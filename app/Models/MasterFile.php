<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class MasterFile extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'master_file';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','file_name','created_at','date'];

}
