<?php

namespace App\Classes\Workers;
use App\Interfaces\WorkerInterface;

/**
 * worker class which do loop work
 * Class WorkerLoop
 * @package App\Classes\Workers
 */
class WorkerLoop implements WorkerInterface
{
    private string $name;
    private int $repeat;
    private int $sleep;

    public function __construct(string $name, int $repeat = 5, int $sleep = 60)
    {
        $this->name = $name;
        $this->repeat = $repeat;
        $this->sleep = $sleep;
    }

    /**
     * doing some loop work. registering process only when the work started
     * @return void
     * @throws \Exception
     */
    public function doWork(): void
    {
        if (!$this->announce())
            throw new \RuntimeException(__('errors', 'process_name_failed'));

        for ($i=1; $i<=$this->repeat; $i++) {
            sleep($this->sleep);
        }
    }

    /**
     * receiving worker name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * assigning current process some title
     * @return bool
     */
    private function announce(): bool
    {
        return cli_set_process_title($this->name);
    }

}