<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * A Blog User.
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Person")
 */
class User
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
     * @var string User email address
     *
     * @Assert\Type(type="string")
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @ApiProperty(iri="http://schema.org/email")
     */
    private $email;

    /**
     * @var string User display name
     *
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @ApiProperty(iri="http://schema.org/additionalName")
     * @Groups({"postView"})
     */
    private $displayName;

    /**
     * @var \DateTime User creation date
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $creationDate;


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
     * Sets email.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Set display name.
     *
     * @param string $displayName
     */
    public function setDisplayName(string $displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * Get display name.
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }

    /**
     * Set creation date.
     *
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Get creation date.
     *
     * @return \DateTime
     */
    public function getCreationDate() : \DateTime
    {
        return $this->creationDate;
    }

}
