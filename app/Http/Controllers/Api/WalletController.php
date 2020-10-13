<?php

namespace App\Http\Controllers\Api;

use App\Filters\WalletFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;
use App\Sorts\WalletSort;
use App\Transformers\WalletTransformer;
use Illuminate\Http\Request;

class WalletController extends Controller {
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    /**
     * @param Request      $request
     * @param WalletFilter $walletFilter
     * @param WalletSort   $walletSort
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, WalletFilter $walletFilter, WalletSort $walletSort) {
        $wallets = Wallet::query()->filter($walletFilter)->sortBy($walletSort)->paginate((int)$request->get('perPage', 15));

        return responder()->success($wallets, WalletTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateWalletRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateWalletRequest $request) {
        $data = $request->validated();
        $wallet = auth()->user()->wallets()->create($data);

        return responder()->success($wallet, WalletTransformer::class)->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $wallet = auth()->user()->wallets()->findOrFail($id);

        return responder()->success($wallet, WalletTransformer::class)->respond();
    }

    /**
     * @param UpdateWalletRequest $request
     * @param                     $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateWalletRequest $request, $id) {
        $data = $request->validated();
        auth()->user()->wallets()->findOrFail($id)->update($data);

        return responder()->success()->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        auth()->user()->wallets()->findOrFail($id)->delete();

        return responder()->success()->respond();
    }
}
