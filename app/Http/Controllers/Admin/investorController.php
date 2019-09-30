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
        try {
            Excel::load(Input::file('file'), function ($reader){
                $reader->each(function($sheet, $i =0) { 
                    if ($i == 0) {
                        $masterFile = new MF;
                        $masterFile->file_name = Input::file('file')->getClientOriginalName();
                        $masterFile->created_at = date('Y-m-d H:i:s');
                        $masterFile->date = date('Y-m-d',strtotime(Input::get('tanggal')));
                        $masterFile->save();
                        $id_master = $masterFile->id;
                    }
                 $detailFile = new DF;
                 $detailFile->no = $sheet['no'];
                 $detailFile->tanggal = $sheet['tanggal'];
                 $detailFile->nama_investor = $sheet['nama_investor'];
                 $detailFile->nomor_rekening = $sheet['nomor_rekening'];
                 $detailFile->id_master = $id_master;
                 $detailFile->created_at = date('Y-m-d H:i:s');
                 $detailFile->tanggal = date('Y-m-d',strtotime($sheet['tanggal']));
                 $detailFile->save();
                $i++;
                DB::commit();
                });
           });
        }catch (\Exception $e) {
            DB::rollback();
            print_r($e);die;
            $validator = 'gagal transaksi data !!!';
            $return['status'] = false;
            $return['messages'] =$validator;
            $return['data'] =[];
            return $return;
        }
       
       die;
        echo "<pre>";
        print_r($data);die;
        $checkPassword = US::where('password', md5($data['password']))->get()->toArray();
        if (empty($checkPassword)) {
            $picture =$this->uploadfile('picture');
            $users =new US;
            $users->name =$data['name'];
            $users->password =md5($data['password']);
            $users->email =$data['email'];
            $users->created_at =date('Y-m-d H:i:s');
            $users->updated_at=date('Y-m-d H:i:s');
            $users->phone_number= $data['phone_number'];
            $users->save();
           
            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;

        }
            $validator = 'password yang anda gunakan telah tersedia. gunakan password lain!';
            $return['status'] = false;
            $return['messages'] =$validator;
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
           
           //get data id_category where brand and category 
           $user =US::find($data['id']);
           $user->name =$data['name'];
           if ($data['password'] == $data['old_password']) {
            $user->password =$data['password'];
           }else{
            $user->password =md5($data['password']);
           }
           $user->email =$data['email'];
           $user->updated_at=date('Y-m-d H:i:s');
           $user->phone_number= $data['phone_number'];
           $user->update();
           //return
           $return['status'] = true;
           $return['messages'] ='Berhasil';
           $return['data'] =[];
           
           return $return;
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
    public function edit() {
        //get id karyawan
        $id =Input::get('id');
        //get karyawan by id
        $edit = US::getByID($id);
        $data = json_decode(json_encode($edit), true);
        if ($edit) {
            $data[0]['submit'] = "Update";
            $json['status'] = true;
            $json['messages'] = 'Success';
            $json['data'] = $data[0];
        }else{
            $json['status'] = false;
            $json['messages'] = 'Failed';
            $json['data'] = [];
        }
         //send view with data
         return Response::json($json);
    }
    public function delete($id)
    {
        try {
            $user = US::find($id);
            $user->delete();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'this data is used in other tables');
            return \Redirect::to(route('user.index'));
        }

        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('user.index'));
    }
}