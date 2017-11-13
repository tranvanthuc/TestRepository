<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        // $posts = $this->repository->all();
        $posts = $this->repository->all();
        return view('posts.index', compact('posts'));
        // return json_encode($posts);
    }

    public function show($id)
    {
        // $post = $this->repository->find($id);
        $post = $this->repository->with(['user'])->find($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->all();
        array_splice($data, 0, 1); // remove _token
        $this->repository->create($data);
        return redirect('/posts');
    }

    public function update()
    {
        $data = request(['title', 'body']);
        $id = request('id');
        
        $this->repository->update($data, $id);
        return redirect('/posts/' . $id);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect('/posts');
    }

    public function deleteByTitle()
    {
        $data = request(['title']);
        // array_splice($data, 0, 1); // remove _token
        // dd($data);
        $this->repository->deleteWhere($data);
        return redirect('/posts');
    }

    public function findByTitle()
    {
        $data = request('title');
        $post = $this->repository->findByField('title', $data, ['id']);
        $id = $post[0]->id;
        return redirect('/posts/' . $id);
    }
}
