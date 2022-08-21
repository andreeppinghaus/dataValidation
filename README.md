# dataValidation
Classes para uso pessoal de validação de dados

### Instalação ###

composer require andreeppinghaus/data-validation:dev-main

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