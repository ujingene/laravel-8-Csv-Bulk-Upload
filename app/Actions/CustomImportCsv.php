<?php 

namespace App\Actions;

use App\Actions\CsvRowCount;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CustomImportCsv
{
	public function __construct(CsvRowCount $csvRowCount, CsvSlice $csvSlice)
	{
		$this->csvRowCount = $csvRowCount;
		$this->csvSlice = $csvSlice;
	}
	public function execute($flag)
	{
        $flagname = Storage::path($flag->file_name);

        //dd($flagname);

        // Count them, then grab them in chunks of 100.
        $rows = $this->csvRowCount->execute($flagname);
        $items_per_run = 100;
        for ($i=0; $i <= $rows; $i = $i+$items_per_run+1) {
        	$chunk = $this->csvSlice->execute($flagname, $i, $items_per_run);
        	foreach ($chunk as $item) {
        		echo "item stock code no = " .  $item->StockCode . "\n";

        		$item->InvoiceDate = Carbon::parse($item->InvoiceDate)->toDateTimeString();

        		try {
        			$invoice[] = Invoice::create((array) $item);
        		} catch (\Exception $e)
        		{
        			return $e->getMessage();
        		}
        	}
        }

        return redirect()->route('csv_page');

	}
}