<?php
require_once __DIR__ . '/../vendor/autoload.php'; 
use PHPUnit\Framework\TestCase;
use DataValidation\Validation;

/**
 * Validation test case.
 */
class VerifyTest extends TestCase
{
    protected function getDataSet()
    {
        $filename = __DIR__.'/_files/example_data.csv';
        $csv = array_map("str_getcsv", file($filename,FILE_SKIP_EMPTY_LINES ));
        $keys = array_shift($csv);
        foreach ($csv as $i=>$row) {
            $data[$i] = array_combine($keys, $row);
        }
        
        $this->dataset = $data; 
    }
    
    /**
     *
     * @var Validation
     */
    private $validation;

    private $dataset;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // TODO Auto-generated ValidationTest::setUp()
        $this->getDataSet();
        $this->validation = new Validation();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        // TODO Auto-generated ValidationTest::tearDown()
        $this->validation = null;

        parent::tearDown();
    }
    
   
    public function testVerifyHead() {
      
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->verifyHead();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        $this->AssertEquals(true, $this->validation->getisOk());
        
        //column not found
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC', 'colunaD' ]);
            $this->validation->verifyHead();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(false, $this->validation->getisOk());
        
        
    }
    
    public function testVerifyEmptyCols() {
        // its ok  not empty
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->setColsRequired(['colunaA','colunaC' ]);
            $this->validation->verifyColumnsRequired();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(true, $this->validation->getisOk());
        
        // its not ok column B empty
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->setColsRequired(['colunaA','colunaB','colunaC' ]);
            $this->validation->verifyColumnsRequired();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(false, $this->validation->getisOk());
        
    }
    
    public function testVerify() {
        // its ok  not empty
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->setColsRequired(['colunaA','colunaC' ]);
            $this->validation->verify();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(true, $this->validation->getisOk());
        
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->verify();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        $this->AssertEquals(true, $this->validation->getisOk());
        
        // its not ok column B empty
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC' ]);
            $this->validation->setColsRequired(['colunaA','colunaB','colunaC' ]);
            $this->validation->verify();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(false, $this->validation->getisOk());
        
        
        //column not found
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['colunaA','colunaB','colunaC', 'colunaD' ]);
            $this->validation->verify();
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        
        echo $this->validation->getLog();
        
        $this->AssertEquals(false, $this->validation->getisOk());
        
    }
    
}

