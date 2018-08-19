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
        
    if (\Auth::check()) {
        $user = \Auth::user();
        $tasks = $user->tasks;//ログインしているユーザのタスク一覧
        
        return view('tasks.index',[
            'tasks' => $tasks
    ]);}else {
        return view('welcome');
        
    }}

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
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
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
        
        if (\Auth::id() === $tasklist->user_id) {
            return view('tasks.show', [
                'tasks' => $tasklist
                ]);
        } else {
        return redirect('/');
        }

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
        
        if (\Auth::id() === $tasklist->user_id) {
        return view('tasks.edit',[
            'tasklist' => $tasklist
            ]);
        }else{
        return redirect('/');
    }}

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

        if (\Auth::id() === $tasklist->user_id) {
        $tasklist->delete();
        return redirect('/');
        }else{
        return redirect('/');
    }}
}
