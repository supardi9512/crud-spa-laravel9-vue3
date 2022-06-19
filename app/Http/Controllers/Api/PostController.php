<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return new PostResource(true, 'List Semua Posts', $posts);
    }

    public function store(StorePostRequest $request)
    {
        //validate data
        $data_post = $request->validated();

        $post = Post::create($data_post);

        if ($post) {
            return new PostResource(true, 'Post berhasil disimpan!', $post);
        } else {
            return new PostResource(false, 'Post gagal disimpan!', null);
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return new PostResource(true, 'Detail Post', $post);
        } else {
            return new PostResource(false, 'Post tidak ditemukan!', null);
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //validate data
        $data_post = $request->validated();

        $post->update($data_post);

        if ($post) {
            return new PostResource(true, 'Post berhasil diupdate!', $post);
        } else {
            return new PostResource(false, 'Post gagal diupdate!', null);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            
            return new PostResource(true, 'Post berhasil dihapus!', null);
        } catch (QueryException $e) {     
            return new PostResource(false, 'Post gagal dihapus!', null);
        }
    }
}
