<?php

namespace App\Jobs\Client;

use App\Models\ClientsModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $validatedData;
    private ClientsModel $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $validatedData, ClientsModel $client)
    {
        $this->validatedData = $validatedData;
        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->client->update($this->validatedData);
    }
}
