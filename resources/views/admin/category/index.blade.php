@extends('admin.layout.master')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>

                <div class="card-tools">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create Category  <i class="fa fa-plus-square"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->parentCategory != null ? $category->parentCategory->title : "-" }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('admin.category.destroy',$category) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                  <a href="{{ route('admin.category.edit',$category) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                  <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                               </form>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


@endsection
