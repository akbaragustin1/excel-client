<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\Locations as LC;
use App\Models\DetailTransactionGoods as DTG;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class homeController extends Controller
{

    private $parser = array();

    public function index()
    {
         return view("home");
    }


}
