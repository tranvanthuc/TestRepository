<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use App\Utils\Functions;
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
        try {
            $posts = $this->repository->all();
            return $this->success($posts);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    

    public function create(PostRequest $request)
    {
        try {
            $data = $request->all();
            // $validator = Validator::make($data, $request->rules());
            // if ($validator->fails()) {
            //     return $this->error($validator->errors(), 422);
            // }
            $post = $this->repository->create($data);
            return $this->success($post);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    /**
     * update abc
     */
    public function update(PostRequest $request)
    {
        try {
            $data = $request->all();
            $id = $request['id'];
            $rules = array_merge($request->rules(), ['id' => 'required']);
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return $this->error($validator->errors(), 422);
            } else {
                $post = $this->repository->update($data, $id);
                return $this->success($post);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }
    // delete
    public function delete($id)
    {
        try {
            $this->repository->delete($id);
            return $this->success("Delete success");
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    // get post by id
    public function getById($id)
    {
        try {
            $post = $this->repository->find($id);
            return $this->success($post);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }
}
