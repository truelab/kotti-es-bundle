<?php

namespace Truelab\KottiEsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TruelabKottiEsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

//        $container->addCompilerPass(new NavigationRootChooserCompilerPass());

    }
}
