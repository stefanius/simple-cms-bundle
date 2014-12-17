<?php

namespace Stef\SimpleCmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stef_simplecms_page")
 */
class Page extends AbstractCmsContent
{

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $kvSettings;

    /**
     * @ORM\Column(type="string")
     */
    protected $twig;


    /**
     * @param mixed $twig
     */
    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return mixed
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * Set kvSettings
     *
     * @param string $kvSettings
     * @return Page
     */
    public function setKvSettings($kvSettings)
    {
        $this->kvSettings = $kvSettings;

        return $this;
    }

    /**
     * Get kvSettings
     *
     * @return string 
     */
    public function getKvSettings()
    {
        return $this->kvSettings;
    }
}
