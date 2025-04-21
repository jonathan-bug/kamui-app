<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Todo;
use Exception;

class TodoController extends Controller
{
    public function page() {
        return view('pages.todo.index');
    }

    public function index() {
        $todos = Todo::all();

        $todos = $todos->map(function ($todo) {
            $todo->last = (new Carbon($todo->last))->format('d/m/Y');
            $todo->until = (new Carbon($todo->until))->format('d/m/Y');
            
            return $todo;
        });

        $data = [
            'message' => 'Todos fetched successfully',
            'records' => $todos,
            'status' => 200
        ];
        
        return $data;
    }

    public function find($id) {
        $todo = Todo::find($id);

        if($todo != null) {
            $data = [
                'message' => 'Todo fetched successfully',
                'record' => $todo,
                'status' => 200
            ];

            return $data;
        }

        $data = [
            'message' => 'Error unable to fetch todo',
            'record' => $todo,
            'status' => 404
        ];

        return $data;
    }

    public function update(Request $request, $id) {
        try {
            $todo = Todo::find($id);

            if($todo != null) {
                $todo->title = $request->get('title');
                $todo->priority = $request->get('priority');
                $todo->until = $request->get('until');
                $todo->repeat = $request->get('repeat');
                $todo->last = $request->get('last');
                $todo->streak = $request->get('streak');
                $todo->status = $request->get('status');
                
                $todo->save();

                $data = [
                    'message' => 'Todo updated successfully',
                    'status' => 200
                ];

                return $data;
            }

            $data = [
                'message' => 'Error todo not updated',
                'status' => 404
            ];

            return $data;
        }catch(Exception $error) {
            return $error;
        }
        
    }

    public function store(Request $request) {
        Todo::create($request->all());

        $data = [
            'message' => 'Todo added successfully',
            'status' => 200
        ];

        return $data;
    }

    public function patch(Request $request, $id) {
        $todo = Todo::find($id);

        if($todo != null) {
            $todo->title = $request->get('title');
            if($request->get('title') != null) {
                $todo->title = $request->get('title');
            }
            if($request->get('priority') != null) {
                $todo->priority = $request->get('priority');
            }
            if($request->get('until') != null) {
                $todo->until = $request->get('until');
            }
            if($request->get('priority') != null) {
                $todo->priority = $request->get('priority');
            }
            if($request->get('repeat') != null) {
                $todo->repeat = $request->get('repeat');
            }
            if($request->get('priority') != null) {
                $todo->priority = $request->get('priority');
            }
            if($request->get('streak') != null) {
                $todo->streak = $request->get('streak');
            }
            if($request->get('status') != null) {
                $todo->status = $request->get('status');
            }
            
            $todo->save();
        }
        
        return $todo;
    }

    public function destroy($id) {
        $todo = Todo::find($id);

        if($todo != null) {
            $todo->delete();
        }

        return 1;
    }
}
