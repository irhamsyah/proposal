<?php

class TodoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
    public $restful = true;
  public function postAdd() {
      if(Request::ajax()){
    $todo = new Todo();
    $todo->title = Input::get("title");
    $todo->save();      
    $last_todo = $todo->id;
    $todos = Todo::whereId($last_todo)->get();
    return View::make("ajaxData")
      ->with("todos", $todos);
      }
  }
  public function postUpdate($id) {        
    if(Request::ajax()){
    $task = Todo::find($id);
    $task->title = Input::get("title");
    $task->save();
    return "OK";   
    }
  }
    public function getIndex() {
      $todos = Todo::all();
      return View::make("index")->with("todos", $todos);
    }
  
public function getDelete($id) {
  if(Request::ajax()){
    $todo = Todo::whereId($id)->first();
    $todo->delete();
    return "OK";
  }
}
public function getDone($id) {
  if(Request::ajax()){
    $task = Todo::find($id);
    $task->status = 1;
    $task->save();
    return "OK";
  }
}    
  public function index()
	{
		//
   
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
      
            
	}

}