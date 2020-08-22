<?php

class VS7_PromoMassactions_Adminhtml_Vs7_PromomassactionsController extends Mage_Adminhtml_Controller_Action
{
    public function massDeleteAction()
    {
        $ruleIds = $this->getRequest()->getParam('rule_ids');
        if (!is_array($ruleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            $i = 0;
            try {
                $rules = Mage::getModel('salesrule/rule')
                    ->getResourceCollection()
                    ->addFieldToFilter('rule_id', array('in' => $ruleIds));
                foreach ($rules as $rule) {
                    $rule->delete();
                    $i++;
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            if ($i > 0) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vs7_promomassactions')->__(
                        'Total of %d item(s) were successfully deleted', $i
                    )
                );
            }
        }

        $this->_redirect('*/promo_quote/index');
    }

    public function massEnableAction()
    {
        $ruleIds = $this->getRequest()->getParam('rule_ids');
        if (!is_array($ruleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            $i = 0;
            try {
                $rules = Mage::getModel('salesrule/rule')
                    ->getResourceCollection()
                    ->addFieldToFilter('rule_id', array('in' => $ruleIds));
                foreach ($rules as $rule) {
                    $rule->setIsActive(true)->save();
                    $i++;
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            if ($i > 0) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vs7_promomassactions')->__(
                        'Total of %d item(s) were successfully enabled', $i
                    )
                );
            }
        }

        $this->_redirect('*/promo_quote/index');
    }

    public function massDisableAction()
    {
        $ruleIds = $this->getRequest()->getParam('rule_ids');
        if (!is_array($ruleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            $i = 0;
            try {
                $rules = Mage::getModel('salesrule/rule')
                    ->getResourceCollection()
                    ->addFieldToFilter('rule_id', array('in' => $ruleIds));
                foreach ($rules as $rule) {
                    $rule->setIsActive(false)->save();
                    $i++;
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            if ($i > 0) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vs7_promomassactions')->__(
                        'Total of %d item(s) were successfully disabled', $i
                    )
                );
            }
        }

        $this->_redirect('*/promo_quote/index');
    }
}