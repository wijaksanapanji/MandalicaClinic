<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(5);
        return view('blogs.index', compact('blogs'));
    }

    public function indexBlog(Blog $blogs)
    {
        $blogs = Blog::all();
        return view('welcome', ['blogs' => $blogs]);
    }

    public function showBlog(Blog $blogs)
    {
        $blogs = Blog::where('id', $blogs)->first();
        return view('blogs.showBlogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasidata = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'tag' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->file('gambar')) {
            $validasidata['gambar'] = $request->file('gambar')->store('storage/blog', 'public');
        }

        Blog::create($validasidata);
        Alert::success('Berhasil', 'Artikel anda telah berhasil ditambahkan');
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());
        Alert::success('Berhasil', 'Artikel anda berhasil di edit');
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        Alert::success('Berhasil', 'Artikel anda berhasil dihapus');
        return redirect()->back();
    }
}
