<main>
    <section class="banner clients" id="clients">
        <div class="clients-heading-wrapper">
            <hr class="clients-line">
            <h1 class="heading">Our Clients</h1>
            <hr class="clients-line">
        </div>

        <p class="client-description">
            Klien yang mempercayakan kebutuhan digital mereka kepada kami.
        </p>

        <div class="logos-scroll-mask">
            <div class="logos-scroll">
                @foreach(range(1,2) as $i)
                    @foreach($clients as $client)
                        <a href="{{ $client->links }}" target="_blank">
                            <img src="{{ asset('storage/' . $client->image) }}"
                                 alt="{{ $client->name_clients }}"
                                 class="client-logo">
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</main>
