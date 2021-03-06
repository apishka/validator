<?php

namespace Apishka\Transformer\Transform;

use Apishka\Transformer\TransformAbstract;

/**
 * Post file array
 */
class PostFileArray extends TransformAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */
    public function getSupportedNames()
    {
        return [
            'Transform/PostFileArray',
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

        if (!is_array($value))
            $this->throwException($options, 'error');

        if (!isset($value['error']) || $value['error'] != UPLOAD_ERR_OK)
            $this->throwException($options, 'upload');

        return $value;
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
            'upload' => [
                'message'   => 'upload error',
            ],
        ];
    }
}
