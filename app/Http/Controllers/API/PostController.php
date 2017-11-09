<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use Validator;

class PostController extends Controller
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

    

    public function create(PostRequest $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, $request->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $post = $this->repository->create($data);
            return response()->json($post);
        }
    }

    // update
    public function update(PostRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];
        $rules = array_merge($request->rules(), ['id' => 'required']);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $post = $this->repository->update($data, $id);
            return response()->json($post);
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
