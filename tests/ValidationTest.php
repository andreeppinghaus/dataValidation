<?php
// require_once __DIR__ . '/../autoload.php'; 
require_once __DIR__ . '/../vendor/autoload.php'; 
use PHPUnit\Framework\TestCase;
use DataValidation\Validation;

/**
 * Validation test case.
 */
class ValidationTest extends TestCase
{

    /**
     *
     * @var Validation
     */
    private $validation;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // TODO Auto-generated ValidationTest::setUp()

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
    
    public function additionProvider()
    {
        $data = ['col1', 'col2', 'col3'];
        
        return [
            [$data, 0, 0],
        ];
    }
    /**
     * @dataProvider additionProvider
     */
    public function testValidationColumn($data, $a1, $a2) {
      
        print($data);
        $this->AssertEquals(123, 123);
    }
    
    
}

