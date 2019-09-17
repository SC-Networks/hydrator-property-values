<?php

namespace Scn\HydratorProperties\Config;

use Scn\Hydrator\Configuration;

interface HydratorConfigInterface extends Configuration\ExtractorConfigInterface, Configuration\HydratorConfigInterface
{
    public function getObject(): object;

    public function getHydratorProperties(): array;

    public function getExtractorProperties(): array;
}
