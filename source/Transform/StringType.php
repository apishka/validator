<?php

namespace Apishka\Transformer\Transform;

use Apishka\Transformer\TransformAbstract;

/**
 * String type
 */
class StringType extends TransformAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */
    public function getSupportedNames()
    {
        return [
            'Transform/String',
        ];
    }

    /**
     * Process
     *
     * @param mixed $value
     * @param array $options
     *
     * @return string|null
     */
    public function process($value, array $options = [])
    {
        if ($value === null)
            return;

        if (is_object($value) || is_resource($value) || is_array($value))
            $this->throwException($options, 'error');

        return (string) $value;
    }

    /**
     * Get default errors
     *
     * @return array
     */
    protected function getDefaultErrors()
    {
        return [
            'error' => [
                'message'   => 'wrong input format',
            ],
        ];
    }
}
