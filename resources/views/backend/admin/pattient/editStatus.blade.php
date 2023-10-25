
<!-- Modal -->
<div class="modal fade" id="status-{{ $pattient->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pattient.updateStatus', $pattient->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <x-form.status lable="status" name="status"  :value="$pattient->status" :option="['active'=>'Active','inactive'=>'Inactive']"  required />
                        </div>
                    </div>

                    <div class="row justify-content-end">

                        <div class="col-sm-12">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
