<?php

namespace Stef\SimpleCmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stef_simplecms_news")
 */
class News extends AbstractCmsContent
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $picture;

    /**
     * Set picture
     *
     * @param string $picture
     * @return News
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
