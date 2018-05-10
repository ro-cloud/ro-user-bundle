<?php

use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{

    /**
     * Returns an array of bundles to register.
     *
     * @return iterable|\Symfony\Component\HttpKernel\Bundle\BundleInterface An iterable of bundle instances
     */
    public function registerBundles()
    {
        return [
            new \RoCloud\UserBundle\RoCloudUserBundle(),
        ];
    }

    /**
     * Loads the container configuration.
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
    }
}
