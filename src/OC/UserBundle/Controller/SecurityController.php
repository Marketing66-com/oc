<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/16/2018
 * Time: 12:04 PM
 */

namespace OC\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class SecurityController extends Controller
{
//    /**
//     * @Route("/login",name="login")
//     * @param Request $request
//     * @return mixed
//     */
//    public function loginAction(Request $request)
//    {
//
//        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
//        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//            return $this->redirectToRoute('oc_platform_accueil');
//        }
//
//        // Le service authentication_utils permet de récupérer le nom d'utilisateur
//        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
//        // (mauvais mot de passe par exemple)
//        $authenticationUtils = $this->get('security.authentication_utils');
//
//        return $this->render('UserBundle:Security:from.html.twig', array(
//            'last_username' => $authenticationUtils->getLastUsername(),
//            'error'         => $authenticationUtils->getLastAuthenticationError(),
//        ));
//    }


//    /**
//     * @Route("/",name="oc_platform_accueil")
//     */
//    public function indexAction()
//    {
//        $user = $this->getUser();
//
//        if (null === $user) {
//            dump("user is null");
//            // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
//        } else {
//            // Ici, $user est une instance de notre classe User
//            dump($user);
//        }
//        return $this->render('UserBundle:Security:good.html.twig');
//    }

    /**
     * @Route("/",name="oc_platform_accueil")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        if (null === $user) {
            dump("user is null");
            // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
        } else {
            // Ici, $user est une instance de notre classe User
            dump($user);
        }
        return $this->render('UserBundle:Security:layout.html.twig');
    }



//    /**
//     * @Route("/Brokers/ETH",name="eth_brokers")
//     */
//    public function ethBrokersAction()
//    {
//        $user = $this->getUser();
//
//        if (null === $user) {
//            dump("user is null");
//            // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
//        } else {
//            // Ici, $user est une instance de notre classe User
//            dump($user);
//        }
//        return $this->render('UserBundle:Security:eth_brokers.html.twig');
//    }


    /**
     * @Route("/Template",name="template")
     */
    public function templateAction()
    {
        $user = $this->getUser();

        if (null === $user) {
            dump("user is null");
            // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
        } else {
            // Ici, $user est une instance de notre classe User
            dump($user);
        }
        return $this->render('UserBundle:Security:drag_and_drop_table.html.twig');
    }



    /**
     * @Route("/image")
     */
    public function imageAction()
    {

        return $this->render('UserBundle:Security:index.html.twig');
    }


    /**
     * @Route("/upload_file2")
     * @Method("POST")
     */
    public function uploadAction2(Request $request)
    {
        $uploadedFiles = array();

        foreach ($request->files as $file) {
            $uploadedFiles[] = array(
                'name' => $file->getClientOriginalName(),
                'size' => $file->getClientSize(),
                // 'content' => file_get_contents($file->getPathname()),
                'mime' => $file->getClientMimeType()
            );
        }

        // return new JsonResponse("hello");
        return new JsonResponse($uploadedFiles);


    //    return $this->redirectToRoute('eth_brokers');

    }

//
//    /**
//     * @Route("/upload_file")
//     * @Method("POST")
//     */
//    public function uploadAction(Request $request)
//    {
//
//
//
//        $fs = new Filesystem();
//
////        try {
////            $fs->mkdir('../web/uploads');
////            echo "All OK";
////        } catch (IOExceptionInterface $e) {
////            echo "An error occurred while creating your directory at ".$e->getPath();
////        }
//
//
//        if ($_FILES["file"]["error"] > 0) {
//            echo "Error: " . $_FILES["file"]["error"] . "<br>";
//        } else {
//
//            // retrieve uploaded files
//            $files = $request->files;
//            $uploadedFile = $files->get('file');
//// and store the file
//            echo "file bag" . $uploadedFile. "<br>";
//
//            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//            echo "Type: " . $_FILES["file"]["type"] . "<br>";
//            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//           // $uploadedFile = $_FILES["file"]["name"];
//            $directory =  $this->getParameter('brokers_directory');
//            $name = $_FILES["file"]["name"];
//            //$bool = move_uploaded_file ($uploadedFile,$directory );
//
//            $file = $uploadedFile->move($directory, $name);
//
//            echo "Stored in: " . $directory. "<br>";
//            echo "return form move " . $file. "<br>";
//
//
//
//
//        }
//       // return $this->redirectToRoute('eth_brokers');
//        return new JsonResponse("done");
//    }



    /**
     *  @Route("/uploadFile")
     */
    public function uploadfile(Request $request)
    {


        return $this->render('UserBundle:Security:test.html.twig');
    }














}