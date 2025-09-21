<?php
/* class EMoney */
class emoney {
    private $kode;
    private $saldo;    
    private $log;
    
    
    public function getSaldo(){
        return "\n". "\nSaldo:". $this->saldo;
    }
    
    
    public function __construct($kode, $saldo) {
        $this -> saldo = $saldo;
        $this -> kode = $kode;
        $this -> updateLog("Kartu Baru $kode");
    }
    
    private function updateLog($msg){
        $this -> log = $this -> log . "\n" . date("d/m/y H:i:s"). ": ". $msg;
       }
    public function getLog() {
        return $this -> log;
    }
    public function pay($amount){
    if ($this -> saldo >= $amount) {
    $this->  saldo -= $amount;
    $this -> updateLog("Pembayaran sebesar: ". $amount);
    } else {    
    $this -> updateLog("Saldo tidak cukup : ". $amount);
    }
    }
    public function topUp($amount){
        if ($amount >= 50000 && $amount % 50000 == 0) {
            $this -> saldo +=$amount;
            $this -> updateLog("Top up sebesar: Rp $amount");
        } else {
            $this -> updateLog("Duekmu Kurang su");
        }
        
        
    }
    /* 
    function topUp(int $amount):void {
        $this->saldo += $amount;
        $this->log .= "Top up saldo sebesar $amount. Saldo sekarang: $this->saldo\n";
    }
    
    function pay (int $amount) :void {
        if ($this -> saldo >= $amount) {
        $this -> saldo -= $amount;
        $this -> log .= "Pembayaran sebesar $amount berhasil. Saldo sekarang: $this -> saldo\n";
        } 
        else {
        $this -> log .= "Saldo tidak cukup untuk pembayaran \n";
        }
    }
    
    function getSaldo():int {
        return $this -> saldo;
    }
    
    function getLog():string {
        return $this -> log;
    } */
    
    
}
$etoll = new emoney("M001", 200000);
echo "Emoney" . "\n";
echo $etoll->getSaldo();
echo $etoll->getLog();
$etoll-> pay(25000);
echo $etoll->getSaldo();
echo $etoll->getLog();
$etoll-> topUp(60000);
echo $etoll->getSaldo();
echo $etoll->getLog();
$etoll-> topUp(60000);
echo $etoll->getSaldo();
echo $etoll->getLog();
$etoll-> pay(300000);
echo $etoll->getSaldo();
echo $etoll->getLog();
$etoll-> topUp(100000);
echo $etoll->getSaldo();
echo $etoll->getLog();


