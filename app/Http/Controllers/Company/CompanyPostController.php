<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPost;
use App\Helpers\MarkdownHelper;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyPostController extends Controller {
    public function show(string $id) {
        $post = CompanyPost::find($id);

        $post->html_content = MarkdownHelper::render($post->content);

        return view('company-posts.show', ['post' => $post]);
    }

    public function create(string $id)  {
        $company = Company::find($id);

        return view('company-posts.create', [
            'company' => $company
        ]);
    }

    public function store(Request $request, string $id) {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:200'],
            'post_content' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        CompanyPost::create(['title' => $request->title, 'description' => $request->description, 'content' => $request->post_content, 'company_id' => $id]);

        return redirect()->route('company.posts.create', ['id' => $id])->with('message', 'Post created successful!');
    }

    public function edit(string $id) {
        $post = CompanyPost::find($id);

        return view('company-posts.edit', ['post' => $post]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:200'],
            'post_content' => ['required', 'string', 'min:5', 'max:500']
        ]);

        $post = CompanyPost::find($id);

        $post->update(['title' => $request->title, 'description' => $request->description, 'content' => $request->post_content]);

        return redirect()->route('company.posts.edit', ['id' => $id])->with('message', 'Post updated successful!');
    }

    public function destroy(string $id) {
        $post = CompanyPost::find($id);

        $post->delete();

        return redirect()->route('companies.show', ['id' => $post->company_id])->with('message', 'Post deleted successful!');
    }
}
