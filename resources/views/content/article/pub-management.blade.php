@extends('layouts/contentNavbarLayout')

@section('title', 'Publication Management')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
@endpush

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
@include('_partials/loader')
<div class="row gy-4">

    <!-- Analytics Cards -->
    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Total Articles</h5>
            <h3 class="mb-0">128</h3>
          </div>
          <div class="avatar-initial bg-primary rounded-circle shadow-sm p-3">
            <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Published</h5>
            <h3 class="mb-0 text-success">95</h3>
          </div>
          <div class="avatar-initial bg-success rounded-circle shadow-sm p-3">
            <i class="mdi mdi-check-circle-outline mdi-24px text-white"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Drafts</h5>
            <h3 class="mb-0 text-warning">22</h3>
          </div>
          <div class="avatar-initial bg-warning rounded-circle shadow-sm p-3">
            <i class="mdi mdi-file-clock-outline mdi-24px text-white"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Views This Month</h5>
            <h3 class="mb-0">34.2k</h3>
          </div>
          <div class="avatar-initial bg-info rounded-circle shadow-sm p-3">
            <i class="mdi mdi-eye-outline mdi-24px text-white"></i>
          </div>
        </div>
      </div>
    </div>
    <!-- /Analytics Cards -->

    <!-- Articles Management Table -->
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title m-0">Articles Management</h5>
          <a href="javascript:void(0);" class="btn btn-sm btn-primary">
            <i class="mdi mdi-plus me-1"></i> New Article
          </a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Views</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Breaking News on AI</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-2">
                      <img src="{{asset('assets/img/avatars/1.png')}}" class="rounded-circle">
                    </div>
                    <span>John Doe</span>
                  </div>
                </td>
                <td>Technology</td>
                <td>2025-09-12</td>
                <td><span class="badge bg-label-success rounded-pill">Published</span></td>
                <td>12.5k</td>
                <td class="text-end">
                  <button class="btn btn-sm btn-icon btn-text-secondary"><i class="mdi mdi-pencil-outline"></i></button>
                  <button class="btn btn-sm btn-icon btn-text-danger"><i class="mdi mdi-delete-outline"></i></button>
                </td>
              </tr>
              <tr>
                <td><strong>Economic Forecast 2026</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-2">
                      <img src="{{asset('assets/img/avatars/2.png')}}" class="rounded-circle">
                    </div>
                    <span>Jane Smith</span>
                  </div>
                </td>
                <td>Business</td>
                <td>—</td>
                <td><span class="badge bg-label-warning rounded-pill">Draft</span></td>
                <td>—</td>
                <td class="text-end">
                  <button class="btn btn-sm btn-icon btn-text-secondary"><i class="mdi mdi-pencil-outline"></i></button>
                  <button class="btn btn-sm btn-icon btn-text-danger"><i class="mdi mdi-delete-outline"></i></button>
                </td>
              </tr>
              <tr>
                <td><strong>Sports Highlights Weekly</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-2">
                      <img src="{{asset('assets/img/avatars/3.png')}}" class="rounded-circle">
                    </div>
                    <span>Mike Jordan</span>
                  </div>
                </td>
                <td>Sports</td>
                <td>2025-09-10</td>
                <td><span class="badge bg-label-info rounded-pill">Scheduled</span></td>
                <td>2.3k</td>
                <td class="text-end">
                  <button class="btn btn-sm btn-icon btn-text-secondary"><i class="mdi mdi-pencil-outline"></i></button>
                  <button class="btn btn-sm btn-icon btn-text-danger"><i class="mdi mdi-delete-outline"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /Articles Management Table -->

    <!-- Analytics Chart -->
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title m-0">Articles Analytics</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">This Week</a>
              <a class="dropdown-item" href="#">This Month</a>
              <a class="dropdown-item" href="#">This Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="articlesAnalyticsChart"></div>
        </div>
      </div>
    </div>
    <!-- /Analytics Chart -->

  </div>


@push('scripts')
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          var options = {
            chart: {
              type: "line",
              height: 350,
              toolbar: { show: false }
            },
            series: [
              {
                name: "Published Articles",
                type: "column",
                data: [12, 18, 25, 20, 32, 28, 36, 40, 38, 42, 48, 50]
              },
              {
                name: "Drafts",
                type: "column",
                data: [5, 7, 6, 8, 9, 6, 7, 10, 8, 9, 6, 5]
              },
              {
                name: "Views (k)",
                type: "line",
                data: [8, 15, 12, 18, 22, 25, 28, 30, 35, 40, 42, 45]
              }
            ],
            stroke: {
              width: [0, 0, 3]
            },
            dataLabels: {
              enabled: true,
              enabledOnSeries: [2] // only show labels on line chart
            },
            labels: [
              "Jan", "Feb", "Mar", "Apr", "May", "Jun",
              "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
            xaxis: {
              type: "category"
            },
            yaxis: [
              {
                title: { text: "Articles" }
              },
              {
                opposite: true,
                title: { text: "Views (k)" }
              }
            ],
            colors: ["#1A5319", "#80AF81", "#508D4E"],
            legend: {
              position: "top",
              horizontalAlign: "right"
            }
          };

          var chart = new ApexCharts(document.querySelector("#articlesAnalyticsChart"), options);
          chart.render();
        });
      </script>

@endpush
@endsection
