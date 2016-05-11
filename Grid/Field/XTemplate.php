<?php

namespace Intbizth\Bundle\AdminBundle\Grid\Field;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;

class XTemplate implements FieldTypeInterface
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
        if ($field->getPath() !== '.') {
            $data = $this->dataExtractor->get($field, $data);
        }

        if(!$tpl = $this->getFieldOption($field, 'tpl')) {
            throw new \InvalidArgumentException('Not fount options.tpl for compiler.');
        }

        $twig = new \Twig_Environment(new \Twig_Loader_Array([]));

        return $twig->createTemplate($tpl)->render(['data' => $data]);
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
        return 'xtemplate';
    }
}
