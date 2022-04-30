<?php

namespace App\Http\Controllers;

use App\Actions\CreateFlag;
use App\Actions\CustomImportCsv;
use App\Events\FlagCreatedEvent;
use App\Jobs\ProcessCSVJob;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CsvUploadController extends Controller
{
    public function __construct(
        CustomImportCsv $uploadBulkInvoice, 
        CreateFlag $createFlag
    )
    {
        $this->uploadBulkInvoice = $uploadBulkInvoice;
        $this->createFlag = $createFlag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Cache::remember('invoice_list', Carbon::now()->addDays(7), function() { 
                return Invoice::paginate(100);
            }
        );
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $flag
     * @return \Illuminate\Http\Response
     */
    public function import_custom()
    {
        $flag = $this->createFlag->execute(request()->file('invoiceDoc'));

        FlagCreatedEvent::dispatch($flag);

        return redirect()->route('csv_page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $flag
     * @return \Illuminate\Http\Response
     */
    public function import_maatwebsite()
    {
        $flag = $this->createFlag->execute(request()->file('invoiceDoc'));

        ProcessCSVJob::dispatch($flag);

        return redirect()->route('csv_page');
    }
}
