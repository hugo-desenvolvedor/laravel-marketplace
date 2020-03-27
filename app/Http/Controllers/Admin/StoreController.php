<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use Illuminate\Http\Request;

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
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $stores = $this->store->paginate(10);

        return view('admin.stores.index', compact('stores'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user']);
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
     * @param Request $request
     * @param $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $store)
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
