<?php

namespace App\Services;

use App\Models\FinancesModel;
use App\Models\ProductsModel;
use App\Models\SalesModel;
use App\Models\TasksModel;
use App\Queries\SettingsQueries;
use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Support\Facades\DB;

class CalculateCashService
{
    /**
     * @return mixed
     */
    public function loadCountCashTurnover(): mixed
    {
        $products = ProductsModel::all();
        $sales = SalesModel::all();
        $finances = FinancesModel::all();

        $productSum = 0;
        $salesSum = 0;
        $financesSum = 0;

        foreach ($products as $product) {
            $productSum += $product->price * $product->count;
        }

        foreach ($finances as $finance) {
            $financesSum += $finance->net;
        }

        foreach ($sales as $sale) {
            $salesSum += $sale->price * $sale->quantity;
        }

        $officialSum = $productSum + $salesSum + $financesSum;

        return Money::{SettingsQueries::getSettingValue('currency')}($officialSum);
    }

    /**
     * @return mixed
     */
    public function loadCountTodayIncome(): mixed
    {
        $products = ProductsModel::whereDate('created_at', Carbon::today())->get();
        $sales = SalesModel::whereDate('created_at', Carbon::today())->get();
        $finances = FinancesModel::whereDate('created_at', Carbon::today())->get();
        $productSum = 0;
        $salesSum = 0;
        $financesSum = 0;

        foreach ($products as $product) {
            $productSum += $product->price * $product->count;
        }

        foreach ($sales as $sale) {
            $salesSum += $sale->price * $sale->quantity;
        }
        foreach ($finances as $finance) {
            $financesSum += $finance->net;
        }

        $todayIncome = $productSum + $salesSum + $financesSum;

        return Money::{SettingsQueries::getSettingValue('currency')}($todayIncome);
    }

    /**
     * @return mixed
     */
    public function loadCountYesterdayIncome(): mixed
    {
        $products = ProductsModel::whereDate('created_at', Carbon::yesterday())->get();
        $sales = SalesModel::whereDate('created_at', Carbon::yesterday())->get();
        $finances = FinancesModel::whereDate('created_at', Carbon::yesterday())->get();
        $salesSum = 0;
        $productSum = 0;
        $financesSum = 0;

        foreach ($products as $product) {
            $productSum += $product->price * $product->count;
            foreach ($sales as $sale) {
                $salesSum += $product->price * $sale->quantity;
            }
            foreach ($finances as $finance) {
                $financesSum += $finance->net;
            }
        }

        $yesterdayIncome = $productSum + $salesSum + $financesSum;

        return Money::{SettingsQueries::getSettingValue('currency')}($yesterdayIncome);
    }

    /**
     * @return int
     */
    public function loadCountAllRowsInDb(): int
    {
        $counter = 0;
        $tables = DB::select('SHOW TABLES');

        $databaseName = DB::connection()->getDatabaseName();

        foreach ($tables as $table) {
            $counter += DB::table($table->{'Tables_in_' . $databaseName})->count();
        }

        return $counter;
    }

    public function loadTaskEveryMonth($isCompleted)
    {

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('Y-m-d');
            $dates->put($date, 0);
        }

        if ($isCompleted) {
            $posts = TasksModel::where('created_at', '>=', $dates->keys()->first())->where('completed', '=', 1)
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                    DB::raw('DATE( created_at ) as date'),
                    DB::raw('COUNT( * ) as "count"')
                ])
                ->pluck('count', 'date');
        } else {
            $posts = TasksModel::where('created_at', '>=', $dates->keys()->first())
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                    DB::raw('DATE( created_at ) as date'),
                    DB::raw('COUNT( * ) as "count"')
                ])
                ->pluck('count', 'date');
        }

        $dates = $dates->merge($posts)->toArray();

        return array_values($dates);
    }
}
