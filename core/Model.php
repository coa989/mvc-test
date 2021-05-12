<?php


namespace app\core;


abstract class Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

}