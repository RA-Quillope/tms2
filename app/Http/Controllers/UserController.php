<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id', 'desc')->paginate(3);
        $data['tasks'] = Task::orderBy('id', 'desc')->paginate(3);
        return view('user.index', $data);
    }

    public function fetch_user_data(Request $request)
    {
        if ($request->ajax()) {
            $data['users'] = User::orderBy('id', 'desc')->paginate(3);
            return view('user.pagination', $data)->render();
        }
    }

    public function fetch_user_tasks($id)
    {
        $user_tasks = Task::where('user_id', $id)->get();

        $html = '';
        foreach ($user_tasks as $task) {
            $html .= '<tr>';
            $html .= '<td>' . $task->title . '</td>';
            $html .= '<td>' . $task->desc . '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        User::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $tasks = User::findOrFail($user->id)->tasks->each->delete();
        $user->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
}
