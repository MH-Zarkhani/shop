@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('admin.layout.error')
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input name="name" class="form-control" id="title"
                        placeholder="Enter Title" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category[]" class="form-control select2" multiple="multiple" id="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" class="form-control" id="price"
                                   type="number" min="0" placeholder="Enter Price" required value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="count">Count</label>
                            <input name="count" class="form-control" id="count"
                                   type="number" min="0" placeholder="Enter Count" required value="{{ old('count') }}">
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input name="discount" class="form-control" id="discount"
                                   type="number" min="0" max="100" placeholder="Enter Discount" required value="{{ old('discount') }}">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input name="photo" class="form-control form-control-file" id="photo"
                                   type="file" placeholder="Enter Discount" value="{{ old('photo') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control textarea" id="description"
                                      type="text" placeholder="Enter Discount">{{ old('description') }}</textarea>
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

@section('scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.textarea').summernote();
        });
    </script>
@endsection
