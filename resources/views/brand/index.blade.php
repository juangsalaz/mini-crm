@extends('layout_cms._layouts')
@section('brand')
    active
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Brand List</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('add-brand')}}" type="button" class="btn-sm btn-primary"><i class="fa fa-plus"></i> Add new brand</a>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Brand Name</th>
                            <th>Website</th>
                            <th>Select</th>
                            </tr>
                        </thead>
                        @if ($brands->isNotEmpty())                            
                            @foreach ($brands as $brand)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            @if ($brand->website == NULL)
                                                No website
                                            @else
                                                {{$brand->website}}
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn-sm btn-danger" data-target="#modal" data-record-id="{{$brand->id}}" data-toggle="modal"><i class="fa fa-xs fa-trash"></i></a>
                                            <a href="{{route('edit-brand', $brand->id)}}" class="btn-sm btn-info"><i class="fa fa-xs fa-user-edit"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center"><strong>Data not found</strong></td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
                <div class="card-footer">
                    {{ $brands->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="min-height: 220px;">
            <div class="modal-header">
                <h5>Delete Confirmation</h5>
            </div>
            <div class="modal-body">
                <h6>Are you sure to delete this brand?</h6>
                <div style="margin-top: 30px">
                    <button type="button" class="btn btn-danger btn-block btn-delete"><strong>Delete</strong></button>
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    // Delete Modal 
    $('#modal').on('click', '.btn-delete', function(e) {
        var $modalDiv = $(e.delegateTarget);
        var id = $(this).data('recordId');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var route = "{{route('delete-brand', ":id")}}";
        route = route.replace(':id', id);
        $.post(route).then()
        $modalDiv.addClass('loading');
        setTimeout(function() {
            $modalDiv.modal('hide').removeClass('loading');
            location.reload();
        });
    });

    $('#modal').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.title', this).text(data.recordTitle);
        $('.btn-delete', this).data('recordId', data.recordId);
    });
</script>
@endsection