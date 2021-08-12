@extends('admin.app')

@section('title', 'Products')

@section('content')

<div class="app-page-title mb-2">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-tags icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Products
            </div>
        </div>
    </div>
</div>
<div class="row mb-1">
    <div>
        <a href="{{route('backend-products.create')}}" class="btn btn-primary ml-3"><i class="fas fa-plus"></i> Add new prodcut</a>
        <a href="{{route('export')}}" class="btn btn-success ml-1"><i class="fas fa-file-excel"></i> Export excel file</a>
    </div>
    <div class="ml-auto">
        <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mr-5">
                <div class="col-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Import') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>            
<div class="card">
    <div class="card-body">
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
$(function() {
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('backend.datas') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'category', name: 'category', orderable: true, searchable: true},
            { data: 'user', name: 'user', orderable: true, searchable: true},
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on('click', '.delete-button', function(e){
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
            if (result.isConfirmed) {
               $.ajax({
                   url : 'backend-products/' + id,
                   type : 'DELETE',
                   success : function() {
                       table.ajax.reload();
                   }
               });
            }
        });
    });
  
});
</script>
@endsection