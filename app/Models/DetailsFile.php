<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class DetailsFile extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'details_file';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'no', 'tanggal', 'nama_investor', 'nomor_rekening', 'nomor_ktp','npwp','passport','alamat_1','alamat_2','la','status_investor','kewarganegaraan','tingkat_pajak_corp','tingkat_pajak_mtn','nama_pemegang_rekening','kode_pemegang_rekening','jumlah','status_rekening','status_balance','percentage','created_at','id_master','nomor_sid','tingkat_pajak_equi'];

    public static function getAll($status)
    {
        $where = "";
        $search = Input::get('search');
       
        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if ($status) {
            if (isset($start) AND isset($length)) {
                $limit  = "LIMIT ".$length." OFFSET ".$start;
            }
        }
        if (!empty($search['value'])){
            $value = $search['value'];
            $where .= " AND details_file.nama_investor  like '%".$value."%'";
        }  
        $query = " select * from master_file
					Left JOIN details_file on details_file.id_master = master_file.id
                    where master_file.date = '".date("Y-m-d")."'
                ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
      	 return $listData;
    }
    public static function getCount()
    {
        $search = Input::get('search');
       
        $where = "";

        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if (!empty($search['value'])){
            $value = $search['value'];
            $where .= " AND details_file.nama_investor  like '%".$value."%'";
        }  
        $query = " select count(*) as count from master_file
					Left JOIN details_file on details_file.id_master = master_file.id
                    where master_file.date = '".date("Y-m-d")."'
                ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
      	 return $listData;
    }
    public static function getCompare($firstDate,$endDate,$status){
        $search = Input::get('search');
        $where = "";
        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if ($status) {
            if (isset($start) AND isset($length)) {
                $limit  = "LIMIT ".$length." OFFSET ".$start;
            }
        }
        if (!empty($search['value'])){
            $value = $search['value'];
            $where .= " AND details_file.nama_investor  like '%".$value."%'";
        }  
        $query = "					
                SELECT * FROM master_file
                Left JOIN details_file on details_file.id_master = master_file.id
                WHERE master_file.date = '".$firstDate."' AND details_file.no NOT IN (SELECT details_file.no FROM master_file
                Left JOIN details_file on details_file.id_master = master_file.id
                WHERE master_file.date = '".$endDate."') ".$where." ".$limit."";
        $listData = \DB::select($query);
        return $listData;
    }
    public static function  getCountByMonth(){
        $result = array();
        for ($x = 1; $x <= 31; $x++) {
            $monthYears = date('Y-m-');
          $monthYears .= $x;
          $query = "SELECT COUNT(*) as total FROM master_file  Left JOIN details_file on details_file.id_master = master_file.id where date ='".$monthYears."' ";
         // print_r($query);die;
          $listData = \DB::select($query);
          $result[] = $listData[0]->total;
        }
     return $result;

    }

}
