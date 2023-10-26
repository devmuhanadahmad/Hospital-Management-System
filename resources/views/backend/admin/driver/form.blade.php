<x-error-message />
<x-flash-message />

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="name" name="name" :value="$driver->name" required/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="phone" name="phone" :value="$driver->phone" required/>
    </div>
</div>

<div class="row mb-3">

    <div class="col mb-10">
        <label for="">Ambulances</label>
        <select name="ambulance_id" class="form-control form-select">
            <option value="" selected disabled>Choose ... </option>
            @foreach ($ambulances as $ambulance)
                <option value="{{ $ambulance->id }}" @selected(old('ambulance_id', $driver->ambulance_id) == $ambulance->id)>Number : {{ $ambulance->car_number }} / Model : {{ $ambulance->car_model }}</option>
            @endforeach
            @error('ambulance_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.textarea lable="Notes" name="notes" :value="$driver->notes" />
    </div>
</div>
