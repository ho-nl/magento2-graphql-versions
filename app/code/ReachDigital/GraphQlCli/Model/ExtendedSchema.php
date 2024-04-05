<?php
namespace ReachDigital\GraphQlCli\Model;

class ExtendedSchema extends \GraphQl\Type\Schema
{
    public function getType($name) {
        if ($name === 'Subscription') {
            return null;
        }
        return parent::getType($name);
    }
}