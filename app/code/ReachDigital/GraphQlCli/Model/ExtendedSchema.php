<?php
namespace ReachDigital\GraphQlCli\Model;

class ExtendedSchema extends \GraphQl\Type\Schema
{
    public function getType(string $name): ?\GraphQL\Type\Definition\Type {
        if ($name === 'Subscription') {
            return null;
        }
        return parent::getType($name);
    }
}