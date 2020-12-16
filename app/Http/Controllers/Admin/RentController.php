<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Http\Controllers\Controller;
use App\Rent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class RentController
 * @package App\Http\Controllers\Admin
 */
class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $rents = Rent::all();
        $contracts = Contract::all();
        return view('admin.management.rent', [
            'rents' => $rents,
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $rent = Rent::where('id', $id)->first();
        $rent->fill($request->all());

        $rent->status = ($rent->status == "paid" ? "unpaid" : "paid");
        $rent->save();

        $json['status'] = $rent->status;

        return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function onpaid(Request $request, $id)
    {
        $rent = Rent::where('id', $id)->first();
        $rent->fill($request->all());

        $rent->status = ($rent->status == "paid" ? "unpaid" : "paid");
        $rent->save();

        $json['status'] = $rent->status;

        return response()->json($json);
    }
}
