<?php

namespace IIM\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IIM\BlogBundle\Entity\Article;
use IIM\BlogBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        //$em = $this->get('article.manager');
        //$em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('IIMBlogBundle:Article')->findAll();
        $entities = $this->get('article.manager')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/create", name="article_create")
     * @Template("IIMBlogBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('article', null, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $article = $form->getData();
                $user = $this->get('security.context')->getToken()->getUser();
                //$user = $this->getUser;
                $article->setAuthor($user);
                $this->get('article.manager')->update($article);

                return $this->redirect($this->generateUrl('article_show', array('id' => $article->getId())));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
    * Creates a form to create a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    /*private function createCreateForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    */

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('IIMBlogBundle:Article')->find($id);
        $entity = $this->get('article.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {

        $entity = $this->get('article.manager')->find($id);

        $form = $this->createForm('article', $entity, array(
            'action' => $this->generateUrl('article_edit', array('id' => $id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity = $form->getData();
                $this->get('article.manager')->update($entity);

                return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
            }
        }


        return array(
            'edit_form'   => $form->createView(),
            'delete_form' => $this->createDeleteForm($id)->createView(),
        );

        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('IIMBlogBundle:Article')->find($id);
        /*
        $entity = $this->get('article.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
        */
    }
    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            //$em = $this->getDoctrine()->getManager();
            //$entity = $em->getRepository('IIMBlogBundle:Article')->find($id);
            $entity = $this->get('article.manager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $this->get('article.manager')->delete($entity);
            //$this->get('article.manager')->update($entity);
            //$em->remove($entity);
            //$em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
