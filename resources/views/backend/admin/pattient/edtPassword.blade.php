
<!-- Modal -->
<div class="modal fade" id="password-{{ $pattient->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pattient.updatePassword', $pattient->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <x-form.input lable="New Password" name="password" type="password"  required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <x-form.input lable="Re-enter Password" name="current-password" type="password"  required />
                        </div>
                    </div>

                    <div class="row justify-content-end">

                        <div class="col-sm-12">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
