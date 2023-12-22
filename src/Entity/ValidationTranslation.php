<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Locastic\ApiPlatformTranslationBundle\Model\TranslatableInterface;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity]
class ValidationTranslation extends AbstractTranslation
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::GUID)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    #[Groups(['translations'])]
    private $id;
    
    #[ORM\ManyToOne(targetEntity: 'Validation', inversedBy: 'translations')]
    protected ?TranslatableInterface $translatable = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 150)]
    #[Groups(['validation:write', 'translations'])]
    private ?string $description = null;

    /**
     * @var null|string
     */
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 5)]
    #[Groups(['translations', 'validation:write'])]
    protected ?string $locale = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
