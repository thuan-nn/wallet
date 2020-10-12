<?php

namespace App\Http\Controllers\Api;

use App\Filters\CategoryWalletFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryWalletRequest;
use App\Http\Requests\CreateCategoryWalletRequest;
use App\Http\Requests\UpdateCategoryWalletRequest;
use App\Models\CategoryWallet;
use App\Sorts\CategoryWalletSort;
use App\Transformers\CategoryWalletTransformer;
use Illuminate\Http\Request;

class CategoryWalletController extends Controller {

    public function __construct() {
        $this->middleware(['auth:api'])->except('login');
    }

    /**
     * @param Request              $request
     * @param CategoryWalletFilter $categoryWalletFilter
     * @param CategoryWalletSort   $categoryWalletSort
     */
    public function index(Request $request, CategoryWalletFilter $categoryWalletFilter, CategoryWalletSort $categoryWalletSort) {
        $categoryWallet = CategoryWallet::query()->filter($categoryWalletFilter)
                                        ->sortBy($categoryWalletSort)
                                        ->paginate((int)$request->get('perPage', 10));

        return responder()->success($categoryWallet, CategoryWalletTransformer::class);
    }

    /**
     * @param CreateCategoryWalletRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryWalletRequest $request) {
        $data = $request->validated();
        $categoryWallet = CategoryWallet::query()->create($data);

        return responder()->success($categoryWallet, CategoryWalletTransformer::class)->respond();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $categoryWallet = CategoryWallet::query()->findOrFail($id);

        return responder()->success($categoryWallet, CategoryWalletTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryWalletRequest $request, $id) {
        $data = $request->validated();
        $categoryWallet = CategoryWallet::query()->findOrFail($id);
        $categoryWallet->update($data);

        return responder()->success($categoryWallet, CategoryWalletTransformer::class)->respond();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id) {
        $categoryWallet = CategoryWallet::query()->findOrFail($id);
        $categoryWallet->delete();

        return responder()->success()->respond();
    }
}
