<?php
require_once __DIR__ . '/../vendor/autoload.php'; 
use PHPUnit\Framework\TestCase;
use DataValidation\Validation;

/**
 * Validation test case.
 */
class ValidateTest extends TestCase
{
    protected function getDataSet()
    {
        $filename = __DIR__.'/_files/example_data2.csv';
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
   
    public function testValidateLatitude() {
        $this->markTestSkipped(
            'tests ok'
            );
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['latitude','textos','somente.valores.definidos', 'somente.valores.definidos.2']);
            $this->validation->validate('latitude', $this->validation::TEST_GEOMETRIC_LATITUDE);
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        echo $this->validation->getLog();
        $this->AssertEquals(false, $this->validation->getisOk());
    }
    
    public function testValidateLongitude() {
        $this->markTestSkipped(
            'tests ok'
            );
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['latitude','textos','somente.valores.definidos', 'somente.valores.definidos.2']);
            $this->validation->validate('latitude', $this->validation::TEST_GEOMETRIC_LONGITUDE);
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        echo $this->validation->getLog();
        $this->AssertEquals(false, $this->validation->getisOk());
    }
    
    public function testValidateValues() {
        $this->markTestSkipped(
            'tests ok'
            );
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['latitude','textos','somente.valores.definidos', 'somente.valores.definidos.2']);
            $values=['true', 'false'];
            $this->validation->validate('somente.valores.definidos', $this->validation::TEST_VALUES_DEFINED,$values);
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        echo $this->validation->getLog();
        $this->AssertEquals(false, $this->validation->getisOk());
        
        
        //its ok
        try {
            $this->validation->setData($this->dataset);
            $this->validation->setHead(['latitude','textos','somente.valores.definidos', 'somente.valores.definidos.2']);
            $values=[1, 2, 3];
            $this->validation->validate('somente.valores.definidos2', $this->validation::TEST_VALUES_DEFINED,$values);
        }catch(Exception $e) {
            var_dump($e->getCode());
        }
        echo $this->validation->getLog();
        $this->AssertEquals(false, $this->validation->getisOk());
        
    }   
    
    
}

