<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PaymentBundle\Entity\Bill;

class BillController extends Controller
{

    /**
     * @Route("/admin/bill/{id}/is_returned", name="admin_bill_returned")
     * @Security("has_role('ROLE_ADMIN')")
     * @ParamConverter("bill", class="PaymentBundle:Bill")
     */
    public function adminIsReturnedBillAction(Bill $bill)
    {
        $em = $this->getDoctrine()->getManager();

        $current_date = new \DateTime(date('d M Y H:i'));

    	if ($bill->getIsReturned() == 0) {
    		$bill->setIsReturned(true);
            $bill->setDateReturn($current_date);
    		$em->flush();
    		$this->addFlash('info', 'Vehicule rendu');
    	} else {
    		$bill->setIsReturned(false);
            $bill->setDateReturn(null);
    		$em->flush();
    		$this->addFlash('info', 'Vehicule pas encore rendu');
    	}
        return $this->redirectToRoute('admin_view_offers');
    }
}