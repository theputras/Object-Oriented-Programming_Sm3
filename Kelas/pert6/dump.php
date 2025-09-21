<?php
abstract class dump {
    abstract public function dump ($pesan);
}

class webDUmper extends dump { 

    public function dump($pesan) {
        echo "</pre>";
        var_dump($pesan);
        echo "</pre>";
    }
}


class consoleDumper extends dump {
    public function dump($pesan) {
        var_dump($pesan);
    }
}