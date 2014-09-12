<?php
/**
 * Billing.php
 *
 * @category  Aligent
 * @package   Aligent_Base
 * @author    Jonathan Day <jonathan@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */

/**
 * Aligent_Base_Block_Checkout_Onepage_Billing
 *
 * Rewrite of Mage_Checkout_Block_Onepage_Billing in order to resolve a bug where the customer's address is reset.
 *
 * The new functionality allows Guest/Register checkouts to return to cart or other pages and their previously entered
 * addresses will be restored
 *
 * @category  Aligent
 * @package   Aligent_Base
 * @author    Jonathan Day <jonathan@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */
class Aligent_Base_Block_Checkout_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{

    /**
     * Return Sales Quote Address model
     *
     * @return Mage_Sales_Model_Quote_Address
     */
    public function getAddress()
    {
        $oAddress = parent::getAddress();
        if ($oAddress->isObjectNew()) {
            // Core functionality has created a new address object because it's not a logged-in customer
            if ($this->getQuote()->getBillingAddress()) {
                // If the visitor has previously been through the billing step then use that data
                $this->_address = $this->getQuote()->getBillingAddress();
            }
        }

        return $this->_address;
    }
}
