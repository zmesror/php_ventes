<?php
namespace App\Model;

use App\Helpers\Text;

class Item {
    private $id;

    private $nom;

    private $description;

    private $prix;

    private $image_data;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getExcerpt (): ?string
    {
        if ($this->description == null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->description, 6)));
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getImageData()
    {
        return $this->image_data;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function setImageData($image_data) {
        $this->image_data = $image_data;
        return $this;
    }
    
}