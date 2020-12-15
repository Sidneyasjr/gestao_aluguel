<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer as CustomerRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        $customerCreate = Customer::create($request->all());

        return redirect()->route('admin.customers.edit', [
            'customer' => $customerCreate->id,
        ])->with(['color' => 'green', 'message' => 'Cliente cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|Application|Response|View
     */
    public function edit($id)
    {
        $customer = Customer::where('id', $id)->first();

        return view('admin.customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CustomerRequest $request, $id): RedirectResponse
    {
        $customer = Customer::where('id', $id)->first();
        $customer->fill($request->all());
        $customer->save();


        return redirect()->route('admin.customers.edit', [
            'customer' => $customer->id,
        ])->with(['color' => 'green', 'message' => 'Cliente atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
