<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = TodoList::all();
        return TodoListResource::collection($todos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        TodoList::create([
            'title' => $request->title,
            'description' => $request->title,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Successfuly added todo'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = TodoList::find($id);
        return  new TodoListResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);
        $todo = TodoList::find($request->id);
        $todo->title = $request->title;
        $todo->description = $request->title;
        $todo->update();

        return response()->json([
            'message' => "Item successfuly updated!",
            "code" => 200,
            'Status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
    
        $todo = TodoList::find($request->id);
        $todo->delete();

        return response()->json([
            'message' => "Item deleted permanently!",
            "code" => 200,
            'Status' => true
        ]);

    }
}
