<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\DetailsFile as DF;
use App\Models\MasterFile as MF;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Response;
use DB;
class investorController extends Controller
{

    private $parser = array();

    public function index()
    {
        // $users = US::getAll();
        // $data['users'] = json_decode(json_encode($users), true);
       
        return view('admin/investor/investor');
    }
    public function create() {
        $rules=[
            'tanggal'=>'required',
            'file'=>'required'
             ];
        $messages=[
            'tanggal.required'=>config('constants.ERROR_JML_WAJIB'),
            'file.required'=>config('constants.ERROR_JML_WAJIB')
        ];
        $validator=Validator::make(Input::all(), $rules, $messages);
        if ($validator->passes()) {
            //get Data session for creator
            if (!empty(Input::get('id'))) {
                //this is update employe
            $return =$this->update(Input::all());
            return $return;
            }else {
            $return = $this->save(Input::all());
            return $return;
            }
        $return['status'] = false;
        $return['messages'] =$validator;
        $return['data'] =[];
        return $return;
    }
}
    public function save($data) {
        //validation
         $mf = MF::where("date",date('Y-m-d',strtotime($data['tanggal'])))->get()->toArray();
        if (!empty($mf)) {
            $validator = 'data pada tanggal tersebut sudah tersedia';
            $return['status'] = false;
            $return['messages'] =$validator;
            $return['data'] =[];
            return $return;
        }
        $tampung = array();
        $data =Excel::load(Input::file('file'))->get();  
        if ($data->count() > 0){
            try {
                $masterFile = new MF;
                $masterFile->file_name = Input::file('file')->getClientOriginalName();
                $masterFile->created_at = date('Y-m-d H:i:s');
                $masterFile->date = date('Y-m-d',strtotime(Input::get('tanggal')));
                $masterFile->save();
                $id_master = $masterFile->id;
                foreach($data->toArray() as $key => $sheet) {
                  
                    $detailFile = new DF;
                    $detailFile->no = $sheet['no'];
                    $detailFile->passport = $sheet['passport'];
                    $detailFile->tanggal = $sheet['tanggal'];
                    $detailFile->nama_investor = $sheet['nama_investor'];
                    $detailFile->nomor_rekening = $sheet['nomor_rekening'];
                    $detailFile->id_master = $id_master;
                    $detailFile->created_at = date('Y-m-d H:i:s');
                    $detailFile->tanggal = date('Y-m-d',strtotime($sheet['tanggal']));
                    $detailFile->nomor_ktp = $sheet['nomor_ktp'];
                    $detailFile->npwp = $sheet['npwp'];
                    $detailFile->alamat_1 = $sheet['alamat_1'];
                    $detailFile->alamat_2 = $sheet['alamat_2'];
                    $detailFile->la = $sheet['la'];
                    $detailFile->status_investor = $sheet['status_investor'];
                    $detailFile->kewarganegaraan = $sheet['kewarganegaraan'];
                    $detailFile->tingkat_pajak_corp = $sheet['tingkat_pajak_corp'];
                    $detailFile->tingkat_pajak_mtn = $sheet['tingkat_pajak_mtn'];
                    $detailFile->kode_pemegang_rekening = $sheet['kode_pemegang_rekening'];
                    $detailFile->nama_pemegang_rekening = $sheet['nama_pemegang_rekening'];
                    $detailFile->jumlah = floatval($sheet['jumlah']);
                    $detailFile->status_rekening = $sheet['status_rekening'];
                    $detailFile->status_balance = $sheet['status_balance'];
                    $detailFile->percentage =$sheet['percentage'];
                    $detailFile->nomor_sid = $sheet['nomor_sid'];
                    $detailFile->tingkat_pajak_equi = $sheet['tingkat_pajak_equi'];
                    $detailFile->save();
                }
                    DB::commit();
                    $validator = 'transaksi anda berhasil';
                    $return['status'] = true;
                    $return['messages'] =$validator;
                    $return['data'] =[];
                    return $return;
             }catch (\Exception $e) {
                DB::rollBack();
                $json['status'] = false;
                $json['messages'] = 'Failed';
                $json['data'] = [];
             }
        }
    }
    private function uploadfile($fn)
    {
        if (!empty(Input::file($fn))) {
            $file = Input::file($fn)->isValid();
            $destinationPath = public_path().'/uploads/'.$fn;
            $extension =Input::file($fn)->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'.'.$extension;
            Input::file($fn)->move($destinationPath, $fileName);
            return $fileName;
        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $queryCount =DF::getCount(false);
        
        // ======= count ===== //
        // $total =count($queryCount);
        // print_r();die;
        // ======= count ===== //
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$queryCount[0]->count;
        $output['data']=array();
        $list = [];
        $query =DF::getAll(true);
        foreach ($query as $key => $row) {
            // $start = date('d-m-Y H:i:s',strtotime($row->start_tgl_rapat));
            // $end = date('d-m-Y H:i:s',strtotime($row->end_tgl_rapat));
            $json['no'] = $row->no;
            $json['id'] = $row->id;
            $json['nama_investor'] = $row->nama_investor;
            $json['nomor_ktp'] = $row->nomor_ktp;
            $json['npwp'] = $row->npwp;
            $json['kewarganegaraan'] = $row->kewarganegaraan;
            $list[] = $json;
        }
        $output['data']  = $list;
        echo json_encode($output);
    }  
    public function compareindexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $queryCount =DF::getCompare(date("Y-m-d",strtotime(Input::get('tanggal'))),date("Y-m-d",strtotime(Input::get('tanggal2'))),false);
         // ======= count ===== //
         $total =count($queryCount);
          // print_r();die;
          // ======= count ===== //
        $output=array();
        $output['draw']=$draw;
         $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $list = [];
      
        $query =DF::getCompare(date("Y-m-d",strtotime(Input::get('tanggal'))),date("Y-m-d",strtotime(Input::get('tanggal2'))),true);
        foreach ($query as $key => $row) {
            $json['no'] = $row->no;
            $json['id'] = $row->id;
            $json['nama_investor'] = $row->nama_investor;
            $json['nomor_sid'] = $row->nomor_sid;
            $json['nomor_rekening'] = $row->nomor_rekening;
            $json['jumlah'] = $row->jumlah;
            $json['perubahan_jumlah'] = $row->hasil_kurang;
            $json['status_jumlah'] = $row->status_jumlah;
            $json['jumlah_lawan'] = $row->jumlah_lawan;
            $json['nama_pemegang_rekening'] = $row->nama_pemegang_rekening;
            $json['status_rekening'] = $row->status_rekening;
            $list[] = $json; 
        }  
        $first_date =date('d F Y',strtotime(Input::get('tanggal')));
        $output['first_date'] = $first_date; 
        $output['data']  = $list;
        echo json_encode($output);
    }    
    public function compareIndex(){
        return view('admin/investor/investorCompare');
    }
    public function generateExcel()
    {   
        $data =DF::getExcelData(date("Y-m-d",strtotime(Input::get('tanggal'))),date("Y-m-d",strtotime(Input::get('tanggal2'))),false);
        $first_date =date('d F Y',strtotime(Input::get('tanggal')));
        $data =json_decode(json_encode($data), true);
        $result['data']= $data;
        $result['first_date'] = $first_date;
        return view('admin/investor/exportExcel',$result);
    }
    public function countByDateForGraph() {
        $data = DF::getCountByMonth();
        $output['data'] = $data;
        echo json_encode($output);
    }
    public function showindexAjax($id){
        $edit = DF::where('id','=',$id)->get();
        $data = json_decode(json_encode($edit), true);
        $list['data'] =$data[0];
        
       return view('admin/investor/show',$list);
    }
}
