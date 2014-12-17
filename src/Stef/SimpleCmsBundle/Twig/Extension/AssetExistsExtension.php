<?php

namespace Stef\SimpleCmsBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;

class AssetExistsExtension extends \Twig_Extension
{

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getFunctions()
    {
        return array(
            'asset_exists' => new \Twig_Function_Method($this, 'asset_exists'),
        );
    }

    public function asset_exists($path)
    {
        if (substr($path,0, 7) === 'http://') {
            return $this->checkWebAdress($path);
        }
        $webRoot = realpath($this->kernel->getRootDir() . '/../web/');
        $toCheck = realpath($webRoot . $path);

        // check if the file exists
        if (!is_file($toCheck))
        {

            return false;
        }

        // check if file is well contained in web/ directory (prevents ../ in paths)
        if (strncmp($webRoot, $toCheck, strlen($webRoot)) !== 0)
        {
            return false;
        }

        return true;
    }

    protected function checkWebAdress($path)
    {
        $headers = get_headers($path);

        return $headers[0] === "HTTP/1.1 200 OK";
    }

    public function getName()
    {
        return 'asset_exists';
    }
}