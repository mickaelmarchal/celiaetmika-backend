<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * A Blog Tag.
 *
 * @ORM\Entity
 * @ApiResource()
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string Tag name
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string Tag description
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * Sets id.
     *
     * @param int $id
     * @return Tag
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
     * Sets name.
     *
     * @param string $name
     * @return Tag
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     * @return Tag
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

}
