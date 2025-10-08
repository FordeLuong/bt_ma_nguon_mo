<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:10',
            'author' => 'required|string'
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'content.min' => 'Nội dung phải có ít nhất 10 ký tự'
        ]);
        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được tạo thành công!');
        // Xử lý lưu dữ liệu ở bài sau
        // return back()->with('success', 'Bài viết đã được tạo thành công!');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:10',
            'author' => 'required|string'
        ]);
        $post = Post::findOrFail($id);
        $post->update($validated);
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được cập nhật!');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();


        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa!');
    }
}