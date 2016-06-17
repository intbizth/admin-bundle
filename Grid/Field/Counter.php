<?php

namespace Intbizth\Bundle\AdminBundle\Grid\Field;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Counter implements FieldTypeInterface
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
    public function render(Field $field, $data, array $options)
    {
        if ('.' !== $field->getPath()) {
            $data = $this->dataExtractor->get($field, $data);
        }

        if (is_array($data) || $data instanceof \Countable) {
            $number = count($data);
        } else {
            $number = strlen($data);
        }

        if (!$template = $this->getFieldOption($field, 'template')) {
            return $number;
        }

        return $this->twig->render($template, ['number' => $data]);
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
    public function configureOptions(OptionsResolver $resolver) {

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'counter';
    }
}
