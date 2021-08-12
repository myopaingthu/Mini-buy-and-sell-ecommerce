<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'  => $row['name'],
            'description' => $row['description'],
            'price'    => $row['price'],
            'phone'    => $row['phone'],
            'address'    => $row['address'],
            'category_id'    => $row['category_id'],
            'user_id'    => $row['user_id'],
            'available'    => $row['available'],
        ]);
    }
}
