<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerExample\Zed\DateTimeConfiguratorPageExample\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Builder\FrontendBuilder;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Builder\FrontendBuilderInterface;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Reader\ProductConcreteAvailabilityReader;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Reader\ProductConcreteAvailabilityReaderInterface;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\DateTimeConfiguratorPageExampleDependencyProvider;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\Dependency\Facade\DateTimeConfiguratorPageExampleToAvailabilityFacadeInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @method \SprykerExample\Zed\DateTimeConfiguratorPageExample\DateTimeConfiguratorPageExampleConfig getConfig()
 */
class DateTimeConfiguratorPageExampleBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Reader\ProductConcreteAvailabilityReaderInterface
     */
    public function createProductConcreteAvailabilityReader(): ProductConcreteAvailabilityReaderInterface
    {
        return new ProductConcreteAvailabilityReader($this->getAvailabilityFacade());
    }

    /**
     * @return \SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Builder\FrontendBuilderInterface
     */
    public function createProductConfiguratorFrontendBuilder(): FrontendBuilderInterface
    {
        return new FrontendBuilder($this->getFileSystem(), $this->getConfig());
    }

    /**
     * @return \SprykerExample\Zed\DateTimeConfiguratorPageExample\Dependency\Facade\DateTimeConfiguratorPageExampleToAvailabilityFacadeInterface
     */
    public function getAvailabilityFacade(): DateTimeConfiguratorPageExampleToAvailabilityFacadeInterface
    {
        return $this->getProvidedDependency(DateTimeConfiguratorPageExampleDependencyProvider::FACADE_AVAILABILITY);
    }

    /**
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    public function getFileSystem(): Filesystem
    {
        return $this->getProvidedDependency(DateTimeConfiguratorPageExampleDependencyProvider::SYMFONY_FILE_SYSTEM);
    }
}
