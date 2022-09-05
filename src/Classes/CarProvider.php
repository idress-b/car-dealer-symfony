<?php

namespace App\Classes;

class CarProvider
{
    const CAROSSERIE = [
        '4x4, SUV, CROSSOVER' => 'suv',
        'Citadine' => 'citadine',
        'Berline' => 'berline',
        'Break' => 'break',
        'Cabriolet' => 'cabriolet',
        'Coupé' => 'coupe',
        'Monospace' => 'monospace',
        'Minibus' => 'minibus',
        'Pick-up' => 'pickup',
        'Voiture société,commerciale' => 'societe',
        'Autre' => 'autre'
    ];

    const PLACES = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6 ou plus' => 6
    ];

    const PORTES = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7 ou plus' => 7
    ];

    const CRITAIR = [
        '0' => 0,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        'Non classé' => 6
    ];
}
