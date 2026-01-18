<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {
        // get all produces
        $posts = Auth::user()->is_admin
            ? Post::with('user')->latest()->paginate(10)->withQueryString()
            : Post::where('user_id', Auth::id())->latest()->paginate(10)->withQueryString();
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate and store the post
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required|image|max:2048',
        ]);

        // Upload image and get path
        $image = $request->file('image');
        $image->storeAs('posts', $image->hashName());
        // Logic to store the post goes here
        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image->hashName(),
        ]);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        // Show a specific post
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        // Edit a specific post
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the post
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'sometimes|image|max:2048',
        ]);
        $post = Post::findOrFail($id);
        // Update image if provided
        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete('posts/' . $post->image);

            // Uploaded new image
            $image = $request->file('image');
            $image->storeAs('posts', $image->hashName());


            $post->update([
                'image' => $image->hashName(),
                'title' => $request->input("title"),
                'description' => $request->input("description"),
                'price' => $request->input("price"),
                'stock' => $request->input("stock"),
            ]);
        } else {
            $post->update([
                'title' => $request->input("title"),
                'description' => $request->input("description"),
                'price' => $request->input("price"),
                'stock' => $request->input("stock"),
            ]);
        }
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        // Delete a specific post
        $post = Post::findOrFail($id);
        // Delete image from storage
        Storage::delete('posts/' . $post->image);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
