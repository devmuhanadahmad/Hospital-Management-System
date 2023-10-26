<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Ambulances</h4>

            <!-- Basic Bootstrap Table -->
            <x-flash-message />
            <x-error-message />
            <div class="card">
                <div class="p-2"> <a href="{{ route('ambulance.create') }}" class="btn btn-primary">Create </a></div>
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th># ID</th>
                                <th>Car Number</th>
                                <th>Car Model</th>
                                <th>Car Year Made</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($ambulances as $ambulance)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $ambulance->car_number }}
                                        </strong>
                                    </td>
                                   <td>{{$ambulance->car_model}}</td>
                                   <td>{{$ambulance->car_year_made}}</td>
                                   <td>{{$ambulance->status}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <!-- Button trigger modal -->
                                                <a href="{{ route('ambulance.edit', $ambulance->id) }}"
                                                    class="dropdown-item"><i class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit</a>
                                                <!-- Button trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#status-{{ $ambulance->id }}"><i
                                                    class="bx bx-edit me-1" data-toggle="modal"
                                                    data-target="#delete"></i> Edit Status</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $ambulance->id }}"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>
                                            </div>
                                            @include('backend.admin.ambulances.delete')
                                            @include('backend.admin.ambulances.editStatus')
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td>
                                    <p class="text-danger">No Define Data</p>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="m-2">
                        {{ $ambulances->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->



    </div>
    <!-- Content wrapper -->
</x-dashboard>
