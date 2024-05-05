@php
    $level = \App\Models\LevelModel::inRandomOrder()->first();
    dd($level);
@endphp