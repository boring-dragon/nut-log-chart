<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
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


    public function render()
    {
        if ( isset($this->nutlog) | isset($this->nut)) {
            if ($this->nutlog) {
                $result = json_decode(file_get_contents($this->nutlog->getRealPath()), true);
            } else {
                $result = NutLog::findOrFail($this->nut)->data;
            }

            $generated_nut_log = NutLog::create([
                "name" => $result["name"] ?: 'Unkown',
                "data" => $result
            ]);

            $cleaned = collect($result["messages"])->groupBy(function ($data) {
                return Carbon::parse($data["date"])->format('d-m-Y');
            });

            $areaChartModel = $cleaned
                ->reduce(
                    function (AreaChartModel $areaChartModel, $data, $date) {
                        return $areaChartModel->addPoint($date, $data->count());
                    },
                    (new AreaChartModel())
                        ->setTitle($result["name"] ?: 'Nut log Peak Overview')
                        ->setAnimated($this->firstRun)
                        ->setColor('#2CD5C4')
                        ->withOnPointClickEvent('onAreaPointClick')
                        ->setXAxisVisible(false)
                        ->setYAxisVisible(true)
                );
            $this->firstRun = false;
        }

        return view('livewire.nut-chart')->with([
            'areaChartModel' => $areaChartModel ?? null,
            'sharelink' => $generated_nut_log ?? null
        ]);
    }
}
