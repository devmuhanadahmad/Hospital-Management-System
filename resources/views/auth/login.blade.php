<x-auth title="Login">
    @push('css')
        <style>
            .loginForm {
                display: none;
            }
        </style>
    @endpush
    <!-- /Logo -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-error-message/>
    <div class="mb-3">
        <label for="email" class="form-label">User Type Login</label>
        <select class="form-select" id="selectChoose" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
        </select>
    </div>

    <div class="loginForm" id="patient">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Enter your email" autofocus />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            <small>Forgot Password?</small>
                        </a>
                    @endif
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>
    </div>

    <div class="loginForm" id="doctor">
        <form method="POST" action="{{ route('loginAdmin.store') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Enter your email" autofocus />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            <small>Forgot Password?</small>
                        </a>
                    @endif
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>
    </div>


    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('register') }}">
            <span>Create an account</span>
        </a>
    </p>
    </div>
    </div>
    <!-- /Register -->

    @push('js')
        <script>
            $('#selectChoose').change(function() {
                var myID = $(this).val();
                $('.loginForm').each(function() {
                    myID === $(this).attr('id') ? $(this).show() : $(this).hide();
                });
            });
        </script>
    @endpush
</x-auth>
