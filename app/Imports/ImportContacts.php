<?php

namespace App\Imports;

use App\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportContacts implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		print_r($row);
		print_r($row['name']);
		print_r($row['email']);
		print_r($row['phone']);
		//exit;
        return new Contact([
            'name' => $row['name'],
            'email' => $row['email'], 
            'phone' => $row['phone']
        ]);
    }
}
