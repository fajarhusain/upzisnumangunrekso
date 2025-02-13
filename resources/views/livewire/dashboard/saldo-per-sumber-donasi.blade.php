<div>
    @foreach ($sumberDanas as $sumberDana)
        <livewire:dashboard.saldo-per-sumber-dana :selectedTahun="$this->selectedTahun" :sumberDana="$sumberDana" :sumberDonasi="$this->sumberDonasi"
            :key="$sumberDana->id">
    @endforeach
</div>
