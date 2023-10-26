

<!-- Content -->
<div class="content-wrapper">
    @if ($showTable)

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Services</h4>

        <!-- Basic Bootstrap Table -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="p-2"> <button wire:click="create" class="btn btn-primary">Create </button></div>
            <h5 class="card-header">Table Basic</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ \Str::limit($service->notes, 50) }}</td>
                                <td>{{ $service->status }}</td>
                                <td>
                                    <button class="dropdown-item" wire:click="edit({{ $service->id }})"
                                       ><i
                                            class="bx bx-edit me-1" ></i> Edit</button>
                                    <button class="dropdown-item" data-bs-toggle="modal"  wire:click="delete({{ $service->id }})"
                                                    data-bs-target="#delete"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>


                                            @include('backend.admin.service.delete')
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
                    {{ $services->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    @else
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Section</span> /Create</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">

                    </div>
                    <div class="card-body">
                        <form  wire:submit.prevent="store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <x-form.input lable="Name" name="name" wire:model="name" required/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <x-form.input lable="price" name="price" wire:model="price" required/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <x-form.textarea lable="Notes" name="notes"  wire:model="notes"  />
                                </div>
                            </div>


                            <div class="row mb-3">

                                <div class="col mb-10">
                                    <label for="">Status</label>
                                    <select name="status" wire:model="status" class="form-control form-select">
                                        <option value="" selected disabled>Choose ... </option>
                                            <option value="active">Active  </option>
                                            <option value="inactive">Inactive  </option>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    <!-- / Content -->

</div>
