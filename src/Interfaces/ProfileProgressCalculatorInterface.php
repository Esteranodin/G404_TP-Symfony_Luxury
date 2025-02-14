<?php

namespace App\Interfaces;

use App\Entity\Candidate;

interface ProfileProgressCalculatorInterface
{
    public function calculProgress(Candidate $candidate): int;
}