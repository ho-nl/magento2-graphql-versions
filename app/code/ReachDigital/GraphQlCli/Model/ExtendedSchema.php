<?php
namespace ReachDigital\GraphQlCli\Model;

class ExtendedSchema extends \GraphQl\Type\Schema
{
    // No parameter type: old webonyx (Magento <= 2.4.3) declares getType($name) untyped,
    // and narrowing the parameter in a subclass is fatal. The return type stays because
    // newer webonyx declares one and removing it in a subclass is equally fatal.
    public function getType($name): ?\GraphQL\Type\Definition\Type {
        if ($name === 'Subscription') {
            return null;
        }
        return parent::getType($name);
    }
}