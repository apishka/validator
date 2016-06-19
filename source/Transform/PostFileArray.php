<?php namespace Apishka\Validator\Transform;

use Apishka\Validator\TransformAbstract;

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
        return array(
            'Transform/PostFileArray',
        );
    }

    /**
     * Process
     *
     * @param mixed $value
     * @param array $options
     *
     * @return string|null
     */

    public function process($value, array $options = array())
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
        return array(
            'error' => array(
                'message'   => 'wrong input format',
            ),
            'upload' => array(
                'message'   => 'upload error',
            ),
        );
    }
}