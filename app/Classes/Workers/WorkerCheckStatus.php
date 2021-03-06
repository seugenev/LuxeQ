<?php

namespace App\Classes\Workers;
use App\Interfaces\WorkerInterface;

/**
 * worker class to check the status of some process
 * Class WorkerCheckStatus
 * @package App\Classes\Workers
 */
class WorkerCheckStatus implements WorkerInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * method which do the work
     * @return void
     * @throws \Exception
     */
    public function doWork(): void
    {
        if ($this->checkProcess())
            echo __('messages', 'process_on')."\n";
        else
            echo __('messages', 'process_off')."\n";
    }

    /**
     * get worker name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * checking if process with some title exists
     * @return mixed return PID array or empty
     */
    private function checkProcess(): ?array
    {
        exec("pidof {$this->name}",$response);
        return $response;
    }
}