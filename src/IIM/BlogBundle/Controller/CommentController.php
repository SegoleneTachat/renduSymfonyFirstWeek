<?php

namespace IIM\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IIM\BlogBundle\Entity\Comment;
use IIM\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 *
 * @Route("/comment")
 */
class CommentController extends Controller
{

    /**
     * Lists all Comment entities.
     *
     * @Route("/", name="comment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        //$em = $this->get('comment.manager');
        //$em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('IIMBlogBundle:Comment')->findAll();
        $entities = $this->get('comment.manager')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Comment entity.
     *
     * @Route("/{article_id}/create", name="comment_create")
     * @Template("IIMBlogBundle:Comment:new.html.twig")
     */
    public function createAction(Request $request, $article_id)
    {
        $article = $this->get('article.manager')->find($article_id);

        $form = $this->createForm('comment', null, array(
            'action' => $this->generateUrl('comment_create', array('article_id' => $article_id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));


        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $comment = $form->getData();
                $user = $this->get('security.context')->getToken()->getUser();

                //$user = $this->getUser;
                $comment->setAuthor($user);
                $comment->setArticle($article);
                $this->get('comment.manager')->update($comment);

                return $this->redirect($this->generateUrl('article_show', array('id' => $article_id)));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Creates a form to create a Comment entity.
     *
     * @param Comment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /*private function createCreateForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    */

    /**
     * Finds and displays a Comment entity.
     *
     * @Route("/{id}", name="comment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('IIMBlogBundle:Comment')->find($id);
        $entity = $this->get('comment.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     * @Route("/{id}/edit", name="comment_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {

        $entity = $this->get('comment.manager')->find($id);

        $form = $this->createForm('comment', $entity, array(
            'action' => $this->generateUrl('comment_edit', array('id' => $id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity = $form->getData();
                $this->get('comment.manager')->update($entity);

                return $this->redirect($this->generateUrl('comment_edit', array('id' => $id)));
            }
        }


        return array(
            'edit_form'   => $form->createView(),
            'delete_form' => $this->createDeleteForm($id)->createView(),
        );

        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('IIMBlogBundle:Comment')->find($id);
        /*
        $entity = $this->get('comment.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
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
     * Deletes a Comment entity.
     *
     * @Route("/{id}", name="comment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            //$em = $this->getDoctrine()->getManager();
            //$entity = $em->getRepository('IIMBlogBundle:Comment')->find($id);
            $entity = $this->get('comment.manager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $this->get('comment.manager')->delete($entity);
            //$this->get('comment.manager')->update($entity);
            //$em->remove($entity);
            //$em->flush();
        }

        return $this->redirect($this->generateUrl('comment'));
    }

    /**
     * Creates a form to delete a Comment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
