<?php

class VS7_PromoMassactions_Model_Adminhtml_Observer
{
    public function addMassactions($observer)
    {
        $block = $observer->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Promo_Quote_Grid) {
            $block->setMassactionIdField('rule_id');
            $block->getMassactionBlock()->setFormFieldName('rule_ids');
            $block->getMassactionBlock()->setUseSelectAll(false);

            $block->getMassactionBlock()->addItem('delete', array(
                'label' => Mage::helper('vs7_promomassactions')->__('Delete'),
                'url' => $block->getUrl('*/vs7_promomassactions/massDelete'),
                'confirm' => Mage::helper('vs7_promomassactions')->__('Are you sure?')
            ));
            $block->getMassactionBlock()->addItem('enable', array(
                'label' => Mage::helper('vs7_promomassactions')->__('Enable'),
                'url' => $block->getUrl('*/vs7_promomassactions/massEnable'),
                'confirm' => Mage::helper('vs7_promomassactions')->__('Are you sure?')
            ));
            $block->getMassactionBlock()->addItem('disable', array(
                'label' => Mage::helper('vs7_promomassactions')->__('Disable'),
                'url' => $block->getUrl('*/vs7_promomassactions/massDisable'),
                'confirm' => Mage::helper('vs7_promomassactions')->__('Are you sure?')
            ));

            $columnId = 'massaction';

            $massactionColumn = array(
                'index' => $block->getMassactionIdField(),
                'filter_index' => $block->getMassactionIdFilter(),
                'type' => 'massaction',
                'name' => $block->getMassactionBlock()->getFormFieldName(),
                'align' => 'center',
                'is_system' => true
            );

            if ($block->getNoFilterMassactionColumn()) {
                $massactionColumn->setData('filter', false);
            }

            $oldColumns = $block->getColumns();
            foreach ($oldColumns as $column) {
                $block->removeColumn($column->getId());
            }

            $block->addColumn($columnId, $massactionColumn);

            foreach ($oldColumns as $column) {
                $block->addColumn($column->getId(), $column->getData());
            }

            return $this;
        }
    }
}