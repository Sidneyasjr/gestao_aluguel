<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Customer;
use App\Rent;
use App\Owner;
use App\Property;
use App\Transfer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contract as ContractRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class ContractController
 * @package App\Http\Controllers\Admin
 */
class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|Response|View
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
     * @return Factory|Application|Response|View
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
     * @return RedirectResponse
     */
    public function store(ContractRequest $request)
    {
        $contractCreate = Contract::create($request->all());


        $tribute = floatval(str_replace(',', '.', str_replace('.', '', $contractCreate->tribute)));
        $rent_price = floatval(str_replace(',', '.', str_replace('.', '', $contractCreate->rent_price)));
        $adm_fee = floatval(str_replace(',', '.', str_replace('.', '', $contractCreate->adm_fee)));
        $condominium = floatval(str_replace(',', '.', str_replace('.', '', $contractCreate->condominium)));


        $data = explode("-",$contractCreate->start_at);
        $y = $data[0];
        $m = $data[1];
        $d = $data[2];

        $datePay = $y . '-' . $m . '-' . 1;
        $datePay = date("Y-m-d", strtotime($datePay . "+1month"));
        /** Mensalidades */
        for ($enrollment = 0; $enrollment < 12 ; $enrollment++) {
            $value = $rent_price + $tribute + $condominium;
            if ($enrollment == 0){
                $value = ($value / 30) * (31 - $d);
                $value = round($value, 2);
            }
            $rentCreate = Rent::create([
                'enrollment' => $enrollment + 1,
                'contract' => $contractCreate->id,
                'customer' => $contractCreate->customer,
                'value' => $value,
                'due_at' => date("Y-m-d", strtotime($datePay . "+{$enrollment}month")),
                'status' => 'unpaid'
            ]);
        }

        /** Repasse*/

        $dateTransfer = $y . '-' . $m . '-' . $contractCreate->ownerObject->day_transfer;
        $dateTransfer = date("Y-m-d", strtotime($dateTransfer . "+1month"));
//        dd($dateTransfer, $datePay);
        for ($enrollment = 0; $enrollment < 12 ; $enrollment++) {
            $value = $tribute + $rent_price - $adm_fee;
            if ($enrollment == 0){
                $value = ($value / 30) * (30 - $contractCreate->ownerObject->day_transfer);
                $value = round($value, 2);
            }
            $transferCreate = Transfer::create([
                'enrollment' => $enrollment + 1,
                'contract' => $contractCreate->id,
                'owner' => $contractCreate->owner,
                'value' => $value,
                'due_at' => date("Y-m-d", strtotime($dateTransfer . "+{$enrollment}month")),
                'status' => 'unpaid'
            ]);
        }

         return redirect()->route('admin.contracts.edit', [
            'contract' => $contractCreate->id
        ])->with(['color' => 'green', 'message' => 'Contrato cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|Application|Response|View
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
        $owners = Owner::all();
        $customers = Customer::all();
        $contract = Contract::where('id', $id)->first();
        $transfers = Transfer::where('contract', $id)->get();
        $rents = Rent::where('contract', $id)->get();

        return view('admin.contracts.edit', [
            'owners' => $owners,
            'customers' => $customers,
            'contract' => $contract,
            'transfers' => $transfers,
            'rents' => $rents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContractRequest $request
     * @param int $id
     * @return RedirectResponse
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataOwner(Request $request): JsonResponse
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataProperty(Request $request): JsonResponse
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
