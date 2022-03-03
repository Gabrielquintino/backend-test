<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function get($code = null)
    {
        if ($code) {
            return Transaction::select($code);
        } else {
            return Transaction::selectAll();
        }
    }

    public function post()
    {
        $data = $_POST;

        return Transaction::insert($data);
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}