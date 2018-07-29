<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tasks;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
    {
        $tasklist = Tasks::all();
        
        return view('tasks.index',[
            'tasklist' => $tasklist
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasklist = new tasks;
        
        return view('tasks.create',[
          'tasklist' => $tasklist,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'status' => 'required|max:191',   // 追加
            'content' => 'required|max:191',
        ]);
        
        $tasklist = new tasks;
        $tasklist->status = $request->status;    // 追加
        $tasklist->content = $request->content;
        $tasklist->save();
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasklist = Tasks::find($id);
        
        return view('tasks.show', [
            'tasklist' => $tasklist
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasklist = Tasks::find($id);
        
        return view('tasks.edit',[
            'tasklist' => $tasklist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:191',   // 追加
            'content' => 'required|max:191',
        ]);
        
        $tasklist = Tasks::find($id);
        $tasklist->status = $request->status;    // 追加
        $tasklist->content = $request->content;
        $tasklist->update();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasklist = Tasks::find($id);
        $tasklist->delete();
        
        return redirect('/');
    }
}
