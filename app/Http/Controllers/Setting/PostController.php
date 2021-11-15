<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\post;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = post::all();
        return view('settings.post', compact('posts'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:posts']);
        post::create($validate);
        toast('बैठक समितिको पद थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(post $post): View
    {
        $posts = post::all();
        return view('settings.post', compact('post','posts'));
    }
    
    public function update(Request $request,post $post): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('posts')
            ->ignore($post)
        ]);
        toast('बैठक समितिको पद सच्याउन सफल भयो ','success');
        $post->update($validate);
        return redirect()->route('post.index');
    }

    public function destroy(post $post): RedirectResponse
    {
        $post->delete();
        toast('बैठक समितिको पद हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
