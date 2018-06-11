<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/11/2018
 * Time: 9:56 AM
 */

namespace OC\FeedsBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class FeedsController extends Controller
{

    /**
     * @Route("/Forex",name="Forex")
     */
    public function ForexAction()
    {
        $api =  $this->getParameter('forex_api');
        return $this->render('OCFeedsBundle:Default:index.html.twig',array("api"=>$api));
    }
}