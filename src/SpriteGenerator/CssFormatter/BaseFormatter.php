<?php

namespace SpriteGenerator\CssFormatter;

use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use Twig\Environment;

abstract class BaseFormatter
{
    /**
     * @param array $sourceImages
     * @param string $spriteClass
     * @param string $spriteImageName
     * @return string
     */
    public function format(array $sourceImages, $spriteClass, $spriteImageName)
    {
        return $this->formatTemplate($sourceImages, $spriteClass, $spriteImageName);
    }

    /**
     * @param array $sourceImages
     * @param string $spriteClass
     * @param string $spriteImageName
     * @return string
     */
    public function formatTemplate(array $sourceImages, $spriteClass, $spriteImageName)
    {
        $loader = new FilesystemLoader(dirname(__FILE__).'/../Resources/views');
        $twig = new Environment($loader, array(
            'cache' => false,
            'debug' => true,
        ));
        $twig->addExtension(new DebugExtension());

        $css = $twig->render($this->template,
            array(
                'spriteClass' => $spriteClass,
                'spriteImageName' => $spriteImageName,
                'images' => $sourceImages,
            )
        );

        return $css;
    }
}
