<?php
namespace DataValidation;

/**
 * Class with real code respecting 
 * interface class rules
 * @author andre
 *
 */
class ValidationAbstract implements ValidationInterface
{

//     public function __construct() {
//         $this->setIsOk(true);
//     }
    /**
     * Required Columns 
     * @var array
     */
    private $colsRequired=[];
    
    /**
     * Name of columns that must exist
     */
    
    private $head=[];
    
    /**
     * Head of columns not found
     */
    private $headNotFound=[];
    
    /**
     * Expected Data not found inside columns
     * @var array
     */
    private $expectedDataNotFound=[];
    
    /**
     * All verified ist's ok
     */
    private $isOk = true;
    
    /**
     * array with data from source like csv file
     */
    
    private $data;
    
    
    /**
     * Error log
     * @var string
     */
    
    private $log="";
    
    
    /**
     *  Methods
     */
    
    /**
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }
    
    /**
     * @param string $log
     */
    public function setLog($log)
    {
        $this->log .= "\n".$log;
    }
    
    /**
     * @return multitype:
     */
    public function getHeadNotFound()
    {
        return $this->headNotFound;
    }

    /**
     * @param multitype: $headNotFound
     */
    public function setHeadNotFound($headNotFound)
    {
        $this->headNotFound = $headNotFound;
    }
    
    /**
     * @return array
     */
    public function getColsRequired()
    {
        return $this->colsRequired;
    }

    /**
     * @return array
     */
    public function getExpectedDataNotFound()
    {
        return $this->expectedDataNotFound;
    }

    /**
     * @return boolean
     */
    public function getIsOk()
    {
        return $this->isOk;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return multitype:
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param array $colsRequired
     */
    public function setColsRequired($colsRequired)
    {
        $this->colsRequired = $colsRequired;
    }

    /**
     * @param array $expectedDataNotFound
     */
    public function setExpectedDataNotFound($expectedDataNotFound)
    {
        $this->expectedDataNotFound = $expectedDataNotFound;
    }

    /**
     * @param boolean $isOk
     */
    public function setIsOk($isOk)
    {
        $this->isOk = $isOk;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param multitype: $head
     */
    public function setHead($head)
    {
        $this->head = $head;
    }
    
    
    /**
     * Verify name of columns that must exist
     */
    public function verifyHead() {
        
        if (! is_array($this->head)) {
            throw new \Exception('head is not array', 1002);
            return;
        }
        
        if (count($this->head)<= 0 ){
            throw new \Exception('head is empty', 1003);
            return;
        }
        
        $headsNotFound =[];
        foreach($this->getHead() as $key) {
            
            if ( ! array_key_exists($key, $this->data[0]) ) {
                $headsNotFound[] = $key;
            }
        }
        
        if (count($headsNotFound) > 0 ) {
            $this->setIsOk(false);
            $this->setHeadNotFound($headsNotFound);
            $errors = implode(', ', $headsNotFound);
            $this->setLog("Columns not found: \n $errors");
        }
    }
    
    public function verifyColumnsRequired() {
        
        if (! is_array($this->colsRequired)) {
            throw new \Exception('colsRequired is not array', 1004);
            return;
        }
        
        if (count($this->colsRequired)<= 0 ){
            throw new \Exception('colsRequired is empty', 1005);
            return;
        }
        
       $expectedDataNotFound=[];
        foreach ($this->getColsRequired() as $col) {
//             var_dump($col);
            foreach ($this->data as $data) {
                if (empty($data[$col])) {
                    $expectedDataNotFound[]=$col ;
                    $this->isOk = false;
                }//end if
            }//end foreach
        }//end foreach

        if (count($expectedDataNotFound) > 0 ) {
            $this->setIsOk(false);
            $this->setExpectedDataNotFound($expectedDataNotFound);
            $this->setLog("Empty data in: \n".implode('\n', $expectedDataNotFound));
        }
    }
    
    public function verify()
    {
        if (! is_array($this->data)) {
            throw new \Exception('data is not array', 1000);
            return;
        }
        
        if (count($this->data)<= 0 ){
            throw new \Exception('data is empty', 1001);
            return;
        }
       
        $this->verifyHead();
        
        $this->verifyColumnsRequired();
        
        return $this->getIsOk();
    }

    public function validate()
    {
        echo "validando";
    }
}

