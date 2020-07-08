<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\ToDoList as ToDoListResource;
use App\ToDoList;
use Illuminate\Support\Facades\Auth;
use App\User;

class ToDoListController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toDoLists = ToDoList::all();
    
        return $this->sendResponse(ToDoListResource::collection($toDoLists), 'To do lists retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'date_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = Auth::user(); 

        $input['username'] = $user->name;
   
        $toDoList = ToDoList::create($input);
   
        return $this->sendResponseOnAdd(new ToDoListResource($toDoList), 'To do list added successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDoList = ToDoList::find($id);
  
        if (is_null($toDoList)) {
            return $this->sendError('To do list not found.');
        }
   
        return $this->sendResponse(new ToDoListResource($toDoList), 'To do list retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDoList $toDoList)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'date_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $toDoList->title = $input['title'];
        $toDoList->description = $input['description'];
        $toDoList->date_time = $input['date_time'];
        $toDoList->save();
   
        return $this->sendResponse(new ToDoListResource($toDoList), 'To do list updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDoList $toDoList)
    {
        $toDoList->delete();
   
        return $this->sendResponse([], 'To do list deleted successfully.');
    }
}