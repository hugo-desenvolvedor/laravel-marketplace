<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    private $store;

    /**
     * StoreController constructor.
     * @param $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.stores.create', compact('users'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $store = $user->store()->create($data);

        flash(__('Store created with success'))->success();
        return redirect()->route('admin.stores.index');
    }

    /**
     * @param $store
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($store)
    {
        $store = $this->store->findOrFail($store);

        return view('admin.stores.edit', compact('store'));
    }

    /**
     * @param StoreRequest $request
     * @param $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();
        $store = $this->store->find($store);
        $store->update($data);

        flash(__('Store updated with success'))->success();
        return redirect()->route('admin.stores.index');
    }

    /**
     * @param $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($store)
    {
        $store = $this->store->find($store);
        $store->delete();

        flash(__('Store deleted with success'))->success();
        return redirect()->route('admin.stores.index');
    }
}
