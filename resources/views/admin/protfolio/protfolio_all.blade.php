@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Protfolio All Data</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Protfolio All Data</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Protfolio Name </th>
                                    <th>Protfolio Title</th>
                                    <th>Protfolio Image</th>
                                    <th>Action</th>

                                </tr>
                                </thead>


                                <tbody>
                                @php($i=1)
                                @foreach($protfolio as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->protfolio_name }}</td>
                                        <td>{{ $item->protfolio_title }}</td>
                                        <td> <img src="{{ asset($item->protfolio_image) }}" style="width: 50px; height: 50px;" > </td>
                                        <td>
                                            <a href="{{ route('edit.protfolio', $item->id) }}" class="btn btn-info sm " title="Edit Data"> <i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.protfolio', $item->id) }}" class="btn btn-danger sm " id="delete" title="Delete Data"> <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->





        </div> <!-- container-fluid -->
    </div>

@endsection
