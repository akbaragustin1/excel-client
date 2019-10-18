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
                SELECT details_file.* FROM master_file
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
    public static function getIDsExisting($firstDate,$endDate,$ids){
        $search = Input::get('search');
        $where = "";
        if (!empty($search['value'])){
            $value = $search['value'];
            $where .= " WHERE data2.nama_investor  like '%".$value."%'";
        }  
        $whereIn = "";
        if (count($ids) > 0) {
            $whereIn .= "WHERE d2.no NOT IN (".implode(',',$ids).")";
        }
        $query = "SELECT d1.jumlah as jumlah_lawan,data2.jumlah, data2.id,
        CASE
            WHEN d1.jumlah > data2.jumlah THEN 'h'
            ELSE 'k'
        END AS status_jumlah,
        (d1.jumlah - data2.jumlah) as hasil_kurang,
        data2.no,
        data2.nama_investor,
        data2.nomor_rekening,
        data2.nomor_sid
    FROM master_file m1
        LEFT JOIN details_file d1 ON d1.id_master = m1.id and m1.date = '".$endDate."'
        INNER JOIN  (SELECT d2.*,m2.date as datem2,m2.id as idm2 FROM master_file m2
Left JOIN details_file d2 on d2.id_master = m2.id and m2.date = '".$firstDate."' ".$whereIn.") data2 ON data2.no = d1.no AND data2.jumlah != d1.jumlah
    ".$where."
";
    $listData = \DB::select($query);
    return $listData;
    }


}
