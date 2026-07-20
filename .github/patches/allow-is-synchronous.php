<?php
// Republished module packages ship communication.xml files using the
// is_synchronous topic attribute, which the communication.xsd of early
// Magento 2.3.x predates — setup:install then fails XML validation.
// Backport the attribute declaration (present since 2.3.5).

$file = 'vendor/magento/framework/Communication/etc/communication.xsd';
if (!file_exists($file)) {
    echo "$file not present, skipping\n";
    exit(0);
}
$src = file_get_contents($file);
if (strpos($src, 'is_synchronous') !== false) {
    echo "communication.xsd already allows is_synchronous, skipping\n";
    exit(0);
}
$anchor = '<xs:attribute type="xs:string" name="response" use="optional"/>';
if (strpos($src, $anchor) === false) {
    echo "WARNING: expected anchor not found in $file, leaving untouched\n";
    exit(0);
}
$addition = $anchor . "\n        " . '<xs:attribute type="xs:boolean" name="is_synchronous" use="optional"/>';
file_put_contents($file, str_replace($anchor, $addition, $src));
echo "Patched $file to allow is_synchronous\n";
