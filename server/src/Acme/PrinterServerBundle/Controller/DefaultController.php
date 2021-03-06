<?php

namespace Acme\PrinterServerBundle\Controller;

use Acme\PrinterServerBundle\Entity\PrinterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('AcmePrinterServerBundle::index.html.twig');
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
        $data = $form->getData();
        $this->callPrinter($printRequest->getText());

        return $this->redirect($this->generateUrl('printer_request_success'));
      }
    } else {
      return $this->render('AcmePrinterServerBundle::new.html.twig', array(
        'form' => $form->createView(),
      ));
    }
  }

  public function callPrinter($text) {
    setlocale(LC_ALL, 'de_CH');
    $text = iconv("UTF-8", "ASCII//TRANSLIT", $text);
    $rows=explode("\n",$text);

    foreach ($rows as $row) {
      exec('echo  "' . $row . '" | TPrinter');
      exec('echo "' . $row . '" >> /tmp/printer_log');
    }
    exec('echo "\n" | TPrinter');
    exec('echo "\n" | TPrinter');
    exec('echo "\n" | TPrinter');
  }

  public function failAction() {
    return $this->render('AcmePrinterServerBundle::fail.html.twig');
  }
  public function successAction() {
    return $this->render('AcmePrinterServerBundle::success.html.twig');
  }
}
