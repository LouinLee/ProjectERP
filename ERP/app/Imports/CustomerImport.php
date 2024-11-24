<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class CustomerImport implements ToModel, WithHeadingRow
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

            return new Customer([
                'customer_code' => $row['customer_code'],
                'customer_name' => $row['customer_name'],
                'email' => $row['email'],
                'address' => $row['address'],
                'phone_number' => $row['phone_number'],
                'password' => $row['password'],
            ]);
        } else {
            return null;
        }
    }
}
