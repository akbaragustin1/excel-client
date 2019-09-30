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

}
