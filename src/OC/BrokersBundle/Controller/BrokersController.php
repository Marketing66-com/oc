<?php

namespace OC\BrokersBundle\Controller;

use OC\BrokersBundle\Entity\Broker;
use OC\BrokersBundle\Entity\BrokersArray;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class BrokersController extends Controller
{
        /**
     * @Route("/upload_file")
     * @Method("POST")
     */
    public function uploadAction2(Request $request)
    {



        $fs = new Filesystem();

//        try {
//            $fs->mkdir('../web/uploads');
//            echo "All OK";
//        } catch (IOExceptionInterface $e) {
//            echo "An error occurred while creating your directory at ".$e->getPath();
//        }


        if ($_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {

            // retrieve uploaded files
            $files = $request->files;
            $uploadedFile = $files->get('file');
// and store the file
            echo "file bag" . $uploadedFile. "<br>";

            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
           // $uploadedFile = $_FILES["file"]["name"];
            $directory =  $this->getParameter('brokers_directory');
            $name = $_FILES["file"]["name"];
            //$bool = move_uploaded_file ($uploadedFile,$directory );

            $file = $uploadedFile->move($directory, $name);

            echo "Stored in: " . $directory. "<br>";
            echo "return form move " . $file. "<br>";




        }
       // return $this->redirectToRoute('eth_brokers');
        return new JsonResponse("done");
    }




        /**
     * @Route("/Brokers/ETH",name="eth_brokers")
     */
    public function ethBrokersAction()
    {
        $user = $this->getUser();

        if (null === $user) {
            dump("user is null");
            // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
        } else {
            // Ici, $user est une instance de notre classe User
            dump($user);
        }
        return $this->render('UserBundle:Security:eth_brokers.html.twig');
    }
    /**
     * @Route("/addBroker",name="addBroker")
     */
    public function createAction()
    {
        $broker = new Broker();
        $broker->setSiteLink("https://marketing66.go2cloud.org/aff_c?offer_id=4&aff_id=1064&url_id=466");
        $broker->setCryptoImage("https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png");
        $broker->setLogo("images/uploads/brokers/Capture4.PNG");
        $broker->setMinDepot(100);
        $broker->setName("Etoro");
        $broker->setRegulationImg("https://www.interactivecrypto.com/wp-content/uploads/2017/11/FlagEtoro.png");
        $broker->setUserScore(9.7);
        $broker->setReviewLink("https://www.interactivecrypto.com/etero-broker-review/");

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($broker);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$broker->getId());
    }

    /**
     * @Route("/showBrokers",name="showBrokers")
     */
    public function showAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:Broker')
            ->findAll();

        return $this->render('BrokersBundle:Default:index.html.twig',[
            'brokers' => $products
        ]);


        // ... do something, like pass the $product object into a template
    }
    /**
     * @Route("/showglobalBrokers",name="showglobalBrokers")
     */
    public function showglobalBrokersAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:GlobalParent')
            ->findAll();

        return $this->render('BrokersBundle:Default:index.html.twig',[
            'brokers' => $products
        ]);


        // ... do something, like pass the $product object into a template
    }

    /**
     * @Route("/showparentBrokers",name="showparentBrokers")
     */
    public function showparentBrokersAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokerPays')
            ->findAllInheritance();
        dump($products);
        return $this->render('BrokersBundle:Default:index.html.twig',[
            'brokers' => $products
        ]);


        // ... do something, like pass the $product object into a template
    }

    /**
     * @Route("/showcoinBrokers",name="showcoinBrokers")
     */
    public function showcoinBrokersAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokerCountryCoin')
            ->findAll();

        return $this->render('BrokersBundle:Default:index.html.twig',[
            'brokers' => $products
        ]);
        dump($products);

        // ... do something, like pass the $product object into a template
    }



    /**
     * @Route("/deleteBrokers/{id}",requirements={"id" = "\d+"},name="deleteBrokers")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $broker = $em->getRepository(Broker::class)->find($id);

        if (!$broker) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }



        $em->remove($broker);
        $em->flush();

        $product = $em->getRepository(BrokersArray::class)->findAll();
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }
        $last = $product[count($product)-1];
        //$product->setArray($temp);
        $array =  $last->getArray2();
        $result = array_values(array_diff($array, [$broker->getName()]));
        dump($result);
         //$product->setArray3($temp);
        //array_push($array,$broker->getName());
        $last->setArray2($result);
        $em->flush();




        return new JsonResponse($id);


        // ... do something, like pass the $product object into a template
    }
    /**
     * @Route("/allBrokers",name="allBrokers")
     */
    public function allBrokersAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:Broker')
            ->findAll();
//
//        return $this->render('BrokersBundle:Default:index.html.twig',[
//            'brokers' => $products
//        ]);

        return new JsonResponse($products);
        // ... do something, like pass the $product object into a template
    }


    /**
     * @Route("/allBrokerstest",name="allBrokerstest")
     */
    public function allBrokerstestAction()
    {

        $serializer = $this->get('serializer');
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:Broker')
            ->findAll();
//['brokers'=>$products]
        dump($products);

        $jsonCountries = $serializer->serialize($products, 'json');



        return $this->render('BrokersBundle:Default:index.html.twig',array('brokersSerialized' => $jsonCountries,'brokers' => $products));

//        return new JsonResponse($products);
//        // ... do something, like pass the $product object into a template
    }



    /**
     * @Route("/update/{productId}",requirements={"productId" = "\d+"},name="update")
     */
    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Broker::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('oc_platform_home');
    }


