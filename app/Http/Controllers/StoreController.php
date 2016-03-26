<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Store;
use App\Http\Requests;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::paginate(15);

        return view('stores', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        Store::create($data);

        return redirect('store')->with('success', 'Successfully added store!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::find($id);

        return view('show_store', ['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);

        return view('store', ['store' => $store]);
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
        if ($request->has('restore')) {
            Store::onlyTrashed()->where('id', $id)->restore();

            return redirect('store')->with('success', 'Successfully restored store!');
        }

        $newData = $request->except('_token');

        $store = Store::find($id);
        $store->update($newData);

        return redirect()
            ->route('store.edit', ['id' => $store->id])
            ->with('success', 'Successfully updated store!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::destroy($id);

        return redirect('store')->with('success', 'Successfully deleted store!');
    }

    public function deleted()
    {
        $deletedStores = Store::onlyTrashed()->paginate(15);

        return view('stores', ['stores' => $deletedStores]);
    }

    public function apiIndex()
    {
        return response()->json(Store::all());
    }

    public function apiGetDetails($id)
    {
        $storeWithDetails = Store::with('fruits')->where('id', $id)->first();

        return response()->json($storeWithDetails);
    }
}
