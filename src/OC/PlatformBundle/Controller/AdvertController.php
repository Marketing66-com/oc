<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/3/2018
 * Time: 8:58 AM
 */

namespace OC\PlatformBundle\Controller;


use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\BrokerImage;
use OC\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdvertController extends Controller
{
    /**
     * @Route("/{page}",defaults={"page"=1},requirements={"page" = "\d*"},name="oc_platform_home")
     *  @Security("has_role('ROLE_AUTEUR')")
     */
    public function indexAction($page)
    {

        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }


        return $this->render('OCPlatformBundle:Advert:index.html.twig');
    }

    /**
     * @Route("/advert/{id}",requirements={"id" = "\d+"},name="oc_platform_view")
     */
    public function viewAction($id,Request $request)
    {



        $tag = $request->query->get('tag');

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'id'  => $id,
            'tag' => $tag,
        ));
    }

    /**
     * @Route("/add",name="oc_platform_add")
     *
     */
    public function addAction(Request $request)
    {
        //@Security("has_role('ROLE_AUTEUR')")
// if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
//            // Sinon on déclenche une exception « Accès interdit »
//            throw new AccessDeniedException('Accès limité aux auteurs.');
//        }
        $advert = new Advert();
        $advert->setTitle('nouvelle annonce ');
        $advert->setAuthor('symfony');
        $advert->setContent("test de la nouvelle annonce");

        // Création de l'entité Image
        $image = new Image();
        $image->setUrl('http://www.gifsanimes.com/data/media/968/winnie-l-ourson-bebe-image-animee-0002.jpg');
        $image->setAlt('Job de rêve');

        // On lie l'image à l'annonce
        $advert->setImage($image);
dump($advert);
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);
        $em->flush();


//        // Reste de la méthode qu'on avait déjà écrit
//        if ($request->isMethod('POST')) {
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//            // Puis on redirige vers la page de visualisation de cettte annonce
//            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
//        }



        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('OCPlatformBundle:Advert:view.html.twig', array('advert' => $advert));


    }


    /**
     * @Route("/edit/{id}",requirements={"id" = "\d+"},name="oc_platform_edit")
     */
    public function editAction($id,Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        return $this->render('OCPlatformBundle:Advert:edit.html.twig');
    }


    /**
     * @Route("/delete/{id}",requirements={"id" = "\d+"},name="oc_platform_delete")
     */
    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }


    /**
     * @Route("/ws",name="oc_platform_ws")
     */
    public function wsAction()
    {
//        return $this->render('OCPlatformBundle:Advert:ws.html.twig',array('arr' => array("LTCEUR")));


return $this->render('OCPlatformBundle:Advert:ws.html.twig',array('arr' => array("LTCEUR","XRPUSD","BTCUSD","BTCUSDT","BTCSTORJ","ETHETC")));
    }























    /**
     * @Route("/saveImage",name="save_image")
     * @Method("POST")
     *
     */
    public function saveImageAction(Request $request)
    {
        // $tag = $request->query->get('------WebKitFormBoundarypB9gZ8LUOMI4OnAQ Content-Disposition:_form-data;_name');
       // $params = $request->files();

        $brokerImage = new BrokerImage();
//        $file = $request->request->get('data');
      //  echo "hello";
//        foreach($_POST as $key=>$value)
//        {
//            urldecode($value);
//            echo $value;
//        }

       // $file = $request->files->get('upload');
      //  $brokerImage.setImage();



//        $em = $this->getDoctrine()->getManager();
//
//        // Étape 1 : On « persiste » l'entité
//        $em->persist($brokerImage);
//        $em->flush();



        $myresponse = array(
            'response' => "Image inserted",
            'test' => $brokerImage,
//            'file' => $echo
        );
        // Si on n'est pas en POST, alors on affiche le formulaire

        return new JsonResponse($myresponse);
    }

}