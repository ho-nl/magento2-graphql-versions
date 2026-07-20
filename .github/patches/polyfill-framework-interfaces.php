<?php
// Adobe republished old module packages (MSI, security-package) in place with
// code that implements framework interfaces introduced in Magento 2.4.6. On
// Magento < 2.4.6 those interfaces don't exist and class loading fatals during
// setup:install. Polyfill them with the upstream definitions when missing.

// Plain heredoc closers ("PHP;") only: the closing-marker-with-comma form used in
// arrays is PHP 7.3+ syntax and this script must run on PHP 7.2 for Magento 2.3.x.
$resetAfterRequestInterface = <<<'PHP'
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Framework\ObjectManager;

/**
 * This interface is used to reset service's mutable state, and similar problems, after request has been sent in
 * Stateful application server and can be used in other long running processes where mutable state in services can
 * cause issues.
 */
interface ResetAfterRequestInterface
{
    /**
     * Resets mutable state and/or resources in objects that need to be cleaned after a response has been sent.
     *
     * @return void
     */
    public function _resetState(): void;
}
PHP;

$buttonLockInterface = <<<'PHP'
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Framework\View\Element;

use Magento\Framework\Exception\InputException;

interface ButtonLockInterface
{
    /**
     * Get button code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * If the button should be temporary disabled
     *
     * @return bool
     * @throws InputException
     */
    public function isDisabled(): bool;
}
PHP;

$polyfills = [
    'vendor/magento/framework/ObjectManager/ResetAfterRequestInterface.php' => $resetAfterRequestInterface,
    'vendor/magento/framework/View/Element/ButtonLockInterface.php' => $buttonLockInterface,
];

if (!is_dir('vendor/magento/framework')) {
    // Mage-OS installs the framework as vendor/mage-os/framework; its bases
    // are all >= 2.4.6 so these polyfills are never needed there.
    echo "vendor/magento/framework not present (non-Magento distribution?), skipping polyfills\n";
    exit(0);
}

foreach ($polyfills as $file => $source) {
    if (file_exists($file)) {
        echo "$file already exists, skipping\n";
        continue;
    }
    if (!is_dir(dirname($file))) {
        fwrite(STDERR, "Directory for $file does not exist — unexpected layout\n");
        exit(1);
    }
    file_put_contents($file, $source . "\n");
    echo "Polyfilled $file\n";
}
