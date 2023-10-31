<?php

namespace App\Livewire;

use App\Models\FundAccount;
use App\Models\PatientAccount;
use App\Models\Pattient;
use App\Models\ReceiptAccount as ModelsReceiptAccount;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReceiptAccount extends Component
{
    public $showTable = true;
    public $update = false;
    public $receipt_account_id;
    public $pattient_id, $amount, $notes, $type;

    protected $rules = [
        'pattient_id' => 'required|numeric',
        'amount' => 'required|min:0|numeric',
        'notes' => 'nullable|string',
        'type' => 'required',
    ];

    public function render()
    {
        return view('livewire.receipt-account', [
            'receiptAccounts' => ModelsReceiptAccount::paginate(20),
            'pattients' => Pattient::where('status', 'active')->get(),
        ]);
    }

    public function create()
    {
        $this->showTable = false;
        $this->pattient_id = '';
        $this->amount = '';
        $this->notes = '';
        $this->type = '';
    }

    public function edit($id)
    {
        $this->showTable = false;
        $this->update = true;
        $receiptAccount = ModelsReceiptAccount::findOrFail($id);
        $this->receipt_account_id = $receiptAccount->id;
        $this->pattient_id = $receiptAccount->pattient_id;
        $this->amount = $receiptAccount->amount;
        $this->notes = $receiptAccount->notes;
        $this->type = $receiptAccount->type;
    }

    public function store()
    {

        //$this->validate();

        if ($this->update) {
            $receiptAccount = ModelsReceiptAccount::findOrFail($this->receipt_account_id);
            $receiptAccount->pattient_id = $this->pattient_id;
            $receiptAccount->amount = $this->amount;
            $receiptAccount->notes = $this->notes;
            $receiptAccount->type = $this->type;
            $receiptAccount->save();
            $this->showTable = true;
            session()->flash('message', 'Post successfully created.');
        } else {
            // DB::beginTransaction();
            // try {

                //اضافة ايصال
                $receiptAccount = new ModelsReceiptAccount();
                $receiptAccount->pattient_id = $this->pattient_id;
                $receiptAccount->amount = $this->amount;
                $receiptAccount->notes = $this->notes;
                $receiptAccount->type = $this->type;
                $receiptAccount->save();

                if ($this->type == 'pay') {

                    //type = pay  تم استلام فلوس من المريض "سند قبض " الان
                    $patientAccount = new PatientAccount();
                    $patientAccount->single_invoice_id = null;
                    $patientAccount->pattient_id = $receiptAccount->pattient_id;
                    $patientAccount->debit = 00.0; //المريض مدين لنا بهذه الفلوس
                    $patientAccount->credit = $receiptAccount->amount; //تم دفع هذا مبلغ من المريض
                    $patientAccount->save();

                    $fundAccount = new FundAccount();
                    $fundAccount->single_invoice_id = null;
                    $fundAccount->receipt_account_id = $receiptAccount->id;
                    $fundAccount->receive = $receiptAccount->amount; //استلم الصندوق فلوس من المريض
                    $fundAccount->taking = 00.0;
                    $fundAccount->save();
                } else {
             
                    //type = pay  تم اعطاء فلوس الى المريض "سند دفع " الان
                    $patientAccount = new PatientAccount();
                    $patientAccount->single_invoice_id = null;
                    $patientAccount->pattient_id = $receiptAccount->pattient_id;
                    $patientAccount->debit = $receiptAccount->amount; //المريض مدين لنا بهذه الفلوس
                    $patientAccount->credit = 00.0; //تم دفع هذا مبلغ من المريض
                    $patientAccount->save();

                    $fundAccount = new FundAccount();
                    $fundAccount->single_invoice_id = null;
                    $fundAccount->receipt_account_id = $receiptAccount->id;
                    $fundAccount->receive = 00.0; //استلم الصندوق فلوس من المريض
                    $fundAccount->taking = $receiptAccount->amount;
                    $fundAccount->save();
                }

             //   DB::commit();
                $this->showTable = true;
                session()->flash('message', 'Post successfully created.');
            // } catch (Exception $e) {
            //     DB::rollback();
            //     // $e->getMessage();
            //     session()->flash('message', $e->getMessage());
            // }
        }
    }

    public function delete($id)
    {
        $this->receipt_account_id = $id;
    }

    public function destroy()
    {
        $receiptAccount = ModelsReceiptAccount::findOrFail($this->receipt_account_id);
        ModelsReceiptAccount::destroy($this->receipt_account_id);
        session()->flash('message', 'The deletion was completed successfully.');
        return redirect()->to('/receipt-account');
    }
}
