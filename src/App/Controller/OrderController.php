<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sylius\Bundle\OrderBundle\Controller\OrderController as BaseOrderController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderController extends BaseOrderController
{

    public function updatetrackAction (Request $request):  Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $resource = $this->findOr404($configuration);

        $task = new \App\Entity\OrderTrack;
        $form = $this->createForm(\App\Form\Type\OrderTrackType::class, $task);
        
        $form->handleRequest($request);  
        
        $translator = $this->get('translator');

        if ($request->isMethod('POST')) {
            foreach($resource->getItems() as $item){
                $code = 'track_'.str_replace('&', '', $item->getVariant()->getCode());
                $data = $request->request->get($code);
                if($data){
                    $form->submit($data);
                    if ($form->isSubmitted() ) {
                        $em = $this->getDoctrine()->getManager();
                        
                        if(!$task->getTracknum() )$task->setTracknum('');
                        $task->setOrderItem($item);
                        $exists = $em->getRepository('\App\Entity\OrderTrack')->findOneBy(['orderItemId'=>$item->getId()]);
                        
                        if($exists){
                            $exists->setTracknum($task->getTrackNum())
                                    ->setTrackId($data['trackId']);
                            $em->merge($exists);
                        }else{
                            $task->setTrack($em->getReference('\App\Entity\Track', $data['trackId']));
                            $em->persist($task);
                        }
                        
                        $em->flush();
                        $session = new \Symfony\Component\HttpFoundation\Session\Session();
                        $session->getFlashBag()->add('success', $translator->trans('sylius.ui.updated'));
                    }
                }
            }
            return $this->redirectToRoute('sylius_admin_order_show',['id'=>$resource->getId()]);
        }
        
    }

    public function updatecostAction (Request $request):  Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $resource = $this->findOr404($configuration);

        $task = new \App\Entity\OrderItemReconcile;
        $form = $this->createForm(\App\Form\Type\OrderItemReconcileType::class, $task);
        
        $form->handleRequest($request);  
        
        $translator = $this->get('translator');

        if ($request->isMethod('POST')) {
            foreach($resource->getItems() as $item){
                $code = 'reconcile_'.str_replace('&', '', $item->getVariant()->getCode());
                $data = $request->request->get($code);
                if($data){
                    $form->submit($data);
                    
                    if ($form->isSubmitted() ) {
                        $em = $this->getDoctrine()->getManager();
                        
                        if(!$task->getRealCost() )$task->setRealCost(0);
                        if(!$task->getRealShipping() )$task->setRealShipping(0);
 
                        $task->setOrderItem($item);
                        $task->setOrderItemId($item->getId());
                        
                        if(isset($data['id'])){
                            $task->setId((int)$data['id']);
                            $em->merge($task);
                        }else{
                            $em->persist($task);
                        }
                        $em->flush();
                        $session = new \Symfony\Component\HttpFoundation\Session\Session();
                        $session->getFlashBag()->add('success', $translator->trans('sylius.ui.updated'));
                    }
                }
            }
            return $this->redirectToRoute('sylius_admin_order_show',['id'=>$resource->getId()]);
        }
        
    }

    public function routeAction (Request $request):  Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $resource = $this->findOr404($configuration);

        $task = new \App\Entity\OrderRouted;
        $form = $this->createForm(\App\Form\Type\OrderRouted::class, $task);
        
        $form->handleRequest($request);  
        
        $translator = $this->get('translator');

        if ($request->isMethod('POST')) {
            foreach($resource->getItems() as $item){
                $code = str_replace('&', '', $item->getVariant()->getCode());
                if($request->request->get($code)){
                    $form->submit($request->request->get($code));
                    if ($form->isSubmitted() ) {
                        $em = $this->getDoctrine()->getManager();
                    
                       // $inv = $em->getRepository('\App\Entity\Inventory')->findOneById(['id'=>$form->getData()->getInventoryId()]);
                        $inv = $em->getReference('\App\Entity\Inventory', $form->getData()->getInventoryId());
                        $task->setInventory($inv);
                        $task->setOrderItem($item);
                        $em->persist($task);
                        $em->flush();
                        $session = new \Symfony\Component\HttpFoundation\Session\Session();
                        $session->getFlashBag()->add('success', $translator->trans('sylius.ui.order_routed_ok'));
                        //$this->addFlash( 'notice', 'sylius.ui.order_routed_ok' );
                    }
                }
            }
            return $this->redirectToRoute('sylius_admin_order_show',['id'=>$resource->getId()]);
        }
        
    }

    public function showAction (Request $request):  Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);
        $resource = $this->findOr404($configuration);

        $this->eventDispatcher->dispatch(ResourceActions::SHOW, $configuration, $resource);

        $formFactory = $this->get('form.factory');
        $forms = [];
        $em = $this->getDoctrine()->getManager();
        foreach($resource->getItems() as $item){
            $code = str_replace('&', '', $item->getVariant()->getCode());
            $form = $formFactory->createNamedBuilder($code,  \App\Form\Type\OrderRouted::class)
                ->setAction($this->generateUrl('sylius_admin_inventory_route', ['id' => $resource->getId()]))
                ->setMethod('POST')
                ->getForm();

            $forms[$code] = $form->createView();
            
            $form = $formFactory->createNamedBuilder('reconcile_'.$code,  \App\Form\Type\OrderItemReconcileType::class)
            ->setAction($this->generateUrl('sylius_admin_inventory_updatecost', ['id' => $resource->getId()]))
            ->setMethod('POST')
            ->getForm();
            
            $forms['reconcile_'.$code] = $form->createView();
            
            $t = $em->getRepository('\App\Entity\Track')->findAll();
            $out = [];
            foreach($t as $v){
                $out[$v->getName()] = $v->getId();
            }
            
            $form = $formFactory->createNamedBuilder('track_'.$code,  \App\Form\Type\OrderTrackType::class)
            ->add('trackId', ChoiceType::class, ['choices' => $out, 'data' => $item->getTrack() ? $item->getTrack()->getTrackId() : 0])
            ->setAction($this->generateUrl('sylius_admin_inventory_updatecost', ['id' => $resource->getId()]))
            ->setMethod('POST')
            ->getForm();
            
            $forms['track_'.$code] = $form->createView();

        }
        if ($configuration->isHtmlRequest()) {
            return $this->render($configuration->getTemplate(ResourceActions::SHOW . '.html'), [
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $resource,
                'forms' => $forms,
                $this->metadata->getName() => $resource,
            ]);
        }

        return $this->createRestView($configuration, $resource);
    }
}
