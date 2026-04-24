<?php

namespace App\Services;

use App\Models\MonetizationEvent;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\DB;

class MonetizationAggregationService
{
    public function totalRevenue(int $creatorId, string $currency): string
    {
        $sum = MonetizationEvent::query()
            ->where('creator_id', $creatorId)
            ->where('currency', strtoupper($currency))
            ->selectRaw('COALESCE(SUM(amount), 0) as total_amount')
            ->value('total_amount');

        return $this->normalizeDecimal($sum);
    }

    public function totalRevenueByCurrency(int $creatorId): array
    {
        $rows = MonetizationEvent::query()
            ->where('creator_id', $creatorId)
            ->selectRaw('currency, COALESCE(SUM(amount), 0) as total_amount')
            ->groupBy('currency')
            ->orderBy('currency')
            ->get();

        $totals = [];
        foreach ($rows as $row) {
            $totals[$row->currency] = $this->normalizeDecimal($row->total_amount);
        }

        return $totals;
    }

    public function revenueByRecipe(int $creatorId, string $currency): array
    {
        $rows = MonetizationEvent::query()
            ->join('recipes', 'recipes.id', '=', 'monetization_events.recipe_id')
            ->where('monetization_events.creator_id', $creatorId)
            ->where('monetization_events.currency', strtoupper($currency))
            ->selectRaw('recipes.id as recipe_id, recipes.title as recipe_title, COALESCE(SUM(monetization_events.amount), 0) as revenue_total')
            ->groupBy('recipes.id', 'recipes.title')
            ->orderByDesc('revenue_total')
            ->orderByDesc('recipes.id')
            ->get();

        return $rows->map(function ($row): array {
            return [
                'recipe_id' => (int) $row->recipe_id,
                'recipe_title' => $row->recipe_title,
                'revenue_total' => $this->normalizeDecimal($row->revenue_total),
            ];
        })->all();
    }

    public function revenueOverTime(
        int $creatorId,
        string $currency,
        ?CarbonInterface $from = null,
        ?CarbonInterface $to = null
    ): array {
        $query = MonetizationEvent::query()
            ->where('creator_id', $creatorId)
            ->where('currency', strtoupper($currency))
            ->selectRaw("DATE(occurred_at) as period, COALESCE(SUM(amount), 0) as revenue_total")
            ->groupBy(DB::raw('DATE(occurred_at)'))
            ->orderBy('period');

        if ($from !== null) {
            $query->where('occurred_at', '>=', $from);
        }

        if ($to !== null) {
            $query->where('occurred_at', '<=', $to);
        }

        $rows = $query->get();

        return $rows->map(function ($row): array {
            return [
                'period' => $row->period,
                'revenue_total' => $this->normalizeDecimal($row->revenue_total),
            ];
        })->all();
    }

    private function normalizeDecimal($value): string
    {
        if ($value === null) {
            return '0.0000';
        }

        $stringValue = trim((string) $value);
        if ($stringValue === '') {
            return '0.0000';
        }

        if (str_contains($stringValue, 'E') || str_contains($stringValue, 'e')) {
            $stringValue = sprintf('%.4F', (float) $stringValue);
        }

        $negative = str_starts_with($stringValue, '-');
        $unsigned = ltrim($stringValue, '+-');
        [$integer, $fraction] = array_pad(explode('.', $unsigned, 2), 2, '');

        $integer = ltrim($integer, '0');
        if ($integer === '') {
            $integer = '0';
        }

        $fraction = substr(str_pad($fraction, 4, '0'), 0, 4);

        return ($negative ? '-' : '') . $integer . '.' . $fraction;
    }
}
