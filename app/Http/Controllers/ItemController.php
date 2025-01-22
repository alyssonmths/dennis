<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function list($filtro = '') {
        $itens = Item::all();

        return view('precos', compact('itens'));
    }
    
    public function registrar(Request $request) {
        Item::create($request->all());
        return redirect()->back();
    }

    public function apagar(Request $request) {
        $id_item = $request->input('id_item');
        Item::destroy($id_item);
    }

    public function editar($id) {
        $item = Item::findOrFail($id);
        return view('subviews/editar', compact('item'));
    }

    public function update(Request $request) {
        $item = Item::find($request->input('id'));
        $item->update($request->all());
        return redirect()->route('item.precos');
    }
}
