@extends('admin.app')

@section('title', 'Categories')

@section('content')

<div class="app-page-title mb-2">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-stream icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categories
            </div>
        </div>
    </div>
</div>
<div class="mb-1">
    <a href="{{route('backend-categories.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add new category</a>
</div>            
<div class="card">
    <div class="card-body">
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
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
        ajax: '{!! route('categories.datas') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
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
                   url : 'backend-categories/' + id,
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