<?php
   
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller as Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Str;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;
   
class UserdetailController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware(['auth']); // <------------ had to remove this
    }
    

    public function checkdetails()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }
}
