<?php

namespace OC\BrokersBundle\Controller;

use OC\BrokersBundle\Entity\Broker;
use OC\BrokersBundle\Entity\BrokerCountryCoin;
use OC\BrokersBundle\Entity\BrokerPays;
use OC\BrokersBundle\Entity\BrokersArray;
use OC\BrokersBundle\Entity\BrokersOrderArray;
use OC\BrokersBundle\Entity\GlobalParent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
     * @Route("/added", name="added")

     *
     * @return JsonResponse
     */
    public function addedAction(Request $request)
    {
       // $routeParams = $request->attributes->get('_route_params');
      //  $id = $routeParams['id'];
       // .
        $query_parameters = $request->query->get('id');
        dump($query_parameters);
        return $this->render('BrokersBundle:Default:default.html.twig');
    }

        /**
     * @Route("/newBroker", name="newBroker", schemes={"https"})


     */
    public function newBrokerAction(Request $request) {



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
     * @Route("/BrokerPage",name="BrokerPage")

     */
    public function BrokerPageAction(Request $request)
    {

        $global_broker = new GlobalParent();
$parent_broker = new BrokerPays();
        // On crée le FormBuilder grâce au service form factory

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder

            ->add('name',      TextType::class)
            ->add('logo',     TextType::class)
            ->add('review',   TextType::class)
            ->add('link',    TextType::class)
            ->add('score', IntegerType::class)
            ->add('crypto',      TextType::class)
            ->add('displayName',      TextType::class)
->add('save',SubmitType::class)
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

//pays form


        $formBuilder2 = $this->get('form.factory')->createBuilder(FormType::class, $parent_broker);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder2

            ->add('review',   TextType::class)
           
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form2 = $formBuilder2->getForm();



        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            $form2->handleRequest($request);
$temp = 0;
            $em = $this->getDoctrine()->getManager();
            if ($form->isSubmitted()) {
                $temp += 1;
                if ($form->isValid()) {


                    // On enregistre notre objet $advert dans la base de données, par exemple

                    $em->persist($global_broker);
                    $em->flush();



                }
            }
            if ($form2->isSubmitted()) {
                $temp += 2;
                if ($form2->isValid()) {


                    $em->persist($parent_broker);
                    $em->flush();


                }
            }


                return $this->redirectToRoute('added', array('id' =>$temp));

        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
//        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
//            'form' => $form->createView(),
//        ));






        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('BrokersBundle:Default:broker.html.twig', array(
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ));


    }











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
            ->subquerybuilder();
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
            ->test();
        dump($products);
        return $this->render('BrokersBundle:Default:index.html.twig',[
            'brokers' => $products
        ]);


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
     * @Route("/brokerArray2", name="brokerArray2")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function brokerArray2Action(Request $request) {


        $brokers_array = new BrokersOrderArray();
        $temp = $_POST['array'];
        //   $id = $_POST['id'];
//
//        $brokers_array->setArray($temp);
//        $brokers_array->setArray2($temp);
//        $brokers_array->setArray3($temp);



        $em = $this->getDoctrine()->getManager();
        //  $product = $em->getRepository(BrokersArray::class)->find($id);
        $product = $em->getRepository(BrokersOrderArray::class)->findAll();
        if(!$product)
        {
            $last = new BrokersOrderArray();
        }
        else
        {
            $last = $product[count($product)-1];
        }


//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }

        $last->setArray($temp);

        $em->persist($last);
        $em->flush();



//        $em = $this->getDoctrine()->getManager();
//
//        // tells Doctrine you want to (eventually) save the Product (no queries yet)
//        $em->persist($brokers_array);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $em->flush();
        $pieces = explode(" ", $temp);
        return new JsonResponse($pieces);


    }













    /**
     * @Route("/createBroker", name="createBroker")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createBrokerAction(Request $request) {



        $broker = new BrokerCountryCoin();



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
       // $product = $em->getRepository(BrokersArray::class)->findAll();
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }
      //  $last = $product[count($product)-1];
        //$product->setArray($temp);
     //  $array =  $last->getArray2();
       /// $product->setArray3($temp);
      //  array_push($array,$broker->getName());
      //  $last->setArray2($array);
      //  $em->flush();





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
        $broker= $em->getRepository(BrokerCountryCoin::class)->find($id);



        foreach( $_POST['user'] as $stuff => $val  ) {
            if( property_exists($broker, $stuff)) {
                if($val == 'null')
                {
                    $val = NULL;
                }
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
     * @Route("/what", name="what")

     */
    public function isDefault()
    {

        $serializer = $this->get('serializer');
        $products = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokerCountryCoin')
            ->isDefault();
//['brokers'=>$products]
        //dump($products);



        return new JsonResponse($products);
//        // ... do something, like pass the $product object into a template
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
       // $brokersObjects = $this->getDoctrine()
           // ->getRepository('BrokersBundle:BrokerCountryCoin')
          //  ->test();
//['brokers'=>$products]

        $isDefault= $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokerCountryCoin')
            ->findAll();



        $all_with_default = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokerCountryCoin')
            ->isDefault();
        $brokersOrder = $this->getDoctrine()
            ->getRepository('BrokersBundle:BrokersOrderArray')
             ->findAll();
//
//
       $orderString = $brokersOrder[count($brokersOrder)-1]->getArray();
        $orderArray = explode(",", $orderString);
//
//
        $array =  array();
       // dump($order);
      //  $neededObject = array();
        foreach ($orderArray as $id){

            $neededObject = array_filter(
                $all_with_default,
                function ($broker) use ($id){
                    //dump($broker);
                    return $broker["id"] == $id;
                }
            );
         //   dump(array_values($neededObject)[0]);
            $boker_obj = array_values($neededObject);
           // $key = array_filter($brokersObjects, "odd");
            array_push($array, $boker_obj[0]);
        }
        dump($all_with_default);
//        dump($array);
//        dump($all_with_default);
        //dump($brokersObjects);
       // $jsonBrokers = $serializer->serialize($brokersObjects, 'json');



$jsonDefault = $serializer->serialize($isDefault, 'json');
$jsonAll = $serializer->serialize($all_with_default, 'json');
$jsonAll2 = $serializer->serialize($array, 'json');
//$test = isDefault();
//dump($pieces);



        return $this->render('BrokersBundle:drag_n_drop:table_template.html.twig',array('brokersSerialized' => $jsonDefault,'brokers' => $jsonDefault,'defaultSerialized' => $jsonDefault , 'all_with_default' => $jsonAll2));
    }



















}




