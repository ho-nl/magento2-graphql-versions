<?php
// Backport of ACSD-59280 (fixed in Magento 2.4.5): the code generator in older
// Magento crashes with "Call to undefined method ReflectionUnionType::getName()"
// when a dependency uses PHP 8 union types in signatures. Run after composer
// install, before setup:install.

$file = 'vendor/magento/framework/Code/Generator/EntityAbstract.php';
$src = file_get_contents($file);
if ($src === false) {
    fwrite(STDERR, "Could not read $file\n");
    exit(1);
}
if (strpos($src, 'ReflectionUnionType') !== false) {
    echo "EntityAbstract.php already handles union types, skipping patch\n";
    exit(0);
}

$old = <<<'OLD'
        $parameterType = $parameter->getType();
        if ($parameterType->getName() === 'array') {
            $typeName = 'array';
        } elseif ($parameterClass = $this->getParameterClass($parameter)) {
            $typeName = $this->_getFullyQualifiedClassName($parameterClass->getName());
        } elseif ($parameterType->getName() === 'callable') {
            $typeName = 'callable';
        } else {
            $typeName = $parameterType->getName();
        }
OLD;

$new = <<<'NEW'
        $parameterType = $parameter->getType();

        if ($parameterType instanceof \ReflectionUnionType) {
            $parameterType = $parameterType->getTypes();
            $parameterType = implode('|', $parameterType);
        } else {
            $parameterType = $parameterType->getName();
        }

        if ($parameterType === 'array') {
            $typeName = 'array';
        } elseif ($parameterClass = $this->getParameterClass($parameter)) {
            $typeName = $this->_getFullyQualifiedClassName($parameterClass->getName());
        } elseif ($parameterType === 'callable') {
            $typeName = 'callable';
        } else {
            $typeName = $parameterType;
        }
NEW;

if (strpos($src, $old) === false) {
    echo "WARNING: expected pattern not found in $file, leaving untouched\n";
    exit(0);
}

file_put_contents($file, str_replace($old, $new, $src));
echo "Patched $file for union-type parameters\n";
