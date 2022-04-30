<?php 

namespace App\Actions;

class CsvSlice
{
  /**
   * Load desired_count rows from filename starting at position start.
   *
   * @param string $filename
   *   CSV filename.
   * @param int $start
   *   Starting position in file.
   * @param int $desired_count
   *   Count of rows requested.
   *
   * @return array|bool
   *   Array of Objects or FALSE
  */
  public function execute($filename, $start, $desired_count) {
        $row = 0;
        $count = 0;
        $rows = array();
        if (($handle = fopen($filename, "r")) === FALSE) {
            return FALSE;
        }
        while (($row_data = fgetcsv($handle, 2000, ",")) !== FALSE) {
        // Grab headings.
            if ($row == 0) {
              $headings = $row_data;
              $row++;
              continue;
            }

            // Not there yet.
            if ($row++ < $start) {
              continue;
            }

            $rows[] = (object) array_combine($headings, $row_data);
            $count++;
            if ($count == $desired_count) {
                return $rows;
            }
        }
        return $rows;
    }
}