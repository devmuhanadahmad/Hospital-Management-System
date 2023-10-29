<!-- Content -->
<div class="content-wrapper">
    @if ($showTable)

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Invoices</h4>

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
                                <th>Pattient</th>
                                <th>Doctor</th>
                                <th>Section</th>
                                <th>Service</th>
                                <th>Total With Tax</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <th>{{ $invoice->pattient->name }}</th>
                                    <th>{{ $invoice->doctor->name }}</th>
                                    <th>{{ $invoice->section->name }}</th>
                                    <th>{{ $invoice->service->name }}</th>
                                    <td>{{ $invoice->total_with_tax }}</td>
                                    <td>{{ $invoice->type }}</td>
                                    <td>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            wire:click="delete({{ $invoice->id }})" data-bs-target="#delete"><i
                                                class="bx bx-trash me-1" data-toggle="modal" data-target="#delete"></i>
                                            Delete</button>


                                        @include('backend.admin.singleInvoice.delete')
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
                        {{ $invoices->withQueryString()->links('vendor.pagination.bootstrap-4') }}
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
                            <form wire:submit.prevent="store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label for="">Pattient Name</label>
                                        <select  wire:model="pattients_id"
                                            class="form-control form-select">
                                            <option value="" selected disabled>Choose ... </option>
                                            @foreach ($pattients as $pattient)
                                                <option value="{{ $pattient->id }} ">{{ $pattient->name }} </option>
                                            @endforeach
                                            @error('pattients_id')
                                                <small class="text-danger">nvbnbvnbvnv</small>
                                            @enderror
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="">Doctor Name</label>
                                        <select  wire:model="doctor_id" wire:change="get_section_name"
                                            class="form-control form-select">
                                            <option value="">Choose ... </option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }} ">{{ $doctor->name }} </option>
                                            @endforeach
                                            @error('doctor_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <x-form.input lable="Section" name="section_id" wire:model="section_id"
                                            readonly />
                                    </div>

                                    <div class="col mb-10">
                                        <label for="">Type</label>
                                        <select name="type" wire:model="type" class="form-control form-select">
                                            <option value="">Choose ... </option>
                                            <option value="cash">Cash </option>
                                            <option value="noCash">No Cash </option>
                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
                                    </div>

                                </div>


                                <div class="row mb-3">

                                    <div class="col mb-2">
                                        <label for="">Service Name</label>
                                        <select  wire:model="service_id" wire:change="get_service_price"
                                            class="form-control form-select">
                                            <option value="">Choose ... </option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }} ">{{ $service->name }} </option>
                                            @endforeach
                                            @error('service_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <x-form.input lable="Service Prece" name="price" wire:model="price"
                                            readonly />
                                    </div>

                                    <div class="col-sm-2">
                                        <x-form.input lable="Discount" name="discount" wire:model="discount" />
                                    </div>


                                    <div class="col-sm-2">
                                        <x-form.input lable="Tax rate" name="tax_rate" wire:model="tax_rate" />
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="" class="text-capitalize ">Tax Value</label>
                                        <input class="form-control" value="{{ $taxValue }}" readonly />
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="" class="text-capitalize ">Total</label>
                                        <input class="form-control " value="{{ $subTotal }}" readonly />
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
