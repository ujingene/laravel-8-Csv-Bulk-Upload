<?php 

namespace App\Actions;

class CsvRowCount
{
	/**
     * Count the number of rows in a CSV file excluding header row.
     *
     * @param string $filename
     *   CSV filename.
     *
     * @return int
     *   Number of rows.
     */
	public function execute($filename) {
      ini_set('auto_detect_line_endings', TRUE);
      $row_count = 0;
      if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($row_data = fgetcsv($handle, 2000, ",")) !== FALSE) {
          $row_count++;
        }
        fclose($handle);
        // Exclude the headings.
        $row_count--;
        return $row_count;
      }
    }

}