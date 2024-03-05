<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display Posts
     *
     * @return Response
     */
    public function index(): Response
    {
        $posts = Post::paginate(5);

        return inertia('Post/Index', [
            'posts' => PostResource::collection($posts)->resolve(),
            'pagination' => $posts->toArray()
        ]);
    }

    /**
     * Display Create Form
     *
     * @return Response
     */
    public function create(): Response
    {
        return inertia('Post/Create');
    }

    /**
     * Create new Post
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return redirect()->route('post.index');
    }

    /**
     * Display Post
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        return inertia('Post/Show', [
            'post' => PostResource::make($post)->resolve()
        ]);
    }

    /**
     * Display Post for edit
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
    {
        return inertia('Post/Edit', [
            'post' => PostResource::make($post)->resolve()
        ]);
    }

    /**
     * Update Post
     *
     * @param Post $post
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(Post $post, UpdateRequest $request): RedirectResponse
    {
        $post->update($request->validated());

        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * Destroy Post
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function delete(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('post.index');
    }
}
