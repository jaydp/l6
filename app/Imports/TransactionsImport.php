<?php

namespace App\Imports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class TransactionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		/*print_r($row);
		exit;*/
        extract($row);
		$transaction_time = Carbon::createFromFormat('d/m/Y', $transaction_time)->startOfDay()->format("Y-m-d 00:00:00");
		/*print_r($transaction_time);
		exit;
		$transaction_time = "2020-04-02 17:11:31";*/
		
		if(!Transaction::where(['transaction_time'=> $transaction_time, 'amount' => $amount, 'description' => $description, 'balance' => $balance])->exists()) {
			return new Transaction([
				'transaction_time' => $transaction_time,
				'amount' => $amount,
				'description' => $description,
				'balance' => $balance,
			]);
		}
    }
}
