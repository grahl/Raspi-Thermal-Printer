<?php

namespace Acme\PrinterServerBundle\Controller;

use Acme\PrinterServerBundle\Entity\PrinterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('AcmePrinterServerBundle:Default:index.html.twig');
  }

  public function newAction(Request $request)
  {
    // create a task and give it some dummy data for this example
    $printRequest = new PrinterRequest();
    $printRequest->setText('');

    $form = $this->createFormBuilder($printRequest)
      ->add('text', 'textarea',array('label' => 'Your message'))
      ->getForm();

    if ($request->isMethod('POST')) {
      $form->bind($request);

      if ($form->isValid()) {
        // perform some action, such as saving the task to the database
       // exec('printer' . $form->text);
        return $this->redirect($this->generateUrl('printer_request_success'));
      }
    } else {
      return $this->render('AcmePrinterServerBundle:Default:new.html.twig', array(
        'form' => $form->createView(),
      ));
    }
  }

  public function failAction() {
    return $this->render('AcmePrinterServerBundle:Default:fail.html.twig');
  }
  public function successAction() {
    return $this->render('AcmePrinterServerBundle:Default:success.html.twig');
  }
}