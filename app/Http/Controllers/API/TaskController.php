<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Rules\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = Task::all();

        return response()->json(compact('tasks'), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request, Recaptcha $recaptcha)
    {
        $request->validate(
            [
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:1000',
                'recaptcha' => ['required', $recaptcha],
            ]
        );

        $task = Task::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]
        );

        return response()->json(compact('task'), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $task = Task::query()->find($id);

        return response()->json(compact('task'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $task = Task::query()->find($id);

        if ($request->method() === 'PUT') {
            $task->update(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                ]
            );
        } elseif ($request->method() === 'PATCH') {
            $task->update(
                [
                    'completed_at' => now(),
                ]
            );
        }

        return response()->json(compact('task'), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $task = Task::query()->find($id);
        $taskId = $task->id;
        $task->delete();

        return response()->json(compact('taskId'), Response::HTTP_OK);
    }
}
