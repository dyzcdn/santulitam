<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Pages\Auth\EditProfile;
use Filament\Navigation\UserMenuItem;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class CentralPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('')
            ->path('')
            ->brandName('Santulitam')
            ->brandLogo(asset('logo/logo-santulitam-light.png'))
            ->darkModeBrandLogo(asset('logo/logo-santulitam-dark.png'))
            ->brandLogoHeight('50px')
            // ->profile(EditProfile::class)
            ->login()
            // ->topNavigation()
            ->sidebarWidth('22rem')
            ->colors([
                'danger'    => Color::Red,
                'gray'      => Color::Slate,
                'info'      => Color::Blue,
                'primary'   => Color::hex('#48abde'),
                'success'   => Color::Green,
                'warning'   => Color::Amber,
                'indigo'    => Color::Indigo,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigationGroups([
                'Data Master',
                'Instance',
                'Karisma',
                'Settings',
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
            ])
            // ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugin(
                BreezyCore::make()
                ->myProfile(
                    shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                    shouldRegisterNavigation: true, // Adds a main navigation item for the My Profile page (default = false)
                    navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                    hasAvatars: true, // Enables the avatar upload form component (default = false)
                    slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                )
                ->enableTwoFactorAuthentication(
                    force: false, // force the user to enable 2FA before they can use the application (default = false)
                    // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                )
                ->enableSanctumTokens(
                    permissions: ['my','custom','permissions'] // optional, customize the permissions (default = ["create", "view", "update", "delete"])
                ),
            )
            ->plugin(
                FilamentEnvEditorPlugin::make()
                    ->navigationGroup('System Tools')
                    ->navigationLabel('My Env')
                    ->navigationIcon('heroicon-o-cog-8-tooth')
                    ->navigationSort(1)
                    ->slug('env-editor')
                    ->authorize(
                        fn () => auth()->user()->user_role_id==1
                    )
            );
    }

    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Settings')
                    ->url('settings')
                    ->icon('heroicon-s-cog')
            ]);
        });
    }
}
