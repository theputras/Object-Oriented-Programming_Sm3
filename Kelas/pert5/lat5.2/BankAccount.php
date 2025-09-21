<?php
class BankAccount {
    protected $name; // Diubah menjadi protected
    protected $balance = 0;

    public function __construct($name) {
        $this->name = $name;
    }

    public function deposit($amount) {
        $this->balance += $amount;
        echo "Deposit sebesar Rp" . $amount . " berhasil dilakukan.";
        echo "\n";
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            echo "Penarikan sebesar Rp" . $amount . " berhasil dilakukan.";
        } else {
            echo "Saldo tidak mencukupi.";
        }
        echo "\n";
    }

    public function getBalance() {
        return $this->balance;
    }

    public function transfer($amount, BankAccount $recipient) {
        if ($amount <= $this->balance) {
            $this->withdraw($amount);
            $recipient->deposit($amount);
            echo "Transfer sebesar Rp" . $amount . " ke " . $recipient->name . " berhasil dilakukan.";
            echo "\n";
        } else {
            echo "Saldo tidak mencukupi.";
            echo "\n";
        }
    }
}

class SavingAccount extends BankAccount {
    private $interestRate = 0.05;

    public function calculateInterest() {
        $interest = $this->balance * $this->interestRate;
        $this->balance += $interest;
        echo "Bunga sebesar Rp" . $interest . " telah ditambahkan.";
        echo "\n";
    }
}

class CurrentAccount extends BankAccount {
    private $overdraftLimit = 1000000;

    public function withdraw($amount) {
        if ($amount <= $this->balance + $this->overdraftLimit) {
            $this->balance -= $amount;
            echo "Penarikan sebesar Rp" . $amount . " berhasil dilakukan.";
        } else {
            echo "Saldo dan overdraft limit tidak mencukupi.";
        }
        echo "\n";
    }
}
?>
