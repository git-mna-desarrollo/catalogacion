@extends('layouts.app')

@section('content')
<!--Begin::Row-->
<div class="row">
    <div class="col-xl-4">
        <!--begin::Stats Widget 22-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
            style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">SAP
                    UI Progress</a>
                <div class="font-weight-bold text-muted font-size-sm">
                    <span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">67%</span>Avarage
                </div>
                <div class="progress progress-xs mt-7 bg-info-o-60">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 67%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 22-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 23-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Airplus
                    Budget</a>
                <div class="font-weight-bold text-white font-size-sm">
                    <span class="font-size-h2 mr-2">87K%</span>23k to goal
                </div>
                <div class="progress progress-xs mt-7 bg-white-o-90">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 87%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 23-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 24-->
        <div class="card card-custom bg-dark card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Customer</a>
                <div class="font-weight-bold text-white font-size-sm">
                    <span class="font-size-h2 mr-2">52,450</span>48k to goal
                </div>
                <div class="progress progress-xs mt-7 bg-white-o-90">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 52%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats: Widget 24-->
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Donut Chart</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Donut Chart</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart_1" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>

    <div class="col-lg-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Donut Chart</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart_2" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>
<!--End::Row-->
@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/pages/features/charts/apexcharts.js') }}"></script> --}}
    <script>
        var options = {
          series: [{
          name: 'Inflation',
          data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Inflation in Argentina, 2002',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // grafico pie
        var options = {
          series: [44, 55, 13, 43, 22],
          chart: {
          width: 480,
          type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_1"), options);
        chart.render();

        // grafico dona
         var options = {
          series: [44, 55, 41, 17, 15],
          chart: {
          width: 480,
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_2"), options);
        chart.render();
    
    </script>
@endsection