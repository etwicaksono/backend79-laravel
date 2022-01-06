@extends('layout.app',["title"=>"Customer Point"])

@section('content')
<p class="h1 my-5">Show Customer Point</p>

<table id="main-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Account ID</th>
            <th>Name</th>
            <th>Total Point</th>
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

    $.ajax({
        url: baseurl + "cek-poin",
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
                console.log(val)
                result += `
                <tr>
                    <td>` + (key + 1) + `</td>
                    <td>` + val.account_id + `</td>
                    <td>` + val.name + `</td>
                    <td>` + val.point + `</td>
                </tr>
                `
            })
            $("#main-table tbody").html(result)
        }
    })
});
</script>
@endpush