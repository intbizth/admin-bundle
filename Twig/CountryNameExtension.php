<?php

namespace Intbizth\Bundle\AdminBundle\Twig;

use Symfony\Component\Intl\Intl;

class CountryNameExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('twig_country_name', [$this, 'translateCountryIsoCode']),
        ];
    }

    /**
     * @param mixed  $country
     * @param string $locale
     *
     * @return string
     */
    public function translateCountryIsoCode($country, $locale = null)
    {
        return Intl::getRegionBundle()->getCountryName($country, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'twig_country_name';
    }
}
