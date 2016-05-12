<?php

namespace Intbizth\Bundle\AdminBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\ResourceChoiceType as BaseResourceChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author liverbool <phaiboon@intbizth.com>
 *
 * @deprecated when https://github.com/Sylius/Sylius/pull/5010 merged
 */
class TreeResourceChoiceType extends BaseResourceChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'query_builder' => function($er) {
                    return $er->createQueryBuilder('o')
                        ->addOrderBy('o.left', 'ASC')
                        ;
                },
            ])
        ;
    }
}
