<?php

namespace Intbizth\Bundle\AdminBundle\Grid\Field;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;

class Text implements FieldTypeInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $dataExtractor;

    /**
     * @param DataExtractorInterface $dataExtractor
     */
    public function __construct(DataExtractorInterface $dataExtractor)
    {
        $this->dataExtractor = $dataExtractor;
    }

    /**
     * @param Field $field
     * @param $data
     *
     * @return string
     */
    public function render(Field $field, $data)
    {
        $data = $this->dataExtractor->get($field, $data);

        if($filter = $this->getFieldOption($field, 'filter')) {
            $arguments = (array) $this->getFieldOption($field, 'arguments', $this->getFieldOption($field, 'args'));
            // TODO: $filter == humanize
            $data = call_user_func_array($filter, array_merge([$data], $arguments));
        }

        return $data;
    }

    /**
     * @param Field $field
     * @param string $option
     * @param mixed $default
     *
     * @return null|mixed
     */
    private function getFieldOption(Field $field, $option, $default = null)
    {
        $options = $field->getOptions();

        if (array_key_exists($option, $options)) {
            return $options[$option];
        } else {
            return $default;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'text';
    }
}
