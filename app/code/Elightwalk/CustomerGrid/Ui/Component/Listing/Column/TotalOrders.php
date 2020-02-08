<?php
namespace Elightwalk\CustomerGrid\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class TotalOrders extends Column
{
    protected $orderCollectionFactory;
    /**
     * 
     * @param ContextInterface   $context           
     * @param UiComponentFactory $uiComponentFactory   
     * @param array              $components        
     * @param array              $data              
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory  $orderCollectionFactory
    ) {

        $this->orderCollectionFactory = $orderCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $customerOrder = $this->orderCollectionFactory->create()->addFieldToFilter('customer_id', $item['entity_id']);
                $item[$this->getData('name')] = count($customerOrder);//Value which you want to display
            }
        }
        return $dataSource;
    }
}