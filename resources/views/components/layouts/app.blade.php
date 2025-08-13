<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<title>{{ $title ?? 'NoFIleExistsHere' }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses, menawarkan solusi praktis untuk memenuhi kebutuhan digital Anda.">
	<meta name="keywords" content="computers, internet, technology, website, NoFIleExistsHere, nofileexistshere, nfeh, jasa layanan computer & internet">
	<meta name="author" content="NoFIleExistsHere">

	<!-- Open Graph -->
	<meta property="og:type" content="website">
	<meta property="og:locale" content="id_ID">
	<meta property="og:title" content="{{ $title ?? 'NoFIleExistsHere' }}">
	<meta property="og:description" content="Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses, menawarkan solusi praktis untuk memenuhi kebutuhan digital Anda.">
	<meta property="og:image" content="{{ asset('/front/images/og-default.jpg') }}">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:url" content="{{ url()->current() }}">

	<!-- Twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $title ?? 'NoFIleExistsHere' }}">
	<meta name="twitter:description" content="Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses, menawarkan solusi praktis untuk memenuhi kebutuhan digital Anda.">
	<meta name="twitter:image" content="{{ asset('/front/images/og-default.jpg') }}">

	<!-- Favicon -->
	<link rel="icon" href="{{ asset('/front/images/icon.png')}}" type="image/png">
	<link rel="apple-touch-icon" href="{{ asset('/front/images/icon.png')}}">
	<link rel="icon" sizes="192x192" href="{{ asset('/front/images/icon.png')}}">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- CSS Plugins -->
	<link rel="stylesheet" href="{{ asset('/front/plugins/slick/slick.css')}}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/brands.css')}}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/solid.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<!-- Main Style Sheet -->
	<link rel="stylesheet" href="{{ asset('/front/css/style.css')}}">

	<!-- Structured Data (Schema.org) -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "WebPage",
		"name": "{{ $title ?? 'NoFIleExistsHere' }}",
		"description": "Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses, menawarkan solusi praktis untuk memenuhi kebutuhan digital Anda.",
		"url": "{{ url()->current() }}"
	}
	</script>

	@livewireStyles
</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" wire:navigate href="{{ route('home')}}">
				<img loading="prelaod" decoding="async" class="img-fluid" width="120" src="{{ asset('/front/images/Logo NFEH.png')}}" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item "> <a wire:navigate class="nav-link" href="{{ route('home') }}">Home</a></li>
					<li class="nav-item "> <a wire:navigate class="nav-link" href="{{ route('aboutus') }}">About Us</a></li>
					<li class="nav-item "> <a wire:navigate class="nav-link" href="{{ route('servicesPage') }}">Services</a></li>
					<li class="nav-item "> <a wire:navigate class="nav-link" href="{{ route('teamPage')}}">Our Team</a></li>
					<li class="nav-item "> <a wire:navigate class="nav-link " href="{{ route('blog')}}">Blog</a></li>
					<li class="nav-item "> <a wire:navigate class="nav-link " href="{{ route('faqs')}}">FAQ</a></li>
				</ul>
				<a href="https://store.nofileexistshere.my.id/" target="_blank" class="btn btn-outline-primary">Store</a><br>
				<a wire:navigate href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
			</div>
		</div>
	</nav>
</header>
<!-- /navigation -->

{{ $slot }}

<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Other Places</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="https://fastwork.id/user/wikiarlnm/technical-support-53320956" target="_blank">Fastwork</a>
						</li>
						<li class="mb-2"><a href="https://www.upwork.com/services/product/development-it-technical-support-jaringan-website-toubleshooting-1936466459809396282?ref=project_share" target="_blank">Upwork</a>
						</li>
						<li class="mb-2"><a href="https://www.sribu.com/id/users/wikiarlianm/technical-support-32a666c4-d3a8-45be-af61-a4b54ec3ebdb" target="_blank">Sribu</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Quick Links</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="{{ route('page', 7) }}" wire:navigate>About Us</a>
						</li>
						<li class="mb-2"><a href="{{ route('contact')}}" wire:navigate>Contact Us</a>
						</li>
						<li class="mb-2"><a href="{{ route('blog')}}" wire:navigate>Blog</a>
						</li>
						<li class="mb-2"><a href="{{ route('teamPage')}}" wire:navigate>Team</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Other Links</h5>
					<ul class="list-unstyled">
						<li class="list-inline-item me-4"><a class="text-black" href="{{ route('privacy-policy') }}" wire:navigate>Privacy Policy</a>
                        </li>
						<li class="list-inline-item me-4"><a class="text-black" href="{{ route('term-conditions') }}" wire:navigate>Terms &amp; Conditions</a>
                        </li>
					</ul>
				</div>
			</div>		
		</div>
		<div class="text-center mt-4">
            <p class="text-muted">&copy; 2023 - 2025 All Right Reserved - PT Teknologi Kreasi Digital.</p>
        </div>
	</div>
</footer>

<!-- # JS Plugins -->
<script src="{{ asset('/front/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('/front/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('/front/plugins/scrollmenu/scrollmenu.min.js') }}"></script>
<script src="{{ asset('/front/plugins/slick/slick.min.js')}}"></script>
{{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

<!-- Main Script -->
<script src="{{ asset('/front/js/script.js')}}"></script>
@livewireScripts
@livewire('whatsapp-chat')
</body>
</html>