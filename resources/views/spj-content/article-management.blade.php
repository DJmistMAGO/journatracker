@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Article Management</h4>
{{-- content --}}

<div class="card">
  <h5 class="card-header">Article List</h5>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Project</th>
          <th>Client</th>
          <th>Users</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td>
            <i class="icon-base ri ri-suitcase-2-line icon-22px text-danger me-4"></i>
            <span>Tours Project</span>
          </td>
          <td>Albert Cook</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller">
                <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson">
                <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker">
                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          <td>
            <div class="dropdown">
              <button
                type="button"
                class="btn p-0 dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown">
                <i class="icon-base ri ri-more-2-fill icon-18px"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-pencil-line icon-18px me-1"></i>Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <i class="icon-base ri ri-basketball-fill icon-22px text-info me-4"></i>
            <span>Sports Project</span>
          </td>
          <td>Barry Hunter</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller">
                <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson">
                <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker">
                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-success me-1">Completed</span></td>
          <td>
            <div class="dropdown">
              <button
                type="button"
                class="btn p-0 dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown">
                <i class="icon-base ri ri-more-2-fill icon-18px"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-pencil-line icon-18px me-1"></i>Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <i class="icon-base ri ri-leaf-fill icon-22px text-success me-4"></i>
            <span>Greenhouse Project</span>
          </td>
          <td>Trevor Baker</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller">
                <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson">
                <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker">
                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-info me-1">Scheduled</span></td>
          <td>
            <div class="dropdown">
              <button
                type="button"
                class="btn p-0 dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown">
                <i class="icon-base ri ri-more-2-fill icon-18px"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-pencil-line icon-18px me-1"></i>Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <i class="icon-base ri ri-bank-fill icon-22px text-primary me-4"></i>
            <span>Bank Project</span>
          </td>
          <td>Jerry Milton</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller">
                <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson">
                <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker">
                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-warning me-1">Pending</span></td>
          <td>
            <div class="dropdown">
              <button
                type="button"
                class="btn p-0 dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown">
                <i class="icon-base ri ri-more-2-fill icon-18px"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-pencil-line icon-18px me-1"></i>Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

{{-- content end--}}

@endsection
