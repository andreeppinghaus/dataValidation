# dataValidation
Classes para uso pessoal de validação de dados

### Instalação ###

composer require andreeppinghaus/data-validation:dev-main

### Testes ####
Remova as linhas com o marcador para pular os testes.

Exemplo:
```
$this->markTestSkipped(
            'tests ok'
            );
```

Depois rode:
           
composer test

### Exemplo ###

```
require_once("vendor/autoload.php");

use DataValidation\Validation;

$validation = new Validation();

validation->setData(<  csv file with columns in head >);

validation->setHead(< array with name of columns file >);

validation->setColsRequired(< array with of columns that must exist >);

$validation->verify();

$validation->validaton();

if (! validation->getisOk() ) {
	var_dump(validation->getLog());
}
```