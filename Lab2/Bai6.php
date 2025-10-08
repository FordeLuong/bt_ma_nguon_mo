<?php

class BankAccount {
    public $stk;
    public $name;
    public $remain;

    public function __construct($stk, $name, $remain) {
        $this->stk = $stk;
        $this->name = $name;
        $this->remain = $remain;
    }

    public function naptien($amount) {
        return $this->stk + $amount;
    }

    public function ruttien($amount) {
        if ($amount > $this->remain) {
            echo "Số dư không đủ để rút tiền<br>";
        } else {
            return $this->stk - $amount;
        }
    }

    public function kttrmain() {
        return $this->remain;
    }
}

//Sử dụng
$account =  new BankAccount(123456, "Liêm Phong", 5000000); 
echo "Số tài khoản: {$account->stk} <br>";
echo "Tên chủ tài khoản: {$account->name} <br>";
echo "Số dư tài khoản: {$account->remain} <br>";

echo "Số dư sau khi nạp tiền: {$account->naptien(2000000)} <br>";
echo "Số dư sau khi rút tiền: {$account->ruttien(1000000)} <br>";   
    
?>