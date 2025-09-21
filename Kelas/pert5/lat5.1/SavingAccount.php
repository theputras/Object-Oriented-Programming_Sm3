    <?php
require 'BankAccount.php';



// Child Class
class SavingAccount extends BankAccount {
    private $interestRate;

    public function setInterestRate($rate) {
        $this->interestRate = $rate;
    }
    public function addInterest(){
        $interest = $this -> interestRate * $this->getBalance();
        $this -> deposit ($interest);
    }
    
}