<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ourclients;

class ShowOurClients extends Component
{
    public function render()
    {   
        // Ambil semua clients dengan status aktif, urut berdasarkan nama
        $clients = Ourclients::orderBy('name_clients', 'ASC')
            ->where('status', 1)
            ->get();

        return view('livewire.show-our-clients', [
            'clients' => $clients
        ]);
    }
}
