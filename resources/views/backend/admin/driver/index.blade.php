<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Drivers</h4>

            <!-- Basic Bootstrap Table -->
            <x-flash-message />
            <x-error-message />
            <div class="card">
                <div class="p-2"> <a href="{{ route('driver.create') }}" class="btn btn-primary">Create </a></div>
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th># ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Ambulance number / model</th>
                                <th>Notes</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($drivers as $driver)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $driver->name }}
                                        </strong>
                                    </td>
                                   <td>{{$driver->phone}}</td>
                                   <td>Number : {{ $driver->ambulances->car_number }} / Model : {{ $driver->ambulances->car_model }}</td>
                                   <td>{{\Str::limit($driver->notes,50)}}</td>
                                   <td>{{$driver->status}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <!-- Button trigger modal -->
                                                <a href="{{ route('driver.edit', $driver->id) }}"
                                                    class="dropdown-item"><i class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit</a>
                                                <!-- Button trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#status-{{ $driver->id }}"><i
                                                    class="bx bx-edit me-1" data-toggle="modal"
                                                    data-target="#delete"></i> Edit Status</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $driver->id }}"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>
                                            </div>
                                            @include('backend.admin.driver.delete')
                                            @include('backend.admin.driver.editStatus')
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
                        {{ $drivers->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->



    </div>
    <!-- Content wrapper -->
</x-dashboard>
