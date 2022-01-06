@extends('layout.app',["title"=>"Report Buku Tabungan"])

@section('content')
<p class="h1 my-5">Report Buku Tabungan</p>

<div class="row mb-3">
    <div class="col-4">
        <div class="form-group">
            <div class="input-group">
                <label for="user">Account</label>
                <select name="user" id="user" class="form-control">
                </select>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <div class="input-group">
                <label for="start-date">Start Date</label>
                <input id="start-date" type="text" class="form-control" />
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <div class="input-group">
                <label for="end-date">End Date</label>
                <input id="end-date" type="text" class="form-control" />
            </div>
        </div>
    </div>
</div>

<table id="main-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Transaction Date</th>
            <th>Description</th>
            <th>Credit</th>
            <th>Debit</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<p class="h1 text-center no-data d-none">No Data Available</p>
@endsection

@push('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush


@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>


<script>
    $(document).ready(function() {
    let baseurl = "{{url("/")}}/"

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
        width: "100%",
        allowClear: true
    }).on("change", function(e) {
        updateTable()
    })


    // start date
    $('#start-date').datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd-mm-yyyy",
        change: function() {
            updateTable()
        }
    });

    // end date
    $('#end-date').datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd-mm-yyyy",
        change: function() {
            updateTable()
        }
    });



    function updateTable() {
        let user = $("#user").val()
        let start = $("#start-date").val()
        let end = $("#end-date").val()

        if (user != null && start != "" && end != "") {
            $.ajax({
                url: baseurl + "cetak-tabungan",
                data: {
                    start: start,
                    end: end,
                    user: user
                },
                type: "post",
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
                        console.log(val)
                        result += `
                    <tr>
                        <td>` + (key + 1) + `</td>
                        <td>` + val.transaction_date + `</td>
                        <td>` + val.description + `</td>
                        <td>` + (val.type == "C" ? val.amount : "-") + `</td>
                        <td>` + (val.type == "D" ? val.amount : "-") + `</td>
                        <td>` + val.amount + `</td>
                    </tr>
                    `
                    })
                    $("#main-table tbody").html(result)
                }
            })
        }
    }
});
</script>
@endpush