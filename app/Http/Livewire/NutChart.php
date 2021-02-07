<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\NutLog;

class NutChart extends Component
{
    use WithFileUploads;

    public $nutlog;

    public $firstRun = true;

    public $nut;

    protected $queryString = ['nut'];

    public $colors = [
        'Jan' => '#EC4899',
        'Feb' => '#3B82F6',
        'Mar' => '#A5B4FC',
        'Apr' => '#F59E0B',
        'May' => '#EF4444',
        'June' => '#FBBC05',
        'July' => '#F99F81',
        'Aug' => '#cbd5e0',
        'Sep' => '#f6ad55',
        'Oct' => '#fc8181',
        'Nov' => '#90cdf4',
        'Dec' => '#66DA26'
    ];


    public function render()
    {
        if (isset($this->nutlog) | isset($this->nut)) {
            if ($this->nutlog) {
                if ($this->nutlog->getMimeType() != "application/json") {
                    abort(422, "Invalid file format");
                }

                $result = json_decode(file_get_contents($this->nutlog->getRealPath()), true);

                $generated_nut_log = NutLog::create([
                    "name" => $result["name"] ?: 'Unkown',
                    "data" => $result
                ]);
            } else {
                $result = NutLog::findOrFail($this->nut)->data;
            }


            $cleaned = collect($result["messages"])->groupBy(function ($data) {
                return Carbon::parse($data["date"])->format('d-m-Y');
            });

            $total_per_month = collect($result["messages"])->groupBy(function ($data) {
                return Carbon::parse($data["date"])->format('M');
            });

            $totals = $cleaned->map(function ($item, $key) {
                return [
                    "date" => $key,
                    "data" => $item->count()
                ];
            });


            $how_often = $totals->groupBy('data')->map(function ($item) {
                return $item->sum('data');
            });

            $highest = $totals->sortByDesc('data')->first();
            $average = $totals->avg('data');
            $sum = $totals->sum('data');

            $nut_per_month = $total_per_month
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data, $month) {

                        return $columnChartModel->addColumn($month, $data->count(), $this->colors[$month]);
                    },
                    (new ColumnChartModel())
                        ->setTitle($result["name"] . " Bar" ?: 'Nut log Bar')
                        ->setAnimated($this->firstRun)
                        ->withOnColumnClickEventName('onColumnClick')
                );

            $how_often_chart = $how_often
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $amount, $days) {
                        return $columnChartModel->addColumn($days, $amount, '#3B82F6');
                    },
                    (new ColumnChartModel())
                        ->setTitle("How often how much")
                        ->setDataLabelsEnabled(true)
                        ->setLegendVisibility(false)
                        ->setAnimated($this->firstRun)
                        ->withOnColumnClickEventName('onColumnClick')
                );

            $nut_per_day = $cleaned
                ->reduce(
                    function (AreaChartModel $areaChartModel, $data, $date) {
                        return $areaChartModel->addPoint($date, $data->count());
                    },
                    (new AreaChartModel())
                        ->setTitle($result["name"] ?: 'Nut log Peak Overview')
                        ->setAnimated($this->firstRun)
                        ->setColor('#3B82F6')
                        ->withOnPointClickEvent('onAreaPointClick')
                        ->setXAxisVisible(false)
                        ->setYAxisVisible(true)
                );
            $this->firstRun = false;
        }

        return view('livewire.nut-chart')->with([
            'nut_per_day' => $nut_per_day ?? null,
            'how_often_chart' => $how_often_chart ?? null,
            'nut_per_month' => $nut_per_month ?? null,
            'sharelink' => $generated_nut_log ?? null,
            'highest' => $highest ?? null,
            'average' => $average ?? null,
            'sum' => $sum ?? null
        ]);
    }
}
