<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardStat extends Component
{
    public $title;
    public $count;
    public $icon;
    public $color;

    public function __construct($title = '', $count = 0, $icon = 'mdi-file-document-outline', $color = 'primary')
    {
        $this->title = $title;
        $this->count = $count;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.dashboard-stat');
    }
}
