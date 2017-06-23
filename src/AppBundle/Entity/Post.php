<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Parsedown;

/**
 * A blog post.
 *
 * @see http://schema.org/Article Documentation on Schema.org
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     iri="http://schema.org/Article",
 *     attributes={"normalization_context"={"groups"={"postView"}}}
 * )
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"postView"})
     */
    private $id;

    /**
     * @var string The title of the post
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="http://schema.org/name")
     * @Groups({"postView"})
     */
    private $title;

    /**
     * @var string The markdown-formatted body of the post
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @ORM\Column(type="text")
     */
    private $markdownBody;

    /**
     * @var string The body of the post (HTML format, generated from markdown)
     *
     * @Assert\Type(type="string")
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/articleBody")
     * @Groups({"postView"})
     */
    private $body;

    /**
     * @var \DateTime The date on which the CreativeWork was created or the item was added to a DataFeed
     *
     * @Assert\Date
     * @Assert\NotNull
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="http://schema.org/dateCreated")
     * @Groups({"postView"})
     */
    private $publicationDate;

    /**
     * @var User The author of the post.
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @Groups({"postView"})
     */
    private $author;


    /**
     * Sets id.
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets id.
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title the value to set
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Sets markdown body.
     *
     * @param string $markdownBody
     *
     * @return $this
     */
    public function setMarkdownBody($markdownBody)
    {
        $this->markdownBody = $markdownBody;
        return $this;
    }

    /**
     * Gets markdown body.
     *
     * @return string
     */
    public function getMarkdownBody()
    {
        return $this->markdownBody;
    }

    /**
     * Sets body.
     *
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Gets body.
     *
     * @return string
     */
    public function getBody() : string
    {
        return $this->body;
    }

    /**
     * Set publicationDate.
     *
     * @param \DateTime the value to set
     */
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get publicationDate.
     *
     * @return \DateTime
     */
    public function getPublicationDate() : \DateTime
    {
        return $this->publicationDate;
    }


    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Post
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Generate the HTML body using markdown body
     * Called each time the row is updated / inserted
     *
     * @return Post
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function generateHTML()
    {
        // TODO re-generate HTML only if markdown has changed
        $parsedown = new Parsedown();
        $this->setBody($parsedown->text($this->getMarkdownBody()));

        return $this;
    }

}
