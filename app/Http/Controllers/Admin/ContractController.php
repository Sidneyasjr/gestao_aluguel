<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Customer;
use App\Owner;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contract as ContractRequest;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $contracts = Contract::all();

        return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $properties = Property::where('status', 1);
        $customers = Customer::all();
        $owners = Owner::all();

        return view('admin.contracts.create', [
            'properties' => $properties,
            'customers' => $customers,
            'owners' => $owners
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContractRequest $request
     * @param $contactCreate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContractRequest $request)
    {
        $contractCreate = Contract::create($request->all());
         return redirect()->route('admin.contracts.edit', [
            'contract' => $contractCreate->id
        ])->with(['color' => 'green', 'message' => 'Contrato cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $owners = Owner::all();
        $customers = Customer::all();
        $contract = Contract::where('id', $id)->first();

        return view('admin.contracts.edit', [
            'owners' => $owners,
            'customers' => $customers,
            'contract' => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContractRequest $request, $id)
    {
        $contract = Contract::where('id', $id)->first();
        $contract->fill($request->all());
        $contract->save();

        if($request->property) {
            $property = Property::where('id', $request->property)->first();

            if($request->status === 'active') {
                $property->status = 0;
                $property->save();
            } else {
                $property->status = 1;
                $property->save();
            }
        }

        return redirect()->route('admin.contracts.edit', [
            'contract' => $contract->id
        ])->with(['color' => 'green', 'message' => 'Contrato editado com sucesso!']);
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

    public function getDataOwner(Request $request)
    {
        $owner = Owner::where('id', $request->owner)->first([
            'id',
        ]);

        if (empty($owner)) {
            $properties = null;
        } else {


            $getProperties = $owner->properties()->get();

            $properties = [];
            foreach($getProperties as $property) {
                $properties[] = [
                    'id' => $property->id,
                    'description' => '#' . $property->id . ' ' . $property->street . ', ' .
                        $property->number . ' ' . $property->neighborhood . ' ' .
                        $property->city . '/' . $property->state . ' (' . $property->zipcode . ')'
                ];
            }
        }

        $json['properties'] = (!empty($properties) ? $properties : null);

        return response()->json($json);
    }

    public function getDataProperty(Request $request)
    {
        $property = Property::where('id', $request->property)->first();

        if(empty($property)){
            $property = null;
        } else {
            $property = [
                'id' => $property->id
            ];
        }

        $json['property'] = $property;
        return response()->json($json);
    }



}
