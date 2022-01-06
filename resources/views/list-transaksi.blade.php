@extends('layout.app',["title"=>"Data Transaksi","csrf"=>true])

@section('content')
<p class="h1 my-5">Transaction Data</p>

<div class="row mb-3">
    <div class="col-12">
        <div class="form-group float-left">
            <label for="account" class="form-label">Account</label>
            <select name="user" id="user" class="form-control">
            </select>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right btn-modal-trigger">
            Add Transaction
        </button>
    </div>
</div>
<table id="main-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Account ID</th>
            <th>Transaction Date</th>
            <th>Description</th>
            <th>Debit/Credit</th>
            <th>Amount</th>
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
                <h5 class="modal-title" id="nasabahModalLabel">Add Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="transaction_date" class="form-label">Transaction Data</label>
                    <input id="transaction_date" type="text" class="form-control" />
                    <small class="text-danger error-text error-transaction_date d-none">Description must be
                        filled</small>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <select class="form-control" id="description" aria-describedby="description">
                        <option value="">Pilih Transaksi</option>
                        <option value="C">Setor Tunai</option>
                        <option value="D">Beli Pulsa</option>
                        <option value="D">Bayar Listrik</option>
                    </select>
                    <small class="text-danger error-text error-description d-none">Description must be
                        filled</small>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" aria-describedby="amount">
                    <small class="text-danger error-text error-amount d-none">Amount must be filled</small>
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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
    let baseurl = "{{url("/")}}/"

    // trigger modal
    $(".btn-modal-trigger").on("click", function() {
        if ($("#user").val() == null) {
            Swal.fire(
                'Attention!',
                'You have to choose account first!',
                'warning'
            )
            return false
        }

        $("#description").val("")
        $("#amount").val("")
        $(".error-text").addClass("d-none")
        $("#nasabahModal").modal("show")
    })

    // klik submit
    $(".btn-submit").on("click", function() {
        let type = $("#description").val()
        let description = $("#description option:selected").text()
        let amount = $("#amount").val()
        let transaction_date = $("#transaction_date").val()



        if (transaction_date == "") {
            $(".error-transaction_date").removeClass("d-none")
            return false
        } else {
            $(".error-transaction_date").addClass("d-none")
        }

        if (type == "") {
            $(".error-description").removeClass("d-none")
            return false
        } else {
            $(".error-description").addClass("d-none")
        }

        if (amount == "") {
            $(".error-amount").removeClass("d-none")
            return false
        } else {
            $(".error-amount").addClass("d-none")
        }

        $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            url: baseurl + "transaksi",
            method: "post",
            dataType: "json",
            data: {
                user_id: $("#user").val(),
                description: description,
                type: type,
                amount: amount,
                transaction_date: transaction_date,
            },
            error: function(err) {
                console.log(err)
            },
            success: function(res) {
                console.log(res)
                updateTable()
                $("#nasabahModal").modal("hide")
            }
        })
    })

    // select user
    $("#user").select2({
        ajax: {
            url: baseurl + 'select-nasabah',
            dataType: 'json',
            delay: 100,
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        },
        placeholder: "Pilih User",
        allowClear: false,
        width:"100%"
    }).on("select2:select", function() {
        updateTable()
    })

    // transaction date
    $('#transaction_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd-mm-yyyy",
        change: function() {
            updateTable()
        }
    });

    function updateTable() {
        let user = $("#user").val()

        if (user != null) {
            $.ajax({
                url: baseurl + "transaksi",
                data: {
                    user: user
                },
                type: "get",
                dataType: "json",
                error: function(err) {
                    console.log("error")
                    console.log(err)
                },
                success: function(res) {
                    let result = ""

                    if (res.length == 0) {
                        $(".no-data").removeClass("d-none")
                    } else {
                        $(".no-data").addClass("d-none")
                    }
                    $.each(res, function(key, val) {
                        result += `
                    <tr>
                        <td>` + (key + 1) + `</td>
                        <td>` + val.account_id + `</td>
                        <td>` + val.transaction_date + `</td>
                        <td>` + val.description + `</td>
                        <td>` + val.type + `</td>
                        <td>` + val.amount + `</td>
                    </tr>
                    `
                    })
                    $("#main-table tbody").html(result)


                }
            })
        }
    }
    updateTable()
});
</script>
@endpush