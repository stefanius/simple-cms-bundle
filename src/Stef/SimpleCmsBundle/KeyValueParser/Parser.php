<?php

namespace Stef\SimpleCmsBundle\KeyValueParser;

use Stef\Manipulation\Manipulators\AbstractStringManipulator;
use Symfony\Component\HttpFoundation\ParameterBag;

class Parser {

    /**
     * @var AbstractStringManipulator
     */
    protected $toArrayManipulator;

    /**
     * @var AbstractStringManipulator
     */
    protected $toJsonManipulator;

    /**
     * @var AbstractStringManipulator
     */
    protected $toParameterBagManipulator;

    function __construct(AbstractStringManipulator $toArrayManipulator,
                         AbstractStringManipulator $toJsonManipulator,
                         AbstractStringManipulator $toParameterBagManipulator)
    {
        $this->toArrayManipulator = $toArrayManipulator;
        $this->toJsonManipulator = $toJsonManipulator;
        $this->toParameterBagManipulator = $toParameterBagManipulator;
    }

    /**
     * @param $input
     * @return array
     */
    public function parseKeyValuesToArray($input)
    {
        return $this->toArrayManipulator->manipulate($input);
    }

    /**
     * @param $input
     * @return string
     */
    public function parseKeyValuesToJson($input)
    {
        return $this->toJsonManipulator->manipulate($input);
    }

    /**
     * @param $input
     * @return ParameterBag
     */
    public function parseKeyValuesToParameterBag($input)
    {
        return $this->toParameterBagManipulator->manipulate($input);
    }
}