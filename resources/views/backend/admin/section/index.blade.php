<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

            <!-- Basic Bootstrap Table -->
            <x-flash-message />
            <x-error-message />
            <div class="card">
                <div class="p-2"> <a href="{{ route('section.create') }}" class="btn btn-primary">Create </a></div>
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($sections as $section)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong><a
                                                href="{{ route('section.show', $section->id) }}">{{ $section->name }}</a>
                                        </strong>
                                    </td>
                                    <td>{{ \Str::limit($section->notes, 50) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <!-- Button trigger modal -->
                                                <a href="{{ route('section.edit', $section->id) }}"
                                                    class="dropdown-item"><i class="bx bx-edit me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Edit</a>
                                                <!-- Button trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $section->id }}"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>
                                            </div>
                                            @include('backend.admin.section.delete')
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
                        {{ $sections->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->



    </div>
    <!-- Content wrapper -->
</x-dashboard>
