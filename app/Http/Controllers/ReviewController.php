<?php

namespace App\Http\Controllers;

use App\Models\ReplyModel;
use App\Models\ReviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

session_start();



class ReviewController extends Controller
{

    public function submit_review(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:tbl_product,product_id',
            'customer_id' => 'required|exists:tbl_customers,customer_id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:300',
        ]);
    
        ReviewModel::create([
            'product_id' => $validatedData['product_id'],
            'customer_id' => $validatedData['customer_id'],
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'],
        ]);
    
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công và đang chờ duyệt!');
    }
      












    // admin 

    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }



    public function active_review($review_id){
        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $review = ReviewModel::find($review_id);
    
        if ($review) {
            $review->review_status = 1;
            $review->save();
    
            Session::put('message', 'Hiện đánh giá thành công!');
        } else {
            Session::put('message', 'Sản phẩm không tồn tại!');
        }
    
        return Redirect::to('/manage-review');
    }
    
    public function unactive_review($review_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $review = ReviewModel::find($review_id);
    
        if ($review) {
            $review->review_status = 0;
            $review->save();
    
            Session::put('message', 'Ẩn đánh giá thành công!');
        } else {
            Session::put('message', 'Đánh giá không tồn tại!');
        }
    
        return Redirect::to('/manage-review');
    }


    public function manage_review(){
        $check = $this->Authlogin(); 
        if ($check) {
            return $check; 
        }
    
        $reviews = ReviewModel::with(['product','customer', 'replies'])->get(); 
        
    
        return view('admin_layout', [
            'admin.manage_review' => view('admin.manage_review', compact('reviews'))
        ]);
    }



    public function addReply(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:tbl_review,review_id',
            'admin_id' => 'required|exists:tbl_admin,admin_id',
            'reply' => 'required|string|max:1000',
        ]);

        ReplyModel::addReply($request->review_id, $request->admin_id, $request->reply);

        return back()->with('success', 'Phản hồi đã được thêm thành công!');
    }


    // sua
    public function updateReply(Request $request, $id)
    {
        $reply = ReplyModel::findOrFail($id);

        $reply->update([
            'reply' => $request->reply
        ]);

        return back()->with('success', 'Phản hồi đã được sửa thành công!');
    }

    // xoa
    public function deleteReply(Request $request, $id)
    {
        $reply = ReplyModel::findOrFail($id);

        $reply->delete();

        return back()->with('success', 'Phản hồi đã được xóa thành công!');
    }



    public function deleteReview($review_id)
{
    $review = ReviewModel::find($review_id);

    if ($review) {
        $review->delete();

        return redirect()->back()->with('success', 'Đánh giá đã được xóa thành công!');
    } else {
        return redirect()->back()->with('error', 'Không tìm thấy đánh giá này!');
    }
}

    

}
