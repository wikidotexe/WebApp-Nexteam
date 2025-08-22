<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('nexteam')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->favicon(asset('front/images/Logo NFEH.png'))
            ->pages([
                Pages\Dashboard::class,
            ])
            ->resources([
                // Web
                \App\Filament\Resources\ArticleResource::class,
                \App\Filament\Resources\CategoryResource::class,
                \App\Filament\Resources\FaqResource::class,
                \App\Filament\Resources\MemberResource::class,
                \App\Filament\Resources\PageResource::class,
                \App\Filament\Resources\ServiceResource::class,
                \App\Filament\Resources\OurclientsResource::class,

                // Work
                \App\Filament\Resources\ClientResource::class,
                \App\Filament\Resources\InvoiceResource::class,
                \App\Filament\Resources\ProjectResource::class,
            ])
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Web'),
                \Filament\Navigation\NavigationGroup::make('Work'),
            ])
            ->widgets([
                \App\Filament\Widgets\InvoiceStatistics::class,
                \App\Filament\Widgets\TotalClient::class,
                \App\Filament\Widgets\LatestProject::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}