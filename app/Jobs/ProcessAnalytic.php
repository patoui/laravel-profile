<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ProcessAnalytic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array */
    private array $request_data;

    /** @var Model */
    private Model $model;

    /**
     * Create a new job instance.
     *
     * @param array $request_data
     * @param Model $model
     */
    public function __construct(array $request_data, Model $model)
    {
        $this->request_data = $request_data;
        $this->model        = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        if (method_exists($this->model, 'analytics')) {
            $headers = $this->getHeaders();
            $now     = Carbon::now();
            $this->model->analytics()->create([
                'headers'    => $headers,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Get headers from request data
     * @return string|null
     */
    private function getHeaders(): ?string
    {
        if (!empty($this->request_data['headers'])) {
            return json_encode($this->request_data['headers']) ?: null;
        }

        return null;
    }
}
