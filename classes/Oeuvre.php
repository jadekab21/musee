<?php

class Oeuvre{
    private string $name;
    private string $description;
    private string $prix;
    private int $like;
    private int $categories_id;

    public function __construct($oeuvre)
    {
        $this->name = $oeuvre['name'];
        $this->description = $oeuvre['description'];
        $this->type = $oeuvre['prix'];
        $this->donjon_id = $oeuvre['like'];
        $this->donjon_id = $oeuvre['categories_id'];


    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}