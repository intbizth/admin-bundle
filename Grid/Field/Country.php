<?php

namespace Intbizth\Bundle\AdminBundle\Grid\Field;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;

class Country implements FieldTypeInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $dataExtractor;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(DataExtractorInterface $dataExtractor, \Twig_Environment $twig)
    {
        $this->dataExtractor = $dataExtractor;
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function render(Field $field, $data)
    {
        if ('.' !== $field->getPath()) {
            $data = $this->dataExtractor->get($field, $data);
        }

        $template = $this->getFieldOption($field, 'template', 'IntbizthAdminBundle:Grid/Field:country.html.twig');

        return $this->twig->render($template, [
            'data' => $data,
        ]);
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
        return 'country';
    }
}
