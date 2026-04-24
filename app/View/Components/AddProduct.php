<?php // Deklarasi blok PHP untuk kode server-side

namespace App\View\Components; // Menentukan namespace untuk class ini

use Closure; // Import class Closure dari PHP
use Illuminate\Contracts\View\View; // Import interface View dari Laravel
use Illuminate\View\Component; // Import class Component dari Laravel

class AddProduct extends Component // Deklarasi class AddProduct yang extends Component (Livewire Component)
{ // Buka blok class
    /**
     * Create a new component instance.
     */
    public function __construct() // Fungsi constructor - dipanggil saat component di-instantiate
    { // Buka blok fungsi
        // // Tidak ada property yang diinisialisasi
    } // Tutup blok fungsi

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string // Fungsi untuk render component (return View, Closure, atau string)
    { // Buka blok fungsi
        return view('components.add-product'); // Return view 'components.add-product' yang berisi template component
    } // Tutup blok fungsi
} // Tutup blok class
