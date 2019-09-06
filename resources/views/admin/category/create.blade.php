@extends('admin.layout.master')

@section('content')
    
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @include('admin.layout.error')
                        <div class="form-group">
                            <label for="title">Category Title</label>
                            <input name="title" class="form-control" id="title"
                        placeholder="Enter Title" required value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="parent">Parent Category</label>
                            <select name="category_id" class="form-control" id="parent">
                                <option value="">Select a Parent Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
