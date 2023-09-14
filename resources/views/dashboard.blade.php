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
                            Registrations
                        </h3>

                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab1" data-toggle="tab">
                                        {{-- TEXT HERE --}}
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab">7 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab">30 Days</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="tab1" style="position: relative; height: 800px;">
                                <canvas id="report1" width="100%" height="100%"></canvas>
                            </div>
                            {{-- <div class="chart tab-pane" id="tab2" style="position: relative; height: 100%;">
                                <canvas id="report2" width="100%" height="100%"></canvas>
                            </div>
                            <div class="chart tab-pane" id="tab3" style="position: relative; height: 100%;">
                                <canvas id="report3" width="100%" height="100%"></canvas>
                            </div> --}}
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
            var chart = new Chart(document.getElementById("report1"), {
              type: 'line',
              data: {
                labels: {!! $labels !!},
                datasets: [
                    { 
                        data: {!! $dataset1 !!},
                        label: "All",
                        borderColor: "#3e95cd",
                        fill: true,
                        lineTension: 0.1,
                        hoverRadius: 10
                    },
                    { 
                        data: {!! $dataset2 !!},
                        label: "Paid/Used",
                        borderColor: "#8e5ea2",
                        fill: true,
                        lineTension: 0.1,
                        hoverRadius: 10
                    },
                    { 
                        data: {!! $dataset3 !!},
                        label: "Unpaid",
                        borderColor: "#3cba9f",
                        fill: true,
                        lineTension: 0.1,
                        hoverRadius: 10
                    },
                    { 
                        data: {!! $dataset4 !!},
                        label: "Forfeited",
                        borderColor: "#e8c3b9",
                        fill: true,
                        lineTension: 0.1,
                        hoverRadius: 10
                    }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                  display: true,
                  text: 'World population per region (in millions)'
                },
                animation: {
                  duration: 2000,
                },
                interaction: {
                  mode: 'nearest',
                  axis: 'x',
                  intersect: false
                },
                plugins: {
                  title: {
                    display: true,
                    text: ''
                  }
                },
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
              }
            });
        });
    </script>
@endpush

@endsection