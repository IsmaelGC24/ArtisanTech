<?php

namespace App\Http\Controllers;

use App\Util\AlliedStore;
use Illuminate\View\View;

class AlliedStoreController extends Controller
{
    public function index(): View
    {
        $store = app(AlliedStore::class);

        $viewData = [];
        $viewData['products'] = $store->getProducts();
        $viewData['stale'] = $store->isStale();

        return view('store.allies.index')->with('viewData', $viewData);
    }
}
