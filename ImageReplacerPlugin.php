<?php
namespace Craft;

class ImageReplacerPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Image Replacer (WebP)');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'nevoxo.com';
    }

    function getDeveloperUrl()
    {
        return 'https://www.nevoxo.com';
    }
}