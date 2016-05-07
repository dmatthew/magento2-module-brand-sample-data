<?php

namespace Dmatthew\BrandSampleData\Setup;

use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * Setup class for category
     *
     * @var \Dmatthew\BrandSampleData\Model\Brand
     */
    protected $brandSetup;

    /**
     * @param \Dmatthew\BrandSampleData\Model\Brand $brandSetup
     */
    public function __construct(
        \Dmatthew\BrandSampleData\Model\Brand $brandSetup
    ) {
        $this->brandSetup = $brandSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function install()
    {
        $this->brandSetup->install(['Dmatthew_BrandSampleData::fixtures/brands.csv']);
    }
}