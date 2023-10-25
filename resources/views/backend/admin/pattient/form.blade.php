<x-error-message />
<x-flash-message />

<div class="row mb-3">
    <div class="col-sm-12">
        <x-form.input lable="Name" name="name" :value="$pattient->name" required />
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-6">
        <x-form.input lable="email" name="email" type="email" :value="$pattient->email" required />
    </div>

    <div class="col-sm-6">
        <x-form.input lable="identity" name="identity"  :value="$pattient->identity" required />
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-6">
        <x-form.input lable="Phone" name="phone" :value="$pattient->phone" />
    </div>

    <div class="col-sm-6">
        <x-form.input lable="Image" name="image" type="file" />
    </div>
</div>

