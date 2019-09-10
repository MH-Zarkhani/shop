@extends('admin.layout.master')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
                <div class="card-tools">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create Product  <i class="fa fa-plus-square"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>{{ $product->count }}</td>
                        <td>{{ $product->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('admin.product.destroy',$product) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                  <a href="{{ route('admin.product.edit',$product) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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
