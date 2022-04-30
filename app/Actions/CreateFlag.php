<?php

namespace App\Actions;

use App\Models\Flag;
use Illuminate\Support\Facades\Config;

/**
 * 
 */
class CreateFlag
{
	
	public function __construct(Flag $flag)
	{
		$this->flag = $flag;
	}

	public function execute($csv_file): Flag
	{
		try {
           $fname = md5(rand()) . '.csv';
           $full_path = Config::get('filesystems.disks.local.root');
           $csv_file->move( $full_path, $fname );

           // Flag new file upload
           $flag_table = Flag::create(['file_name'=>$fname]);
           return $flag_table;
       }catch(\Exception $e){
           return $e->getMessage(); 
       }
	}
}