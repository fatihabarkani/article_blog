<?php

namespace App\Entity;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=ArticleBlog::class, mappedBy="id_category")
     */
    private $articleBlogs;




    public function __construct()
    {
        $this->articleBlogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|ArticleBlog[]
     */
    public function getArticleBlogs(): Collection
    {
        return $this->articleBlogs;
    }

    public function addArticleBlog(ArticleBlog $articleBlog): self
    {
        if (!$this->articleBlogs->contains($articleBlog)) {
            $this->articleBlogs[] = $articleBlog;
            $articleBlog->setIdCategory($this);
        }

        return $this;
    }

    public function removeArticleBlog(ArticleBlog $articleBlog): self
    {
        if ($this->articleBlogs->removeElement($articleBlog)) {
            // set the owning side to null (unless already changed)
            if ($articleBlog->getIdCategory() === $this) {
                $articleBlog->setIdCategory(null);
            }
        }

        return $this;
    }


}
