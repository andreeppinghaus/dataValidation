<?php
namespace DataValidation;

/**
 * Validation Interface
 * Define roles for superior class
 * not dependency
 * @author andre
 *
 */
interface ValidationInterface
{
    /**
     * Check if columns exist
     * Check that columns are not empty
     */
    public function verify() ;
    
    /**
     * Remove malicious code and verify 
     * that it conforms to the data dictionary
     */
//     public function validate();
}

