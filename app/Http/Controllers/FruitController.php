<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Fruit;
use App\Http\Requests;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fruits = Fruit::paginate(15);

        return view('fruits', ['fruits' => $fruits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fruit');
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

        Fruit::create($data);

        return redirect('fruit')->with('success', 'Successfully added fruit!');
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
        $fruit = Fruit::find($id);

        return view('fruit', ['fruit' => $fruit]);
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
            Fruit::onlyTrashed()->where('id', $id)->restore();

            return redirect('fruit')->with('success', 'Successfully restored fruit!');
        }

        $newData = $request->except('_token');

        $fruit = Fruit::find($id);
        $fruit->update($newData);

        return redirect()
            ->route('fruit.edit', ['id' => $fruit->id])
            ->with('success', 'Successfully updated fruit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fruit::destroy($id);

        return redirect('fruit')->with('success', 'Successfully deleted fruit!');
    }

    public function deleted()
    {
        $deletedFruits = Fruit::onlyTrashed()->paginate(15);

        return view('fruits', ['fruits' => $deletedFruits]);
    }
}
