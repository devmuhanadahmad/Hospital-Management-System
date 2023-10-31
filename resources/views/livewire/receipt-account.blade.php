

<!-- Content -->
<div class="content-wrapper">
    @if ($showTable)

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> receiptAccounts</h4>

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
                            <th>Name Patent</th>
                            <th>Amount</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($receiptAccounts as $receiptAccount)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $receiptAccount->pattient->name}}</td>
                                <td>{{ $receiptAccount->amount }}</td>
                                <td>{{ \Str::limit($receiptAccount->notes, 50) }}</td>
                                <td>
                                    <button class="dropdown-item" wire:click="edit({{ $receiptAccount->id }})"
                                       ><i
                                            class="bx bx-edit me-1" ></i> Edit</button>
                                    <button class="dropdown-item" data-bs-toggle="modal"  wire:click="delete({{ $receiptAccount->id }})"
                                                    data-bs-target="#delete"><i
                                                        class="bx bx-trash me-1" data-toggle="modal"
                                                        data-target="#delete"></i> Delete</button>


                                            @include('backend.admin.receiptAccount.delete')
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
                    {{ $receiptAccounts->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    @else
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Receipt Account</span> /Create</h4>

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
                                    <div class="col-sm-10">                                        <label for="">Type Receipt Account</label>
                                        <select name="type" wire:model="type" class="form-control form-select">
                                            <option value="" selected disabled>Choose ... </option>
                                                <option value="pay">Pay  </option>
                                                <option value="receipt">Recepit  </option>
                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">                                    <label for="">Patient Name</label>
                                    <select name="pattient_id" wire:model="pattient_id" class="form-control form-select">
                                        <option value="" selected disabled>Choose ... </option>
                                        @foreach ($pattients as $pattient)
                                        <option value="{{$pattient->id}}">{{$pattient->name}}  </option>
                                        @endforeach
                                        @error('pattient_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <x-form.input lable="Amount" name="amount" type="number" wire:model="amount" required/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <x-form.textarea lable="Notes" name="notes"  wire:model="notes"  />
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
