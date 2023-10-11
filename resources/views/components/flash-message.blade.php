@if (session()->has('success'))
<div class="alert alert-primary mmb-2" role="alert">
    {{ session('success') }}

</div>
@endif

@if (session()->has('store'))
<div class="alert alert-primary mmb-2" role="alert">
    {{ session('store') }}

</div>
@endif

@if (session()->has('update'))
<div class="alert alert-primary mmb-2" role="alert">
    {{ session('update') }}

</div>
@endif

@if (session()->has('destroy'))
<div class="alert alert-primary mmb-2" role="alert">
    {{ session('destroy') }}

</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger mmb-2" role="alert">
    {{ session('error') }}

</div>
@endif
