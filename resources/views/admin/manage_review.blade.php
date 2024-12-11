@extends('admin_layout')
@section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center">
        <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Liệt Kê Đánh Giá</h4>
    </div>
</div>

<div class="card-body px-0">
    <div class="table-responsive">
        <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
            @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
                {{ Session::put('message', null) }}
            @endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        </h5>

        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table">
            <thead>
                <tr class="ligth">
                    <th>Khách</th>
                    <th>Sản Phẩm</th>
                    <th>Bình Luận</th>
                    <th>Sao</th>
                    <th>Hiển thị</th>
                    <th>Action</th>
                    <th>Ngày thêm</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->customer->customer_name }}</td>
                        <td><img src="{{ asset('uploads/product/' . $review->product->product_image) }}" alt="{{ $review->product->product_name }}" width="50" height="50">{{ $review->product->product_name }}</td>
                        <td class="comment-cell">
                            <p>{{ $review->comment }}</p>
                        
                            <!-- Hiển thị form trả lời nếu chưa có phản hồi -->
                            @if($review->replies->isEmpty())
                            <form action="{{ route('addReply') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="review_id" value="{{ $review->review_id }}">
                                <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id}}">
                            
                                <div class="form-group">
                                    <textarea name="reply" class="form-control" required placeholder="Trả lời bình luận..."></textarea>
                                </div>
                                <button class="btn btn-primary mt-2" type="submit">Trả lời</button>
                            </form>
                            
                            @else
                                <!-- Nếu đã có phản hồi, hiển thị các trả lời và chức năng sửa/xóa -->
                                <div class="mt-3">
                                    @foreach($review->replies as $reply)
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p>Trả lời</p>
                                                <p><strong>{{ $reply->admin->admin_name }}:</strong> {{ $reply->reply }}</p>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editReplyModal" data-id="{{ $reply->reply_id }}" data-reply="{{ $reply->reply }}">
                                                    Sửa
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteReplyModal" data-id="{{ $reply->reply_id }}">
                                                    Xóa
                                                </button>

                                                <!-- Modal sửa phản hồi -->
<div class="modal fade" id="editReplyModal" tabindex="-1" role="dialog" aria-labelledby="editReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReplyModalLabel">Sửa phản hồi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateReply', $reply->reply_id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="reply_id" id="editReplyId">
                <div class="modal-body">
                    <textarea name="reply" id="editReplyText" required placeholder="Sửa phản hồi..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal xóa phản hồi -->
<div class="modal fade" id="deleteReplyModal" tabindex="-1" role="dialog" aria-labelledby="deleteReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteReplyModalLabel">Xóa phản hồi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<form action="{{ route('deleteReply', $reply->reply_id) }}" method="POST">
    @csrf
    @method('DELETE')

                <input type="hidden" name="reply_id" id="deleteReplyId">
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa phản hồi này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        
                        
                        
                        

                        <td>{{ $review->rating }} <i class="fa fa-star" style="color: gold;"></i></td>
                        <td>
                            @if($review->review_status == 1)
                                <a href="{{ URL::to('/unactive-review/'.$review->review_id) }}">
                                    <span class="fa-thumb-styling fa-solid fa-circle-check" style="color: green; font-size: 2em;"></span>
                                </a>
                            @else
                                <a href="{{ URL::to('/active-review/'.$review->review_id) }}">
                                    <span class="fa-thumb-styling fa-solid fa-circle-xmark" style="color: red; font-size: 2em;"></span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <a onclick="return confirm('Bạn muốn xóa đánh giá này không?')" 
                                   class="btn btn-sm btn-icon btn-danger" 
                                   data-toggle="tooltip" data-placement="top" title="Xóa" 
                                   href="{{ route('delete.review', ['review_id' => $review->review_id]) }}">
                                    <span class="btn-inner">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<script>
    // JavaScript để cập nhật thông tin khi nhấn nút Xóa
    $('#deleteReplyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Nút "Xóa"
        var replyId = button.data('id'); // ID của phản hồi

        var modal = $(this);
        var actionUrl = '/reply/' + replyId; // Tạo URL với ID phản hồi
        modal.find('#deleteReplyForm').attr('action', actionUrl); // Cập nhật action của form
        modal.find('#deleteReplyId').val(replyId); // Điền ID vào form
    });
</script>



@endsection
