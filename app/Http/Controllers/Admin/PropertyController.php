<?php

namespace App\Http\Controllers\Admin;

use App\Owner;
use App\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Property as PropertyRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties.index', [
            'properties' => $properties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $owners = Owner::orderBy('name')->get();
        return view('admin.properties.create', [
            'owners' => $owners,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return RedirectResponse
     */
    public function store(PropertyRequest $request)
    {
        $createProperty = Property::create($request->all());

        return redirect()->route('admin.properties.edit', [
            'property' => $createProperty->id,
        ])->with(['color' => 'green', 'message' => 'Imóvel cadastrado com sucesso!']);
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
        $property = Property::where('id', $id)->first();
        $owners = Owner::orderBy('name')->get();

        return view('admin.properties.edit', [
            'property' => $property,
            'owners' => $owners,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $property = Property::where('id', $id)->first();
        $property->fill($request->all());
        $property->save();

        return redirect()->route('admin.properties.edit', [
            'property' => $property->id,
        ])->with(['color' => 'green', 'message' => 'Imóvel alterado com sucesso!']);
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
