<?php

class GladosListener implements PHPUnit_Framework_TestListener {

    protected $suites = array();

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) {}
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) {}
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
    public function startTest(PHPUnit_Framework_Test $test) {}
    public function endTest(PHPUnit_Framework_Test $test, $time) {}
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite) {}
 
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite) {
        $this->suites[] = $suite;
    }

    public function __destruct() {
        $bSkippedOrIncomplete = false;
        foreach($this->suites as $suite) {
            foreach($suite->tests() as $test) {
                $status = $test->getStatus();
                if($status == PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE) {
                    $this->showFailure();
                    return;
                } else if($status == PHPUnit_Runner_BaseTestRunner::STATUS_SKIPPED 
                    || $status == PHPUnit_Runner_BaseTestRunner::STATUS_INCOMPLETE
                    ) {
                    $bSkippedOrIncomplete = true;
                }
            }
        }
        if($bSkippedOrIncomplete == true) {
            $this->showSkipped();
            return;
        }
        $this->showSuccess();
    }

    protected function showFooter() {
        echo PHP_EOL, PHP_EOL, "CONTINUE TESTING!", PHP_EOL, PHP_EOL;
    }

    protected function showSuccess() {
        echo <<<CAKE
           N                     
            N                    
             N                   
            =Z                   
        MM=:                 ,   
     M MMMMMM       ?MMMM7ZM?    
    M  MMMMMMDMM~      DM,  MMI  
 ZMMD, MMMMMM   M   MD  ,MMMMMI  
 MI    M ,:   M ,M?  \$MMMMMMM7  
 M OM~  MM   DM,  MMMMMMMM    :  
 M        ,,  ,MMMMMMMD    MMMI  
 M          MMMMMMM7    MMMMMMI  
 M          MMMM=   +MMMMMMM$    
 M          M    MMMMMMMM+   =I  
 M            MMMMMMMM    MMMMI  
 M          MMMMMMZ    MMMMMMMI  
 M          MMM+   ~MMMMMMMO     
 M          ,   7MMMMMMMI        
 M           MMMMMMMM,           
 ,M         MMMMMO               
    MM7     MMI                  
CAKE;
        $this->showFooter();
    }

    protected function showSkipped() {
        echo <<<FUU
            $$:  $$$$$$$$\$Z             
          7$$$$$$  +$$$$$$$$$$           
       ,$$$$$$$$$\$Z  Z$\Z$$$$$$  $,       
      $$$$$$$$$$$$$$~  $$$$$$$  $$$      
     $$$$$$$$$$$$$$$$$  ?Z$$$$  $$$$+    
                          $$$$  $$$$\$I   
  ,$$$$$$$$7$=             +$7  $$$$$$   
  $$$$$$$$\$Z                 Z  $$$$$$$  
 7$$$$$$$$                      $$$$$$$$ 
 $$$$$$\$Z                       $$$$$$   
 $$$$$7         SKIPPED         $$$$$  Z~
 $$$$+  $         OR            $$$  +$$7
 $$$  $$$       INCOMPLETE      $~  $$$$$
 7   Z$$$                         Z$$$$$+
   7$$$$$                        $$$$$$$ 
 :$\$Z$$$$                      $$$$$$$$$ 
  $$$$$$$  +                 +$$$$$$$$$  
  +$$$$$$  $$               $$$$$$$$$$?  
   Z$$$$$  $$\$Z                          
    ~$$$$  $$$$$+  $$$$$$$$$$$$$$$$$$    
      $$$  $$$$$$$  ~$$$$$$$$$$$$$$      
       $$  $$$$$$$$+  7Z$$$$$$$$\$Z       
           $$$$$$$$$$  :$$$$$$$=         
            =$$$$$$$$\$Z  Z$$$            
                  ?7$7I                  
FUU;
        $this->showFooter();
    }

    protected function showFailure() {
        echo <<<TURRET
        .                       
         .==:.             
         ====I~            
        ~~=====            
       ~=+~===$=           
       =========           
       ~~===~====          
      ~~~~==~~===.         
      ~~====: ===.         
      ~=====: ~~=          
      O======+IN+          
     ?=======+\$N+         
   ~?Z~~=====~=+=          
   ?? ~~~~=======          
    N .~~===~==+=.         
   .D. ~~~======           
    D   ~====$+?           
   OD   ===+I7Z+++++.      
   D8   ++=   .O8  =++=    
   D8   =+++        +=D.   
   N    ====         ..O   
   N.     D.           8   
         .ZO            8  
          +8           .8  
          ,8            :O 
          O8            .D 
          .D               
           D               
           :.              
           8               
TURRET;
        $this->showFooter();
    }

}

