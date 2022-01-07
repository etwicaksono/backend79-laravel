<?php

namespace App\Http\Controllers;

use App\Models\NasabahModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NasabahController extends Controller
{
    public function index()
    {
        return view("list-nasabah");
    }

    public function showAllNasabah()
    {
        try {
            return \response()->json(NasabahModel::orderBy("account_id", "desc")->get(), http_response_code());
        } catch (Exception $e) {
            return \response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], \http_response_code());
        }
    }

    public function nasabahForSelect2(Request $request)
    {
        try {
            if ($request->search != "") {
                // $nasabah = DB::table('nasabah')
                //     ->where("name", "like", "%" . $request->search . "%")
                //     ->orderBy("name", "asc")
                //     ->get();

                $nasabah = NasabahModel::orderBy("name", "asc")->where("name", "like", "%" . $request->search . "%")->get();
            } else {
                $nasabah = NasabahModel::orderBy("name", "asc")->get()->take(10);
            }

            $result = [];
            foreach ($nasabah as $key => $val) {
                $result[$key]["id"] = $val->account_id;
                $result[$key]["text"] = $val->name;
            }

            return \response()->json($result, http_response_code());
        } catch (Exception $e) {
            return \response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], \http_response_code());
        }
    }

    public function insertNasabah(Request $request)
    {
        try {
            NasabahModel::create($request->all());

            return \response()->json([
                "status" => "OK",
                "code" => 201,
                "latest_data" => NasabahModel::orderBy("account_id", "desc")->latest()
            ], http_response_code());
        } catch (Exception $e) {
            return \response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], \http_response_code());
        }
    }

    public function json()
    {
        try {
            return DataTables::of(NasabahModel::query())->toJson();
        } catch (Exception $e) {
            return \response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], \http_response_code());
        }
    }
}