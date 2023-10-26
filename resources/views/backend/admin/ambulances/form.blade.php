<x-error-message />
<x-flash-message />

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="car number" name="car_number" :value="$ambulance->car_number" required/>
    </div>
</div>


<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="car model" name="car_model" :value="$ambulance->car_model" required/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10">
        <x-form.input lable="car year made" type="date" name="car_year_made" :value="$ambulance->car_year_made" required/>
    </div>
</div>




