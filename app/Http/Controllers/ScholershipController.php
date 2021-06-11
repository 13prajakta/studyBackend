<?php


   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Scholership;
use Validator;
use App\Http\Resources\Scholership as ScholershipResource;
   
class ScholershipController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scholershiplist()
    {
        $Scholerships = Scholership::all();
    
        return $this->sendResponse(ScholershipResource::collection($Scholerships), 'Scholerships retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scholership(Request $request)
    {
        $input = $request->all();
        //print_r($input);
        $validator = Validator::make($request->all(), [
            'scholership_name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Scholership = Scholership::create($input);
   
        return $this->sendResponse(new ScholershipResource($Scholership), 'You Scholership With us successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Scholership = Scholership::find($id);
  
        if (is_null($Scholership)) {
            return $this->sendError('Scholership not found.');
        }
   
        return $this->sendResponse(new ScholershipResource($Scholership), 'Scholership retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scholership $Scholership)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'scholership_name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Scholership->Scholership = $input['Scholership'];
        $Scholership->save();
   
        return $this->sendResponse(new ScholershipResource($Scholership), 'Scholership updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scholership $Scholership)
    {
        $Scholership->delete();
   
        return $this->sendResponse([], 'Scholership deleted successfully.');
    }
}

