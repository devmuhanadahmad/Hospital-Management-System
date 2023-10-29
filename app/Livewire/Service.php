<?php

namespace App\Livewire;

use App\Models\Service as ModelsService;
use Livewire\Component;

class Service extends Component
{
    public $showTable = true;
    public $update = false;
    public $service_id;
    public $name, $price, $notes, $status;

    protected $rules = [
        'name' => 'required|string|min:3',
        'price' => 'required|min:0|numeric',
        'notes' => 'nullable|string',
        'status' => 'nullable|in:active,inactive',
    ];

    // public function updated($price)
    // {
    //     $this->validateOnly($price);
    // }

    public function render()
    {
        return view('livewire.service', [
            'services' => ModelsService::paginate(20),
        ]);
    }

    public function create()
    {
        $this->showTable = false;
        $this->service_id = '';
        $this->name ='';
        $this->price ='';
        $this->notes ='';
        $this->status = '';
    }

    public function edit($id)
    {
        $this->showTable = false;
        $this->update = true;
        $service = ModelsService::findOrFail($id);
        $this->service_id = $service->id;
        $this->name = $service->name;
        $this->price = $service->price;
        $this->notes = $service->notes;
        $this->status = $service->status;
    }

    public function store()
    {

        $this->validate();

        if ($this->update) {
            $service = ModelsService::findOrFail($this->service_id);
            $service->name = $this->name;
            $service->price = $this->price;
            $service->notes = $this->notes;
            $service->status = $this->status;
            $service->save();
            $this->showTable = true;
            session()->flash('message', 'Post successfully created.');
        } else {
            $service = new ModelsService();
            $service->name = $this->name;
            $service->price = $this->price;
            $service->notes = $this->notes;
            $service->status = $this->status;
            $service->save();
            $this->showTable = true;
            session()->flash('message', 'Post successfully updated.');
        }



    }

    public function delete($id)
    {
        $this->service_id = $id;
    }

    public function destroy()
    {
        ModelsService::destroy($this->service_id);
        session()->flash('message', 'The deletion was completed successfully.');
        return redirect()->to('/services');
    }

}
