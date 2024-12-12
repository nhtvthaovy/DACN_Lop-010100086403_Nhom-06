<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{

    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }
    public function add_post(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
        
        
        return view('admin.post.add_post');
    }
    public function all_post(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $posts = PostModel::all();
        
        return view('admin.post.all_post', compact('posts'));
    }


    public function active_post($post_id)
    {
        $post = PostModel::find($post_id);
        $post->post_status = 1; // Đặt trạng thái là 'hiển thị'
        $post->save();

        return redirect()->back()->with('message', 'Bài viết đã được hiển thị.');
    }

    public function unactive_post($post_id)
    {
        $post = PostModel::find($post_id);
        $post->post_status = 0; // Đặt trạng thái là 'ẩn'
        $post->save();

        return redirect()->back()->with('message', 'Bài viết đã bị ẩn.');
    }

    public function edit_post($post_id)
    {
        $post = PostModel::find($post_id);
        return view('admin.post.edit_post', compact('post'));
    }


    public function edit($post_id)
    {
    $post = PostModel::find($post_id); 
    return view('admin.edit-post', compact('post')); 
    }

    // Xóa bài viết
    public function delete_post($post_id)
    {
        $post = PostModel::find($post_id);
    
        if ($post->post_thumbnail) {
            $image_path = public_path('uploads/post/' . $post->post_thumbnail);
    
            if (file_exists($image_path)) {
                unlink($image_path); 
            }
        }
    
        $post->delete();
    
        return redirect()->route('all-post')->with('message', 'Bài viết đã được xóa.');
    }
    


    public function update_post(Request $request, $post_id)
{
    $post = PostModel::find($post_id);

    // Validate dữ liệu
    $request->validate([
        'post_title' => 'required|string|max:255',
        'post_desc' => 'required|string',
        'post_content' => 'required|string',
        'post_author' => 'required|string',
        'post_status' => 'required|in:0,1',
    ]);

    // Cập nhật thông tin bài viết
    $post->post_title = $request->post_title;
    $post->post_desc = $request->post_desc;
    $post->post_content = $request->post_content;
    $post->post_author = $request->post_author;
    $post->post_status = $request->post_status;

    // Kiểm tra và xử lý ảnh đại diện mới
    if ($request->hasFile('post_thumbnail')) {
        // Nếu có ảnh mới, xóa ảnh cũ (nếu có)
        if ($post->post_thumbnail && file_exists(public_path('uploads/post/'.$post->post_thumbnail))) {
            unlink(public_path('uploads/post/'.$post->post_thumbnail));  // Xóa ảnh cũ
        }

        // Tạo tên ảnh mới
        $slug = Str::slug($request->post_title); // Tạo slug từ tiêu đề
        $timestamp = Carbon::now()->format('Ymd_His');
        $image_name = $slug . '_' . $timestamp . '.' . $request->file('post_thumbnail')->getClientOriginalExtension();

        // Lưu ảnh vào thư mục uploads/post
        $request->file('post_thumbnail')->move(public_path('uploads/post'), $image_name);

        // Lưu đường dẫn ảnh mới vào CSDL
        $post->post_thumbnail = $image_name;
    }

    // Lưu các thay đổi vào CSDL
    $post->save();

    // Trả về thông báo cập nhật thành công
    return redirect()->route('all-post', $post->post_id)->with('message', 'Cập nhật bài viết thành công!');
}

    public function savePost(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'post_title' => 'required|max:255',
            'post_desc' => 'required|max:255',
            'post_content' => 'required',
            'post_author' => 'required|max:255',
            'post_thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'post_status' => 'required|boolean',
        ]);

        // Lấy dữ liệu từ form
        $data = new PostModel();
        $data->post_title = $request->post_title;
        $data->post_desc = $request->post_desc;
        $data->post_content = $request->post_content;
        $data->post_author = $request->post_author;
        $data->post_status = $request->post_status;

        // Xử lý ảnh upload
        if ($request->hasFile('post_thumbnail')) {
            $slug = Str::slug($request->post_title); // Tạo slug từ tiêu đề
            $timestamp = Carbon::now()->format('Ymd_His');
            $image_name = $slug . '_' . $timestamp . '.' . $request->file('post_thumbnail')->getClientOriginalExtension();

            // Lưu ảnh vào thư mục
            $request->file('post_thumbnail')->move(public_path('uploads/post'), $image_name);

            $data->post_thumbnail = $image_name; // Lưu đường dẫn ảnh
        }

        // Lưu bài viết vào database
        $data->save();

        // Trả về thông báo và redirect
        return redirect()->back()->with('message', 'Thêm bài viết thành công!');
    }








    ///

    public function post()
    {
        $posts = PostModel::where('post_status', 1)->get();
    
        return view('pages.post', compact('posts'));
    }


    public function showPost($post_id)
{
    $post = PostModel::findOrFail($post_id);

    return view('pages.post_detail', compact('post'));
}

}
