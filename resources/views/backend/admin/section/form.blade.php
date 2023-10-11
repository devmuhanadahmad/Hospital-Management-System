<x-error-message />
<x-flash-message />

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="Name" name="name" :value="$section->name" required/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.textarea lable="Notes" name="notes" :value="$section->notes" />
    </div>
</div>
