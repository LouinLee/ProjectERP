<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $rowCount = 1;

    public function model(array $row)
    {
        $this->rowCount++;
        if ($this->rowCount > 1) {

            // Log::info('Row Data:', $row);

            return new Product([
                'product_code' => $row['product_code'],
                'product_name' => $row['product_name'],
                'unit' => $row['unit'],
                'price' => floatval($row['price']), // Ensure price is a float
                'quantity' => intval($row['quantity']), // Ensure quantity is an integer
            ]);
        } else {
            return null;
        }
    }
}
