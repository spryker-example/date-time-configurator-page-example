<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerExample\Zed\DateTimeConfiguratorPageExample\Business\Builder;

use Psr\Log\LoggerInterface;
use SprykerExample\Zed\DateTimeConfiguratorPageExample\DateTimeConfiguratorPageExampleConfig;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class FrontendBuilder implements FrontendBuilderInterface
{
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * @var \SprykerExample\Zed\DateTimeConfiguratorPageExample\DateTimeConfiguratorPageExampleConfig
     */
    protected $config;

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \SprykerExample\Zed\DateTimeConfiguratorPageExample\DateTimeConfiguratorPageExampleConfig $config
     */
    public function __construct(Filesystem $filesystem, DateTimeConfiguratorPageExampleConfig $config)
    {
        $this->filesystem = $filesystem;
        $this->config = $config;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return bool
     */
    public function build(LoggerInterface $logger): bool
    {
        try {
            $this->filesystem->mirror($this->config->getFrontendOriginPath(), $this->config->getFrontendTargetPath());
        } catch (IOException $exception) {
            $logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}
