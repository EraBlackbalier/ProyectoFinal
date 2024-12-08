<?php

namespace App\Livewire;

use Livewire\Component;

class TableSlider extends Component
{
    // Lista de las diapositivas
    public $slides = [1, 2, 3, 4, 5, 6, 7, 8];

    // Índice del slide actual
    public $currentSlide = 0;

    // Método para ir al siguiente slide
    public function next()
    {
        // Asegurarse de que el índice no exceda el límite de los slides
        if ($this->currentSlide < count($this->slides) - 1) {
            $this->currentSlide++;
        }
    }

    // Método para ir al slide anterior
    public function previous()
    {
        // Asegurarse de que el índice no sea negativo
        if ($this->currentSlide > 0) {
            $this->currentSlide--;
        }
    }

    public function render()
    {
        return view('livewire.table-slider');
    }
}
