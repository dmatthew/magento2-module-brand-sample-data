<?php

namespace Dmatthew\BrandSampleData\Model;

use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

/**
 * Class Brand
 */
class Brand
{
    /**
     * @var \Magento\Framework\Setup\SampleData\FixtureManager
     */
    protected $fixtureManager;

    /**
     * @var \Dmatthew\Brand\Model\BrandFactory
     */
    protected $brandFactory;

    /**
     * @param SampleDataContext $sampleDataContext
     * @param \Dmatthew\Brand\Model\BrandFactory $brandFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        \Dmatthew\Brand\Model\BrandFactory $brandFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->brandFactory = $brandFactory;
    }

    /**
     * @param array $fixtures
     * @throws \Exception
     */
    public function install(array $fixtures)
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                continue;
            }
            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $data = [];
                foreach ($row as $key => $value) {
                    $data[$header[$key]] = $value;
                }
                $this->createBrand($data);
            }
        }
    }

    /**
     * @param array $data
     * @return void
     */
    protected function createBrand($data)
    {
        $brand = $this->brandFactory->create();
        $brand->setData($data)
            ->setStoreId(\Magento\Store\Model\Store::DEFAULT_STORE_ID);
        $brand->save();
    }
}
