# Laravel 8 Csv Bulk Upload

# The Application uses two methods to process csv files

## Maatswebsite Excel Package

App\Actions\MaatswebsiteUpload
```
try {
    ...
    //import the rows
    Excel::import(new InvoicesImport, $file_path);

} catch (Exception $e) {
    //
}
```
### Makes use of the import file

App\Imports\InvoicesImport
```
/**
* @param array $row
*
* @return \Illuminate\Database\Eloquent\Model|null
*/
public function model(array $row)
{
    $InvoiceDate = Carbon::parse($row['InvoiceDate'])->toDateTimeString();
    return new Invoice([
        'InvoiceNo' => $row['InvoiceNo'],
        'StockCode' => $row['StockCode'],
        'Description' => $row['Description'],
        'Quantity' => $row['Quantity'],
        'InvoiceDate' => $InvoiceDate,
        'UnitPrice' => $row['UnitPrice'],
        'CustomerID' => $row['CustomerID'],
        'Country' => $row['Country']
    ]);
}

public function batchSize(): int
{
    return 1000;
}

public function chunkSize(): int
{
    return 1000;
}
```

## Laravel Custom Function to process 
```
try{
    $flagname = Storage::path($flag->file_name);
    
    $rows = $this->csvRowCount->execute($flagname);
    $items_per_run = 100;
    for ($i=0; $i <= $rows; $i = $i+$items_per_run+1) {
        $chunk = $this->csvSlice->execute($flagname, $i, $items_per_run);
        foreach ($chunk as $item) {
            echo "item stock code no = " .  $item->StockCode . "\n";

            $item->InvoiceDate = Carbon::parse($item->InvoiceDate)->toDateTimeString();

                $invoice[] = Invoice::create((array) $item);
            } 
        }
    } catch (\Exception $e)
    {
        return $e->getMessage();
    }

```

# Setup & Configuration
Open up a terminal and navigate to the root directory of this project.

```
cp .env.example .env
```

## install composer dependecies
```
composer run install
```

## install npm dependecies
```
npm i
```

## Generate Application Key

```
php artisan key:generate
```

## Clear Application Configurations and Cache by running the following commands

```
php artisan config:cache
php artisan optimize:clear
```

## update the database configurations with your preferred details

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marvel
DB_USERNAME=root
DB_PASSWORD=
```

## Run migrations
```
php artisan migrate
```

### run composer update
```
composer update
```

### start laravel dev server
```
php artisan serve
```

### open another terminal to execute queue worker
```
php artisan queue:work
```

or listen to fired events 

```
php artisan queue:listen
```

