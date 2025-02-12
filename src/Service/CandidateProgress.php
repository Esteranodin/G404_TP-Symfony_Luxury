<?php


namespace App\Service;

use App\Entity\Candidate;

class CandidateProgress
{
    public function calculateProgress(Candidate $candidate, array $requiredFields): int
    {
        $completedFields = 0;
        $totalFields = count($requiredFields);

        foreach ($requiredFields as $field) {
            $getter = 'get' . ucfirst($field);
            if (method_exists($candidate, $getter) && !empty($candidate->$getter())) {
                $completedFields++;
            }
        }

        return $totalFields === 0 ? 100 : (int) round(($completedFields / $totalFields) * 100);
    }
}