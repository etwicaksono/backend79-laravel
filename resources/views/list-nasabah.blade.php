@extends('layout.app',["title"=>"Customer Data","csrf"=>true])

@section("content")
<p class="h1 my-5">Customer Data</p>

<div class="row mb-3">
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-end btn-modal-trigger" data-toggle="modal"
            data-target="#nasabahModal">
            Add Customer
        </button>
    </div>
</div>
<table id="main-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Account ID</th>
            <th>Name</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<p class="h1 text-center no-data d-none">No Data Available</p>

<!-- Modal -->
<div class="modal fade" id="nasabahModal" tabindex="-1" aria-labelledby="nasabahModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nasabahModalLabel">Add Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name">
                    <small class="text-danger error-text error-name d-none">Name must be filled</small>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" aria-describedby="address">
                    <small class="text-danger error-text error-address d-none">Address must be filled</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        let baseurl = "{{url("/")}}/"

        // trigger modal
        $(".btn-modal-trigger").on("click", function() {
            $("#name").val("")
            $("#address").val("")
            $(".error-text").addClass("d-none")
        })

        // DataTable
        let table = $('#main-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('nasabah.data') !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'account_id',
                        name: 'account_id'
                    },
                    {
                        data: 'account_id',
                        name: 'account_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    }
                ]
            })

        // klik submit
        $(".btn-submit").on("click", function() {
            let name = $("#name").val()
            let address = $("#address").val()

            if (name == "") {
                $(".error-name").removeClass("d-none")
                return false
            } else {
                $(".error-name").addClass("d-none")
            }

            if (address == "") {
                $(".error-address").removeClass("d-none")
                return false
            } else {
                $(".error-address").addClass("d-none")
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: baseurl + "nasabah",
                method: "post",
                dataType: "json",
                data: {
                    name: name,
                    address: address
                },
                error: function(err) {
                    console.log(err)
                },
                success: function(res) {
                    console.log(res)
                    table.ajax.reload()
                    $("#nasabahModal").modal("hide")
                }
            })
        })

        
    });
</script>
@endpush

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush