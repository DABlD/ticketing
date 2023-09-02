@extends('layouts.app')
@section('content')

<section class="content">
    <div class="container-fluid">

        {{-- CARD --}}
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $te->count() }}</h3>
                        <p>Total List</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-calendar"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $tc->count() }}</h3>
                        <p>Total Completed Events</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-checkmark"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $tu->count() }}</h3>
                        <p>Upcoming Events</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ttp->count() }} / {{ $ttu->count() }}</h3>
                        <p>Total Tickets Paid / Unpaid</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Sales
                        </h3>

                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab1" data-toggle="tab">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab">7 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab">30 Days</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="tab1" style="position: relative; height: 100%;">
                                <canvas id="report1" width="100%" height="100%"></canvas>
                            </div>
                            <div class="chart tab-pane" id="tab2" style="position: relative; height: 100%;">
                                <canvas id="report2" width="100%" height="100%"></canvas>
                            </div>
                            <div class="chart tab-pane" id="tab3" style="position: relative; height: 100%;">
                                <canvas id="report3" width="100%" height="100%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/charts.min.js') }}"></script>
    <script src="{{ asset('js/charts-utils.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            new Chart(document.getElementById("report1"), {
              type: 'line',
              data: {
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{ 
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Africa",
                    borderColor: "#3e95cd",
                    fill: false
                  }, { 
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Asia",
                    borderColor: "#8e5ea2",
                    fill: false
                  }, { 
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Europe",
                    borderColor: "#3cba9f",
                    fill: false
                  }, { 
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Latin America",
                    borderColor: "#e8c3b9",
                    fill: false
                  }, { 
                    data: [6,3,2,2,7,26,82,172,312,433],
                    label: "North America",
                    borderColor: "#c45850",
                    fill: false
                  }
                ]
              },
              options: {
                title: {
                  display: true,
                  text: 'World population per region (in millions)'
                }
              }
            });
        });
    </script>
@endpush

@endsection