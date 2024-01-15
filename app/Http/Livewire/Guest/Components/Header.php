<?php

namespace App\Http\Livewire\Guest\Components;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Product;
use App\Settings\LayoutSetting;
use Livewire\Component;

class Header extends Component
{

    public function render()
    {
        return view('livewire.guest.components.header');
    }
}
