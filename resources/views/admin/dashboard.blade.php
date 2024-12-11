@extends('admin_layout')
@Section('admin_content')
<div class="card-header d-flex justify-content-between mb-5">
    <h4 class="card-title">
        Chào 
  
            <span style="color: orange; font-weight: bold;">
                {{ Auth::guard('admin')->user()->admin_name }}
            </span>

    </h4>
    
    
</div>
@endsection