<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Pattients</h4>

            <!-- Basic Bootstrap Table -->
            <x-flash-message />
            <x-error-message />
            <div class="card">
                <div class="p-2"> <a href="{{ route('pattient.create') }}" class="btn btn-primary">Create </a></div>
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($pattients as $pattient)
                                <tr>
                                    <td>{{ $pattient->id }}</td>
                                    <td><img src="{{ $pattient->image_url }}" alt="" width="50px"
                                            height="50px"></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong><a
                                                href="{{ route('pattient.show', $pattient->id) }}">{{ $pattient->name }}</a>
                                        </strong>
                                    </td>
                                    <td>{{ $pattient->phone }}</td>
                                    <td>{{ $pattient->status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <!-- Button trigger modal -->
                                                <a href="{{ route('pattient.edit', $pattient->id) }}"
                                                    class="dropdown-item"><i class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit</a>
                                                <!-- Button trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#password-{{ $pattient->id }}"><i
                                                        class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit Password</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#status-{{ $pattient->id }}"><i
                                                        class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit Status</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $pattient->id }}"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>
                                            </div>
                                            @include('backend.admin.pattient.delete')
                                            @include('backend.admin.pattient.edtPassword')
                                            @include('backend.admin.pattient.editStatus')
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
                        {{ $pattients->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->



    </div>
    <!-- Content wrapper -->
</x-dashboard>
