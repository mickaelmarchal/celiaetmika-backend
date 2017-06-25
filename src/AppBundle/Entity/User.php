<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * A Blog User.
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     iri="http://schema.org/Person",
 *     attributes={
 *         "normalization_context"={"groups"={"user", "userRead"}},
 *         "denormalization_context"={"groups"={"user", "userWrite"}
 *     }
 * }))
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"user", "postView"})
     */
    private $id;

    /**
     * @var string User email address
     *
     * @Assert\Type(type="string")
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @ApiProperty(iri="http://schema.org/email")
     * @Groups({"user"})
     */
    private $email;

    /**
     * @var string User password
     *
     * @Assert\Type(type="string")
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var string User password, as plain text
     * Only used to set the password, not persisted
     *
     * @Assert\Type(type="string")
     * @Groups({"userWrite"})
     */
    private $plaintextPassword;


    /**
     * @var string User display name
     *
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @ApiProperty(iri="http://schema.org/additionalName")
     * @Groups({"user", "postView"})
     */
    private $displayName;

    /**
     * @var \DateTime User creation date
     *
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"userRead"})
     */
    private $creationDate;

    /**
     * @var ArrayCollection Groups for the User.
     *
     * @ORM\ManyToMany(targetEntity="UserGroup")
     * @ORM\JoinTable(
     *     name="users_groups",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    private $groups;


    /**
     * User constructor.
     */
    public function __construct() {
        $this->groups = new ArrayCollection();
    }

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
     * Set encoded password.
     *
     * @param string $password
     * @return User
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get encoded password.
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plain text password.
     *
     * @param string $plaintextPassword
     * @return User
     */
    public function setPlaintextPassword(string $plaintextPassword)
    {
        $this->plaintextPassword = $plaintextPassword;
        return $this;
    }

    /**
     * Get plain text password.
     * @return string
     */
    public function getPlaintextPassword()
    {
        return $this->plaintextPassword;
    }

    /**
     * Set display name.
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName(string $displayName)
    {
        $this->displayName = $displayName;
        return $this;
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
     * @return User
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
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

    /**
     * Get username of user (= email)
     * @return mixed
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Get salt for user password.
     * @return null
     */
    public function getSalt()
    {
        // no salt necessary, using bcrypt
        return null;
    }

    /**
     * Get roles of user
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Erase user credentials
     */
    public function eraseCredentials()
    {
        $this->plaintextPassword = null;
    }


    /**
     * Encode the password if plainText password is provided.
     *
     * @return User
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function encodePassword()
    {
        if ($this->getPlaintextPassword()) {
            $encoder = new BCryptPasswordEncoder(12);
            $encoded = $encoder->encodePassword($this->getPlaintextPassword(), $this->getSalt());
            $this->setPassword($encoded);
            $this->eraseCredentials();
        }

        return $this;
    }

    /**
     * Set creation date of User.
     *
     * @return User
     *
     * @ORM\PrePersist
     */
    public function generateCreationDate()
    {
        $this->setCreationDate(new \DateTime());

        return $this;
    }

}
