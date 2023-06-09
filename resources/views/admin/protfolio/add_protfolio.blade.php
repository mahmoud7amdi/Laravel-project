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
                            <h4 class="card-title">Protfolio Page</h4>
                            <form method="post" action="{{ route('store.protfolio') }}" enctype="multipart/form-data">
                                @csrf



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Protfolio Name </label>
                                    <div class="col-sm-10">
                                        <input name="protfolio_name" class="form-control" type="text"  id="example-text-input">
                                        @error('protfolio_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Protfolio Title</label>
                                    <div class="col-sm-10">
                                        <input name="protfolio_title" class="form-control" type="text"  id="example-text-input">
                                        @error('protfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Protfolio Description</label>
                                    <div class="col-sm-10">
                                        <textarea required="" name="protfolio_description" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>






                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Protfolio Image</label>
                                    <div class="col-sm-10">
                                        <input name="protfolio_image" class="form-control" type="file"  id="image">
                                    </div>
                                </div>







                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded-circle avatar-xl" src="{{ url('upload/No_Image_Available.jpg') }}" alt="Card image cap">                                </div>
                                </div>

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Protfolio">

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>



    {{--    show image when change it--}}
    <script type="text/javascript">
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src',e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>



@endsection







