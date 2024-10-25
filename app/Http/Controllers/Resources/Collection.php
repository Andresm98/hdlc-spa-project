<?php

namespace App\Http\Controllers\Resources;


class Collection
{
    protected $items = [];

    // Constructor para inicializar los elementos
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    // Obtener todos los elementos
    public function all()
    {
        return $this->items;
    }

    // Filtrar elementos
    public function filter(callable $callback)
    {
        return new static(array_filter($this->items, $callback));
    }

    // Mapear los elementos
    public function map(callable $callback)
    {
        return new static(array_map($callback, $this->items));
    }

    // Obtener un valor específico por clave
    public function pluck($key)
    {
        return array_map(function ($item) use ($key) {
            return is_array($item) ? $item[$key] : $item->$key;
        }, $this->items);
    }

    // Convertir la colección en un array
    public function toArray()
    {
        return $this->items;
    }
}
