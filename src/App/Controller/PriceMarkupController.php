<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\Metadata\Registry;
use Sylius\Component\Resource\ResourceActions;
use App\Entity\PriceMarkup;
use App\Form\Type\PriceMarkupCollectionType;

class PriceMarkupController extends ResourceController
{
    public function indexAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::INDEX);
        $resources = $this->resourcesCollectionProvider->get($configuration, $this->repository);

        $this->eventDispatcher->dispatchMultiple(ResourceActions::INDEX, $configuration, $resources);

        $code = 'pricemarkup';
        $formFactory = $this->get('form.factory');
        $form = $formFactory->createNamedBuilder($code,  \App\Form\Type\PriceMarkupCollectionType::class)
                ->setAction($this->generateUrl('sylius_admin_pricemarkup_update'))
                ->setMethod('POST')
                ->getForm();
        ;
        $em = $this->getDoctrine()->getManager();
        $tmp = $em->getRepository('\App\Entity\PriceMarkup')->findAll();
        $allData = [];
        foreach($tmp as $t){
            $allData[$t->getChannel()->getCode()] = $t;
        }
        return $this->render('@SyliusAdmin/PriceMarkup/index.html.twig', [
            'controller_name' => 'PriceMarkupController',
            'metadata' => $this->metadata,
            'pricemarkup_form' => $form->createView(),
            'allData' => $allData
        ]);
    }

    public function updateAction(Request $request): Response
    {
        $data = $request->request->get('pricemarkup');
        
        $em = $this->getDoctrine()->getManager();
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $translator = $this->get('translator');
        foreach($data as  $code => $f){
            if($code == 'save' or $code == 'channelId') {
                continue;
            }
            $task = new \App\Entity\PriceMarkup;
            $channel = $em->getRepository('\Sylius\Component\Channel\Model\Channel')->findOneByCode($code);
            
            $form = $this->createForm(\App\Form\Type\PriceMarkupType::class, $task);
            $form->submit($f);
            if($form->isSubmitted()){
                $task->setChannelId($channel->getId());
                $exists = $em->getRepository('\App\Entity\PriceMarkup')->findOneBy(['channelId'=>$channel->getId()]);
                if($exists){
                    $exists->setFormula($task->getFormula());
                    $em->merge($exists);
                }else{
                    $task->setChannel($channel);
                    $em->persist($task);
                }
                $em->flush();
            }
        }
        $session->getFlashBag()->add('success', $translator->trans('sylius.ui.saved'));
        return $this->redirectToRoute('sylius_admin_pricemarkup_index');
    }

}
