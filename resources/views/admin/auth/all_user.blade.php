@extends('admin_layout')
@section('admin_content')

<div class="card-header text-center">
    <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Tất Cả Người Dùng</h4>
</div>

<div class="card-body">
    <div class="table-responsive">
        <!-- Thông báo thành công -->
        <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
            @if(Session::has('message'))
                <span>{{ Session::get('message') }}</span>
                @php
                    Session::forget('message');
                @endphp
            @endif
        </h5>

        <!-- Bảng người dùng -->
        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Tên Người Dùng</th>
                    <th>Email</th>
                    <th>Điện Thoại</th>
                    <th>Vai Trò</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->admin_name }}</td>
                        <td>{{ $user->admin_email }}</td>
                        <td>{{ $user->admin_phone }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- Hiển thị vai trò người dùng -->
                                <div id="current-roles-{{ $user->admin_id }}">
                                    @foreach ($user->roles as $role)
                                        <span>{{ $role->name }}</span><br>
                                    @endforeach
                                    <!-- Icon mở modal chỉnh sửa vai trò -->
                                    <i class="fas fa-user-shield ms-2" style="font-size: 16px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#roleModal-{{ $user->admin_id  }}"></i>
                                </div>
                                
                                <!-- Modal chỉnh sửa vai trò -->
                                <div class="modal fade" id="roleModal-{{ $user->admin_id  }}" tabindex="-1" aria-labelledby="roleModalLabel-{{ $user->admin_id  }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="roleModalLabel-{{ $user->admin_id  }}">Chỉnh sửa vai trò</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form trong Modal -->
                                                <form action="{{ url('update-role/'.$user->admin_id) }}" method="POST" id="role-form-{{ $user->admin_id }}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->admin_id }}">
                                                    <div class="form-group">
                                                        <select class="form-control" name="role_id">
                                                            @foreach($allRoles as $role)
                                                                <option value="{{ $role->role_id }}" @if($user->roles->contains($role->role_id)) selected @endif>
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <!-- Nút Lưu thay đổi -->
                                                <button type="submit" class="btn btn-primary" form="role-form-{{ $user->admin_id }}">Lưu thay đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="d-flex">
                                <!-- Nút sửa người dùng -->
                                <a href="{{ URL::to('edit-user/'.$user->admin_id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Nút xóa người dùng -->
                                <a onclick="return confirm('Bạn muốn xóa người dùng {{ $user->admin_name }}?')" href="{{ URL::to('delete-user/'.$user->admin_id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
