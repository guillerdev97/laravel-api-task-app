<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // read of crud
    public function list()
    {
        try {
            $tasks = Task::all();

            Task::throwExceptionIfNotTasks();

            return response()->json([
                'status' => 1,
                'msg' => 'All tasks',
                'data' => $tasks
            ], 200);
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();

            return response()->json([
                'status' => 0,
                'msg' => $msg,
            ], $code);
        }
    }

    // create of crud
    public function create(Request $request)
    {
        try {
            $validations = [
                'name' => 'required|max:50',
                'category_id' => 'required|integer',
                'description' => 'required|max:255'
            ];

            $validator = Validator::make(
                $request->all(),
                $validations
            );

            if ($validator->fails()) {
                throw new Exception();
            }

            $task = Task::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => 1,
                'msg' => 'Task created successfully',
                'data' => $task
            ], 200);
        } catch (Exception) {
            $errors = $validator->errors();

            return response()->json([
                'status' => 0,
                'msg' => $errors
            ], 400);
        }
    }

    // delete of crud
    public function delete($id)
    {
        try {
            $task = Task::find($id);

            if(isset($task->id) === false) {
                throw new Exception(
                    'Task not found',
                    404
                );
            }

            $task->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'Task deleted',
            ], 200);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();

            return response()->json([
                'status' => 0,
                'msg' => $msg
            ], $code);
        }
    }

    // update of crud
    public function update(Request $request, $id) {
        try {
            $task = Task::find($id);

            if(isset($task->id) === false) {
                throw new Exception(
                    'Task not found',
                    404
                );
            }

            $validations = [
                'name' => 'required|max:50',
                'category_id' => 'required|integer',
                'description' => 'required|max:255'
            ];

            $validator = Validator::make(
                $request->all(),
                $validations
            );

            if ($validator->fails()) {
                throw new Exception();
            }
    
            $task->name = $request->name;
            $task->category_id = $request->category_id;
            $task->description = $request->description;
    
            $task->update();
    
            return response()->json([
                'status' => 1,
                'msg' => 'Task updated',
                'data' => $task
            ], 200);
        } catch(Exception $e) {
            if($validator->errors()) {
                $msg = $validator->errors();
                $code = 400;
            }
            if(!$validator->errors()) {
                $msg = $e->getMessage();
                $code = $e->getCode();
            }

            return response()->json([
                'status' => 0,
                'msg' => $msg
            ], $code);
        } 
    }
}
