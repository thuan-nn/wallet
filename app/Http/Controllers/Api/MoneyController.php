<?php

namespace App\Http\Controllers\Api;

use App\Action\CreateMoneyAction;
use App\Events\UpdateSurplusAmountEvent;
use App\Filters\MoneyFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMoneyRequest;
use App\Http\Requests\UpdateMoneyRequest;
use App\Models\Money;
use App\Sorts\MoneySort;
use App\Transformers\MoneyTransformer;
use Illuminate\Http\Request;

class MoneyController extends Controller {
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    /**
     * @param Request     $request
     * @param MoneyFilter $moneyFilter
     * @param MoneySort   $moneySort
     */
    public function index(Request $request, MoneyFilter $moneyFilter, MoneySort $moneySort) {
        $moneys = Money::query()->filter($moneyFilter)->sortBy($moneySort)->paginate((int)$request->get('perPage', 15));

        return responder()->success($moneys, MoneyTransformer::class)->respond();
    }

    /**
     * @param CreateMoneyRequest $request
     *
     * @param CreateMoneyAction  $createMoneyAction
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMoneyRequest $request, CreateMoneyAction $createMoneyAction) {
        $data = $request->validated();
        $money = $createMoneyAction->execute($data, auth()->user());

        return responder()->success($money, MoneyTransformer::class)->respond();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $money = auth()->user()->moneys()->findOrFail($id);

        return responder()->success($money, MoneyTransformer::class)->respond();
    }

    /**
     * @param UpdateMoneyRequest $request
     * @param                    $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMoneyRequest $request, $id) {
        $data = $request->validated();
        $money = auth()->user()->moneys()->findOrFail($id);
        $money->update($data);

        if ($money) {
            event(new UpdateSurplusAmountEvent($money->wallet, $money->type, $money->amount));
        }

        return responder()->success($money, MoneyTransformer::class)->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        auth()->user()->moneys()->findOrFail($id)->delete();

        return responder()->success()->respond();
    }
}
