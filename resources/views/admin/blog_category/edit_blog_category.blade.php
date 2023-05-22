@extends('admin.admin_master')
@section('admin')


    {{--    jquery cdn--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Blog Category</h4>
                            <form method="post" action="{{ route('update.blog.category',$blogcategory->id), }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{  $blogcategory->id }}">


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> Update Category </label>
                                    <div class="col-sm-10">
                                        <input name="blog_category" value="{{  $blogcategory->blog_category }}" class="form-control" type="text"  id="example-text-input">
                                        @error('blog_category')
                                        <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                </div>

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Category ">

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>






@endsection







