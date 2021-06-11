<?php


   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Getintouch;
use Validator;
use App\Http\Resources\Getintouch as GetintouchResource;
   
class GetintouchController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Getintouchs = Getintouch::all();
    
        return $this->sendResponse(GetintouchResource::collection($Getintouchs), 'Getintouchs retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getintouch(Request $request)
    {
        $input = $request->all();
        //print_r($input);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'nationality' => 'required',
            'language' => 'required',
            'program' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $getintouch = Getintouch::create($input);
   
        return $this->sendResponse(new GetintouchResource($getintouch), 'You Getintouch With us successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Getintouch = Getintouch::find($id);
  
        if (is_null($Getintouch)) {
            return $this->sendError('Getintouch not found.');
        }
   
        return $this->sendResponse(new GetintouchResource($Getintouch), 'Getintouch retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Getintouch $Getintouch)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'nationality' => 'required',
            'language' => 'required',
            'program' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Getintouch->Getintouch = $input['Getintouch'];
        $Getintouch->save();
   
        return $this->sendResponse(new GetintouchResource($Getintouch), 'Getintouch updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Getintouch $Getintouch)
    {
        $Getintouch->delete();
   
        return $this->sendResponse([], 'Getintouch deleted successfully.');
    }
}

