<?php

/**
 * @file
 * Contains WP\Console\Core\Command\Shared\ContainerAwareCommandTrait.
 */

namespace WP\Console\Command\Shared;

/**
 * Class CommandTrait
 *
 * @package WP\Console\Core\Command
 */
trait ContainerAwareCommandTrait
{
    use CommandTrait;

    protected $container;

    /**
     * @param mixed $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @param $key
     * @return null|object
     */
    public function has($key)
    {
        if (!$key) {
            return null;
        }

        return $this->container->has($key);
    }

    /**
     * @param $key
     * @return null|object
     */
    public function get($key)
    {
        if (!$key) {
            return null;
        }

        if ($this->has($key)) {
            return $this->container->get($key);
        }

        return null;
    }
}
