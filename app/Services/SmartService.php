<?php
// app/Services/SMARTService.php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;

class SMARTService
{
    private $weights = [
        0.2,  // Jumlah Penghasilan
        0.25, // Jumlah Tanggungan
        0.15, // Kondisi Tempat Tinggal
        0.05, // Jumlah Hutang
        0.35  // Jumlah Pengeluaran
    ];

    private $types = [
        'Cost', // Jumlah Penghasilan
        'Benefit', // Jumlah Tanggungan
        'Cost',    // Kondisi Tempat Tinggal
        'Benefit', // Jumlah Hutang
        'Benefit'  // Jumlah Pengeluaran
    ];

    public function calculateScores()
    {
        $alternatives = Alternative::with('criteria')->get();
        $criteria = Criteria::all();

        // Hitung nilai SMART
        $alternativeScores = [];
        foreach ($alternatives as $alternative) {
            $score = 0;
            foreach ($alternative->criteria as $index => $criterion) {
                $weight = $this->weights[$index];
                $value = $criterion->pivot->value;
                if ($this->types[$index] === 'Cost') {
                    $value = 1 / $value; // Asumsi nilai Cost dibalik
                }
                $score += $value * $weight;
            }
            $alternativeScores[] = ['alternative' => $alternative, 'score' => $score];
        }

        // Urutkan berdasarkan score
        usort($alternativeScores, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $alternativeScores;
    }

    public function storeAlternative($name, $criteriaValues)
    {
        $alternative = Alternative::create(['name' => $name]);

        foreach ($criteriaValues as $criteriaId => $value) {
            $alternative->criteria()->attach($criteriaId, ['value' => $value]);
        }

        return $alternative;
    }
}

