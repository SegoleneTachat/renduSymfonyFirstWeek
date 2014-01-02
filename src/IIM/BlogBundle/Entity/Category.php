<?php

namespace IIM\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IIM\BlogBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Article
     *
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="categories", cascade={"persist"})
     */
    private $articles;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \IIM\BlogBundle\Entity\Article $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function __toString()
    {
        return $this->name;
    }


    /**
     * Add articles
     *
     * @param \IIM\BlogBundle\Entity\Article $article
     * @return Category
     */
    public function addArticle(\IIM\BlogBundle\Entity\Article $article)
    {
        $this->addCategory($this);
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \IIM\BlogBundle\Entity\Article $articles
     */
    public function removeArticle(\IIM\BlogBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }
}
