<?php

/**
 * Used in creating options for Yes|No config value selection
 *
 */
namespace Vrize\Vendor\Model\Config\Source;

class SystemYesNoOptions implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Yes')], ['value' => 0, 'label' => __('No')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('No'), 1 => __('Yes')];
    }
}
