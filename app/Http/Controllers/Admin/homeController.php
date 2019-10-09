<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\DetailsFile as DF;
use App\Models\MasterFile as MF;
use App\Models\DetailTransactionGoods as DTG;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class homeController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['user'] = US::count();
        $data['file'] = MF::count();
        $data['data'] = DF::count();
        $month = date("F");
        $data['month'] = $month;
         return view("home",$data);
    }


}