//    /**
//     * @Route("/deleteTable",,name="deleteTable")
//     */
//    public function deleteTableAction($productId)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $product = $em->getRepository(BrokersOrder::class);
//
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$productId
//            );
//        }
//
//        $product->setName('New product name!');
//        $em->flush();
//
//        return $this->redirectToRoute('oc_platform_home');
//    }



    /**
     * @Route("/fillArray",name="fillArray")
     */
    public function fillArrayAction()
    {
       $brokers_array = new BrokersArray();
      $temp= array("a"=>"b","c"=>"d");
//        $temp= array("a"=>"b","c"=>"d");
//        $temp= array("a"=>"b","c"=>"d");
        $brokers_array->setArray($temp);
        $brokers_array->setArray2($temp);
        $brokers_array->setArray3($temp);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($brokers_array);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new JsonResponse("OK");
    }


    /**
     * @Route("/brokerArray", name="brokerArray")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function brokerArrayAction(Request $request) {


        $brokers_array = new BrokersArray();
        $temp = $_POST['array'];
     //   $id = $_POST['id'];
//
//        $brokers_array->setArray($temp);
//        $brokers_array->setArray2($temp);
//        $brokers_array->setArray3($temp);



        $em = $this->getDoctrine()->getManager();
      //  $product = $em->getRepository(BrokersArray::class)->find($id);
        $product = $em->getRepository(BrokersArray::class)->findAll();
        $last = $product[count($product)-1];


//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }

        $last->setArray($temp);
        $last->setArray2($temp);
        $last->setArray3($temp);
        $em->persist($last);
        $em->flush();



//        $em = $this->getDoctrine()->getManager();
//
//        // tells Doctrine you want to (eventually) save the Product (no queries yet)
//        $em->persist($brokers_array);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $em->flush();

        return new JsonResponse("DONE");


    }

    /**
     * @Route("/createBroker", name="createBroker")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createBrokerAction(Request $request) {



        $broker = new Broker();



        foreach( $_POST['user'] as $stuff => $val  ) {

                $broker->setAny($stuff, $val);



        }

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($broker);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

       //$id = $_POST['id'];
       // $product = $em->getRepository(BrokersArray::class)->find($id);
        $product = $em->getRepository(BrokersArray::class)->findAll();
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }
        $last = $product[count($product)-1];
        //$product->setArray($temp);
       $array =  $last->getArray2();
       // $product->setArray3($temp);
        array_push($array,$broker->getName());
        $last->setArray2($array);
        $em->flush();





        return new JsonResponse($broker->getId());


    }




    /**
     * @Route("/test/updateOrCreate", name="test_update")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateBrokerAction(Request $request) {
//        $id = $_POST["id"];
//        $em = $this->getDoctrine()->getManager();
//        $product = $em->getRepository(Broker::class)->find($id);
//
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }
//$result = $product->setAny('name', "new name");
//     // $product->setName('HI!');
//        $em->flush();
        if(!isset($_POST['user']['id'])) {
            return $this->redirectToRoute('createBroker', [
                'request' => $request
            ], 307);
        }

        $id = $_POST['user']["id"];
        $em = $this->getDoctrine()->getManager();
        $broker= $em->getRepository(Broker::class)->find($id);



        foreach( $_POST['user'] as $stuff => $val  ) {
            if( property_exists($broker, $stuff)) {
                $broker->setAny($stuff, $val);

                }

        }



        if (!$broker) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
//        //$product->set('name', "new name");
//       $product -> setName("HELLO");
//      //  $em->merge();
        $em->flush();


        return new JsonResponse($broker);
    }






    /**
     * @Route("/test/upload", name="test_upload_file_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function testuploadAction() {
        return $this->render('UserBundle:Security:test_upload.html.twig');
    }

    /**
     * @Route("/test/uploadfile", name="test_upload_file_post")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadAction(Request $request) {
        $uploadedFiles = array();
$name="";
        foreach ($request->files as $file) {
            $uploadedFiles[] = array(
                'name' => $file->getClientOriginalName(),
                'size' => $file->getClientSize(),
                // 'content' => file_get_contents($file->getPathname()),
                'mime' => $file->getClientMimeType()
            );
            $directory =  $this->getParameter('brokers_directory');

            $name = $file->getClientOriginalName();
            $escaped = preg_replace('/[^A-Za-z0-9_.\-]/', '_', $name);
           $myfile = $file->move($directory, $escaped);

//            if ($myfile) {
//                return new JsonResponse($myfile);
//            } else {
//                return new JsonResponse("BAD");
//            }

            $path =  $name;
            return new JsonResponse($escaped);
        }



        // $path = $directory . "/" . $name;//

       // return new JsonResponse("hello");

    }


    /**
     * @Route("/drag_n_drop", name="drag_n_drop")
     *
     *
     *
     *
     */
    public function drag_n_dropAction() {

        $serializer = $this->get('serializer');
        $brokersObjects = $this->getDoctrine()
            ->getRepository('BrokersBundle:Broker')
            ->findAll();
//['brokers'=>$products]


        $brokersOrder = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokersArray')
             ->findAll();


         $order = $brokersOrder[count($brokersOrder)-1]->getArray2();


        $array =  array();
       // dump($order);
      //  $neededObject = array();
        foreach ($order as $name){

            $neededObject = array_filter(
                $brokersObjects,
                function ($broker) use ($name){
                    return $broker->getName() == $name;
                }
            );
         //   dump(array_values($neededObject)[0]);
            $boker_obj = array_values($neededObject);
           // $key = array_filter($brokersObjects, "odd");
            array_push($array, $boker_obj[0]);
        }
        dump($array);
        dump($brokersObjects);
        $jsonBrokers = $serializer->serialize($array, 'json');






        return $this->render('BrokersBundle:drag_n_drop:table_template.html.twig',array('brokersSerialized' => $jsonBrokers,'brokers' => $brokersObjects));
    }
}
