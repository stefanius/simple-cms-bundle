<?php

namespace Stef\SimpleCmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stef_simplecms_dictionary")
 */
class Dictionary extends AbstractCmsContent
{
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $firstLetter;

    /**
     * @return mixed
     */
    public function getFirstLetter()
    {
        return $this->firstLetter;
    }

    /**
     * @param mixed $firstLetter
     */
    public function setFirstLetter($firstLetter)
    {
        $this->firstLetter = $firstLetter;
    }
}
