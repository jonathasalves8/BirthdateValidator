<?php 
$date = new TDate('birthdate');
$date->addValidation('Data de Nascimento', new BirthdateValidator);
