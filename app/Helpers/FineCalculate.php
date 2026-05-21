<?php
use Carbon\Carbon;

function calculateFine($student, $month)
{
    $today = now()->startOfDay();
    $current = Carbon::parse($month . '-01')->startOfMonth();
    $totalFine = 0;
    $isFirstMonth = true;
    while ($current->lte($today)) {

        if ($isFirstMonth) {
            $fineStart = $current->copy()->day(16);
        } else {
            $fineStart = $current->copy()->startOfMonth();
        }
        $fineEnd = $current->isSameMonth($today)
            ? $today
            : $current->copy()->endOfMonth();

        if ($fineStart->lte($fineEnd)) {
            $days = $fineStart->diffInDays($fineEnd) + 1;
            $monthFine = min($days * 15, 100);
            $totalFine += $monthFine;
        }

        $current->addMonth();
        $isFirstMonth = false;
    }
    return $totalFine;
}
