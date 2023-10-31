<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\PatientAccount;
use App\Models\Pattient;
use App\Models\Section;
use App\Models\Service;
use App\Models\SingleInvoice as ModelsSingleInvoice;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SingleInvoice extends Component
{
    public $showTable = true;
    public $update = false;
    public $singleInvoice_id;
    public $pattients_id, $section_id, $doctor_id, $service_id, $price, $discount = 0, $tax_rate = 17, $tax_value, $total_with_tax, $type;

    protected $rules = [
        'pattients_id'=>'required|numeric',
        'doctor_id'=>'required|numeric|exists:doctors,id',
         'service_id'=>'required|numeric|exists:services,id',
         'discount'=> 'nullable|min:0|numeric',
         'tax_rate'=> 'nullable|min:0|numeric',
         'type'=> 'required|in:cash,noCash'
    ];

    public function render()
    {
        return view('livewire.single-invoice', [
            'invoices' => ModelsSingleInvoice::with('doctor', 'pattient', 'section', 'service')->paginate(20),
            'pattients' => Pattient::where('status', 'active')->get(),
            'doctors' => Doctor::where('status', 'active')->get(),
            'services' => Service::where('status', 'active')->get(),

            'subTotal' => $total_after_discount = (is_numeric($this->price) ? $this->price : 0) - (is_numeric($this->discount) ? $this->discount : 0),
            'taxValue' => $total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),

        ]);
    }

    public function create()
    {
        $this->showTable = false;

        $this->pattients_id = '';
        $this->doctor_id = '';
        $this->section_id = '';
        $this->service_id = '';
        $this->price = '';
        $this->discount = 0;
        $this->tax_rate = 17;
        $this->tax_value = 0;
        $this->total_with_tax = '';
        $this->type = '';

    }

    public function get_section_name()
    {
        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_service_price()
    {
        $service_id = Service::where('id', $this->service_id)->first();
        $this->price = $service_id->price;
    }

    public function get_service_price_fun($service_id)
    {
        $service_id = Service::where('id', $service_id)->first();
        return $service_id->price;
    }

    public function get_section_id($id_doctor)
    {
        $doctor_id = Doctor::with('section')->where('id', $id_doctor)->first();
        return $doctor_id->section->id;
    }

    public function store()
    {

        if ($this->type == 'cash') {
            $this->validate();


            // في حالة كانت الفاتورة نقدي
            DB::beginTransaction();
            try {

                $invoice = $this->StoreInvoice();

                $fundAccount = new FundAccount();
                $fundAccount->single_invoice_id = $invoice->id;
                $fundAccount->receipt_account_id = null;
                $fundAccount->receive = $invoice->total_with_tax;  //استلم الصندوق فلوس من المريض
                $fundAccount->taking  = 00.0;
                $fundAccount->save();
                DB::commit();
                $this->showTable = true;
                session()->flash('message', 'Post successfully created.');
            } catch (Exception $e) {
                DB::rollback();
                session()->flash('message', 'error.');
            }
        } else {

            DB::beginTransaction();
            try {

                $invoice = $this->StoreInvoice();

                $patientAccount = new PatientAccount();
                $patientAccount->single_invoice_id = $invoice->id;
                $patientAccount->pattient_id = $invoice->pattient_id;
                $patientAccount->debit = $invoice->total_with_tax;  //المريض مدين لنا بهذه الفلوس
                $patientAccount->credit = 00.0;
                $patientAccount->save();
                DB::commit();
                $this->showTable = true;
                session()->flash('message', 'Post successfully created.');
            } catch (Exception $e) {
                DB::rollback();
               // $e->getMessage();
                session()->flash('message', 'error.');
            }
        }

    }

    public function delete($id)
    {
        $this->singleInvoice_id = $id;
    }

    public function destroy()
    {
        ModelsSingleInvoice::destroy($this->singleInvoice_id);
        session()->flash('message', 'The deletion was completed successfully.');
        return redirect()->to('/single-invoice');
    }

    public function StoreInvoice()
    {
        $invoice = new ModelsSingleInvoice();
        $invoice->pattients_id = $this->pattients_id;
        $invoice->doctor_id = $this->doctor_id;
        $invoice->section_id = $this->get_section_id($this->doctor_id);
        $invoice->service_id = $this->service_id;
        $invoice->price = $this->get_service_price_fun($this->service_id);
        $invoice->discount = $this->discount;
        $invoice->tax_rate = $this->tax_rate;
        $invoice->tax_value = ((is_numeric($this->price) ? $this->price : 0) - (is_numeric($this->discount) ? $this->discount : 0)) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $invoice->total_with_tax = ((is_numeric($this->price) ? $this->price : 0) - (is_numeric($this->discount) ? $this->discount : 0)) + $invoice->tax_value;
        $invoice->type = $this->type;
        $invoice->save();

        return $invoice;

    }
}

