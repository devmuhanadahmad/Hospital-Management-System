<x-dashboard>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ambulance</span> /Edit</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">

                    </div>
                    <div class="card-body">
                        <form action="{{ route('ambulance.update', $ambulance->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('backend.admin.ambulances.form')

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-dashboard>
