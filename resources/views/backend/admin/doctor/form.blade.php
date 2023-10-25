<x-error-message />
<x-flash-message />

<div class="row mb-3">
    <div class="col-sm-12">
        <x-form.input lable="Name" name="name" :value="$doctor->name" required />
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-6">
        <x-form.input lable="email" name="email" type="email" :value="$doctor->email" required />
    </div>

    <div class="col-sm-6">
        <x-form.input lable="identity" name="identity"  :value="$doctor->identity" required />
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-6">
        <x-form.input lable="Phone" name="phone" :value="$doctor->phone" />
    </div>

    <div class="col mb-6">
        <label for="">Section</label>
        <select name="section_id" class="form-control form-select">
            <option value="" selected disabled>Choose ... </option>
            @foreach ($sections as $section)
                <option value="{{ $section->id }}" @selected(old('section_id', $doctor->section_id) == $section->id)>{{ $section->name }}</option>
            @endforeach
            @error('section_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </select>
    </div>
</div>

<div class="row mb-3">

    <div class="col-sm-6">
        <x-form.input lable="Image" name="image" type="file" />
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-company">Days</label>
    <div class="col-sm-10">
        @foreach ($apointmenties as $day)
            <input class="form-check-input" type="checkbox" name="days[]" value="{{$day->id}}" id="std- {{$day->id}} "
            @if (in_array($day->id ,$checked) )
            checked
            @endif
            >
            <label class="form-check-label" for="std- {{$day->id}}">{{$day->name}}</label>
        @endforeach
    </div>
</div>
