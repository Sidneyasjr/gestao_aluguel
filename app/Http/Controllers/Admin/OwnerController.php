<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Owner;
use App\Http\Requests\Admin\Owner as OwnerRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $owners = Owner::all();
        return view('admin.owners.index', [
            'owners' => $owners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OwnerRequest $request
     * @return RedirectResponse
     */
    public function store(OwnerRequest $request): RedirectResponse
    {
        $ownerCreate = Owner::create($request->all());
        return redirect()->route('admin.owners.edit', [
            'owner' => $ownerCreate->id
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
        $owner = Owner::where('id', $id)->first();
        return view('admin.owners.edit', [
            'owner' => $owner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OwnerRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(OwnerRequest $request, $id): RedirectResponse
    {
        $owner = Owner::where('id', $id)->first();
        $owner->fill($request->all());
        $owner->save();

        return redirect()->route('admin.owners.edit', [
            'owner' => $owner->id,
        ])->with(['color' => 'green', 'message' => 'Proprietário atualizado com sucesso!']);
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
