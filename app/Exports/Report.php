<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{FromView, ShouldAutoSize};
use DOMDocument;

class Report implements FromView, ShouldAutoSize
{
    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        return view('reports.exports', [
            'data' => $this->data,
        ]);
    }
}