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
   
class RegisterController extends BaseController
{
    
    // public function __construct()
    // {
    //     $this->middleware(['auth']); // <------------ had to remove this
    // }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $users = User::where('email', '=', $request->input('email'))->first();
        $usersmob = User::where('mobile', '=', $request->input('mobile'))->first();
        if ($users === null && $usersmob=== null) {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $token = $user->createToken('API Token')->accessToken;
            $success['name'] =  $user->name;
            $success['token'] =  $token;
    
        return $this->sendResponse($success, 'User register successfully ! Thank You for Register with Us..');
        
          } else {
            return $this->sendResponse('message','User already exist Try With diffrent email and number.');
          }
        
        ndResponse($success, 'User register successfully ! Thank You for Register with Us..');
        
        
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    { 
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }
        $user = Auth::user(); 
        $name=$user->name;
        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['name'=>$name, 'token' => "Bearer ".$token,'message'=>'Login Successfully']);
       
    }

    public function checkdetails()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }
}
