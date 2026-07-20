<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace ReachDigital\GraphQlCli\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;

class GetGraphQlSchema extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Magento\Framework\App\State
     */
    private $state;

    private $configLoader;

    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    private $directoryList;

    // Only lazy/lightweight dependencies here: Magento's console instantiates every
    // command eagerly and silently drops commands whose DI graph throws. The
    // SchemaGenerator is fetched in execute() from the graphql-area object manager.
    public function __construct(
        \Magento\Framework\App\State\Proxy $state,
        \Magento\Framework\App\ObjectManager\ConfigLoader $configLoader,
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList
    )
    {
        parent::__construct();
        $this->state = $state;
        $this->configLoader = $configLoader;
        $this->directoryList = $directoryList;
    }

    /**
     * Initialization of the command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('reach-digital:get-graphql-schema')
            ->setDescription('Builds and returns the GraphQl schema.');

        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \Exception
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $compiledConfigForGraphQlArea = $this->configLoader->load(\Magento\Framework\App\Area::AREA_GRAPHQL);

            $this->state->emulateAreaCode(\Magento\Framework\App\Area::AREA_GRAPHQL, function () use ($compiledConfigForGraphQlArea, $output) {
                //re-configure object manager with frontend area di compiled config
                $objectManager = ObjectManager::getInstance();
                $objectManager->configure($compiledConfigForGraphQlArea);

                //use the new context to get the class, otherwise di from global area is used and it breaks
                $generator = $objectManager->get(\Magento\Framework\GraphQl\Schema\SchemaGenerator::class);
                $schema = $generator->generate();
                $extendedSchema = new \ReachDigital\GraphQlCli\Model\ExtendedSchema($schema->getConfig());
                $schemaFile = fopen($this->directoryList->getRoot() . '/schema.graphql', 'w');
                fwrite($schemaFile, \GraphQL\Utils\SchemaPrinter::doPrint($extendedSchema));
                fclose($schemaFile);
            });

        } catch (\Exception $e) {
            echo 'exception: ' . $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
            throw $e;
        }

        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}