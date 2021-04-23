<?php

namespace App\Interfaces;

interface WorkerInterface
{
    public function doWork(): void;
    public function getName(): string;
}