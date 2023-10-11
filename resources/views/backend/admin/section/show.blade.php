<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Section /</span> {{ $section->name }}</h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">

                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($section->doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $doctor->name }}</strong>
                                    </td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>{{ $doctor->status }}</td>
                                </tr>
                                @empty
                                    <td><p class="text-danger">No Define Data</p></td>
                                @endforelse
                            </tbody>
                    </table>

                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->



    </div>
    <!-- Content wrapper -->
</x-dashboard>
