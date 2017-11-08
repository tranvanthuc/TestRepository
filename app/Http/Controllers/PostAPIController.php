<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use Validator;

class PostAPIController extends Controller
{
// --------------------API-------------------------------

    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    // get list posts
    public function getAll()
    {
        $posts = $this->repository->all();
        return response()->json($posts);
    }

    

    // bi loi redirect ve route('/')
    // public function create(PostRequest $request)
    // {
    //     $data = $request->all();
    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), $request->rules());
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     } else {
    //         try {
    //             $post = $this->repository->create($data);
    //             return response()->json(['data' => $post]);
    //         } catch (\Exception $e) {
    //             dd($e->getMessage());
    //             $message = "Cannot create !";
    //             return response()->json(compact('message'), 404);
    //         }
    //     }
    // }

    public function create()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'title' => 'required|min:5',
            'body' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $post = $this->repository->create($data);
            return response()->json($post);
        }
    }

    
    // update
    public function update()
    {
        // $data = request(['title', 'body']);
        $data = request()->all();
        $id = request('id');

        try {
            $post = $this->repository->update($data, $id);
            return response()->json(['data' => $post]);
        } catch (\Exception $e) {
            $message = "Cannot update !";
            return response()->json(compact('message'), 404);
        }
    }

    // delete
    public function delete($id)
    {
        try {
            $post = $this->repository->delete($id);
            return response()->json("Delete success");
        } catch (\Exception $e) {
            $message = "Not found !";
            return response()->json($e->getMessage(), 404);
        }
    }

    // get post by id
    public function getById($id)
    {
        try {
            $post = $this->repository->find($id);
            return response()->json($post);
        } catch (\Exception $e) {
            $message = "Not found Post!";
            return response()->json(compact('message'), 404);
        }
    }
}
