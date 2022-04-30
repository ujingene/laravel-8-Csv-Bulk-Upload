<?php 

namespace App\Actions;

use App\Imports\InvoicesImport;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Exception;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;

class MaatswebsiteUpload
{
	public function execute($flag)
	{
		try {
			//get csv file from disk
            $file_path = Config::get('filesystems.disks.local.root') . '/' .$flag->file_name;

	       	//import the rows
            Excel::import(new InvoicesImport, $file_path);

            // flag import complete
            $flag->imported = 1;
       		$flag->save();

        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

	}
}