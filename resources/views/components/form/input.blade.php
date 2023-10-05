@props(['name','type'=>'text', 'lable' => false,  'value' => ''])

@php
    $old_name=str_replace('[','.',$name);
    $old_name=str_replace(']','',$old_name);
@endphp
<div class="col">
    @if ($lable)
        <label for="" class="text-capitalize ">{{ $lable }}</label>
    @endif
    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($old_name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
           id=""
           placeholder=""
        >
    @error($old_name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
