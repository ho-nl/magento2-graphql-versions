<?php
// Backport of ACSD-59280 (fixed in Magento 2.4.5): the code generator in older
// Magento crashes with "Call to undefined method ReflectionUnionType::getName()"
// when a dependency uses PHP 8 union types in signatures. Run after composer
// install, before setup:install.

$file = 'vendor/magento/framework/Code/Generator/EntityAbstract.php';
if (!file_exists($file)) {
    // Mage-OS installs the framework as vendor/mage-os/framework; its bases
    // are all >= 2.4.6 so this patch is never needed there.
    echo "$file not present (non-Magento distribution?), skipping patch\n";
    exit(0);
}
$src = file_get_contents($file);
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
