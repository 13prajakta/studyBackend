<?php


   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\University;
use Validator;
use App\Http\Resources\University as UniversityResource;
   
class UniversityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function universities()
    {
        $Universitys = University::all();
    
        return $this->sendResponse(UniversityResource::collection($Universitys), 'Universitys retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createuniversity(Request $request)
    {
        $input = $request->all();
        //print_r($input);
        $validator = Validator::make($request->all(), [
            'university' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $University = University::create($input);
   
        return $this->sendResponse(new UniversityResource($University), 'University created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $University = University::find($id);
  
        if (is_null($University)) {
            return $this->sendError('University not found.');
        }
   
        return $this->sendResponse(new UniversityResource($University), 'University retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $University)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'university' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $University->university = $input['university'];
        $University->save();
   
        return $this->sendResponse(new UniversityResource($University), 'University updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $University)
    {
        $University->delete();
   
        return $this->sendResponse([], 'University deleted successfully.');
    }
}
