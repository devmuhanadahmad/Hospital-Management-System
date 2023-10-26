<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> {{ $user->name }}
            </h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>
                                Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages-account-settings-notifications.html"><i
                                    class="bx bx-bell me-1"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages-account-settings-connections.html"><i
                                    class="bx bx-link-alt me-1"></i> Connections</a>
                        </li>
                    </ul>
                     <x-flash-message />
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <form action="{{ route('pattient.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $user->profile->image_url }}" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <x-form.input type="file" name="image" id="upload"
                                                class="account-file-input" hidden accept="image/png, image/jpeg" />
                                        </label>

                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <form id="formAccountSettings" method="POST" onsubmit="return false">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <x-form.input lable="First Name" name="first_name" :value="$user->profile->first_name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input lable="Last Name" name="last_name" :value="$user->profile->last_name" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="birthday" type="date" label="Birthday"
                                                :value="$user->profile->birthday" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.status lable="Gender" name="gender" :value="$user->profile->gender"
                                                :option="['male' => 'Male', 'female' => 'Female']" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="job_name" lable="Job Name" :value="$user->profile->job_name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="specialization" lable="Specialization"
                                                :value="$user->profile->specialization" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="country" lable="Country" :value="$user->profile->country" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="city" lable="City" :value="$user->profile->city" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="state" lable="State" :value="$user->profile->state" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <x-form.input name="street_address" lable="Street Address"
                                                :value="$user->profile->street_address" />
                                        </div>


                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</x-dashboard>
