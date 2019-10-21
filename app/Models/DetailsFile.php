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
        if (!empty($search['status_jumlah'])) {
        $where .= "  AND ( CASE
                        WHEN a.jumlah = 0 THEN 'm'
            WHEN b.jumlah > a.jumlah THEN 'k'	
            WHEN  b.jumlah < a.jumlah THEN 'h'
                        WHEN b.jumlah = a.jumlah THEN 'g'
                        else 'b'
                        END ) = 'm' ";
        }  
        $query = " SELECT 
        b.jumlah as jumlah_lawan,
     a.jumlah,
     a.id,
    CASE
                    WHEN a.jumlah = 0 THEN 'm'
        WHEN b.jumlah > a.jumlah THEN 'k'	
        WHEN  b.jumlah < a.jumlah THEN 'h'
                    WHEN b.jumlah = a.jumlah THEN 'g'
                    else 'b'		
    END AS status_jumlah,
    (a.jumlah - b.jumlah) as hasil_kurang,
    a.no,
    a.nama_investor,
    a.nomor_rekening,
    a.nomor_sid
     FROM details_file a
        LEFT JOIN (SELECT * FROM details_file d2 WHERE d2.id_master IN (SELECT id FROM master_file WHERE date = '".$endDate."')) b ON b.no = a.no 
    WHERE a.id_master IN (SELECT id FROM master_file WHERE date = '".$firstDate."')
                    ".$where." ".$limit."
                    ";
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
    public static function getIDsExisting($firstDate,$endDate,$ids,$status){
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
            $where .= " WHERE data2.nama_investor  like '%".$value."%'";
        }  
        $whereIn = "";
        if (count($ids) > 0) {
            $whereIn .= "WHERE d2.no NOT IN (".implode(',',$ids).")";
        }
        $query = "SELECT d1.jumlah as jumlah_lawan,data2.jumlah, data2.id,
        CASE
						WHEN data2.jumlah = 0 THEN 'm'
            WHEN d1.jumlah > data2.jumlah THEN 'k'	
            WHEN  d1.jumlah < data2.jumlah THEN 'h'	
						else 'g'
        END AS status_jumlah,
        (data2.jumlah -d1.jumlah) as hasil_kurang,
        data2.no,
        data2.nama_investor,
        data2.nomor_rekening,
        data2.nomor_sid
    FROM master_file m1
        LEFT JOIN details_file d1 ON d1.id_master = m1.id and m1.date = '".$endDate."'
        INNER JOIN  (SELECT d2.*,m2.date as datem2,m2.id as idm2 FROM master_file m2
Left JOIN details_file d2 on d2.id_master = m2.id and m2.date = '".$firstDate."' ".$whereIn.") data2 ON data2.no = d1.no
    ".$where." ".$limit."
";
    $listData = \DB::select($query);
    return $listData;
    }


}
