<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaction = DB::table("transaksi AS t")
            ->leftJoin("nasabah AS n", "t.user_id", "=", "n.account_id")
            ->select("n.account_id", "n.name", "t.transaction_date", "t.description", "t.type", "t.amount")
            ->where("account_id", $request->user)
            ->get();

        foreach ($transaction as $tr) {
            $tr->transaction_date = \date("Y-m-d", \strtotime($tr->transaction_date));
            $tr->amount = \number_format($tr->amount, 0, ",", ".");
        }
        return \response()->json($transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TransaksiModel::create([
            "user_id" => $request->user_id,
            "transaction_date" => \date_parser($request->transaction_date) . " " . date("H:i:s"),
            "description" => $request->description,
            "type" => $request->type,
            "amount" => $request->amount,
        ]);
        return \response()->json([
            "status" => "OK",
            "latest_data" => TransaksiModel::orderBy("id", "desc")->first()
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_point()
    {
        $transaction = DB::table("transaksi AS t")
            ->leftJoin("nasabah AS n", "t.user_id", "=", "n.account_id")
            ->select("n.account_id", "n.name", "t.transaction_date", "t.description", "t.type", "t.amount")
            ->where("t.type", "=", "D")
            ->whereRaw("TRIM(LOWER(t.description)) LIKE?", ["beli pulsa%"])
            ->orWhere("t.type", "=", "D")
            ->whereRaw("TRIM(LOWER(t.description)) LIKE?", ["bayar listrik%"])
            ->get();

        foreach ($transaction as $tr) {
            $tr->point = get_point($tr->description, $tr->amount);
        }

        $transaction_arr = json_decode($transaction, true);
        $result = [];

        foreach ($transaction_arr as $tr) {
            $idx = array_search($tr["account_id"], \array_column($result, "account_id"));
            if ($idx === false) {
                $result[] = $tr;
            } else {
                $result[$idx]["point"] += $tr["point"];
            }
        }


        return \response()->json($result, 201);
    }

    public function print_tabungan(Request $request)
    {
        $start = date_parser($request->start) . " 00:00:00";
        $end = date_parser($request->end) . " 23:59:59";
        $transaction = DB::table("transaksi AS t")
            ->leftJoin("nasabah AS n", "t.user_id", "=", "n.account_id")
            ->select("n.account_id", "n.name", "t.transaction_date", "t.description", "t.type", "t.amount")
            ->where("t.transaction_date", ">=", $start)
            ->where("t.transaction_date", "<=", $end)
            ->where("account_id", $request->user)
            ->get();

        return \response()->json($transaction, 201);
    }
}