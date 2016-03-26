<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Store;
use App\Http\Requests;

class InventoryController extends Controller
{
    public function index()
    {
    	return view('inventory');
    }

    public function save(Request $request)
    {
    	$data = $request->except('_token');

    	$store = Store::find($data['store']);

    	$mapValues = function ($price) {
    		return ['price' => floatval($price)];
    	};

    	$productMap = array_combine($data['products'], array_map($mapValues, $data['prices']));

    	$store->fruits()->sync($productMap);

		return redirect('inventory');
    }
}
