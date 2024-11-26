<?php

namespace App\Jobs\Finance;

use App\Models\AdminModel;
use App\Models\FinancesModel;
use App\Services\FinancesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreFinanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $validatedData;
    private AdminModel $admin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $validatedData, AdminModel $admin)
    {
        $this->validatedData = $validatedData;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $financesHelper = new FinancesService();
        $dataToInsert = $financesHelper->loadCalculateNetAndVatByGivenGross($this->validatedData['gross']);

        $model = new FinancesModel();

        foreach ($this->validatedData as $key => $value) {
            $model->$key = $value;
        }

        $model->admin_id = $this->admin->id;

        $model->net = $dataToInsert['net'];
        $model->vat = $dataToInsert['vat'];

        $model->date = now();

        $model->save();
    }
}
