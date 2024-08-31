<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Facades\Filament;
use Kenepa\Banner\BannerPlugin;
use Filament\Navigation\MenuItem;
use App\Filament\Pages\Auth\Login;
use Filament\Support\Colors\Color;
use Filament\Pages\Auth\EditProfile;
use Filament\Navigation\UserMenuItem;
use Filament\Http\Middleware\Authenticate;
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
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class CentralPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('')
            ->path('')
            ->brandLogo(asset('logo/logo-santulitam-light.png'))
            ->darkModeBrandLogo(asset('logo/logo-santulitam-dark.png'))
            ->brandLogoHeight('50px')
            // ->profile(EditProfile::class)
            ->login(Login::class)
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
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')
            ])
            // ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugins([
                FilamentEditProfilePlugin::make()
                ->slug('my-profile')
                ->setTitle('My Profile')
                ->setNavigationLabel('My Profile')
                ->setNavigationGroup('Settings')
                ->setIcon('heroicon-o-user')
                ->shouldRegisterNavigation(false)
                ->shouldShowDeleteAccountForm(true)
                // ->shouldShowSanctumTokens()
                ->shouldShowBrowserSessionsForm()
                ->shouldShowAvatarForm()
            ])
            ->plugins([
                BannerPlugin::make()
                ->persistsBannersInDatabase()
                ->bannerManagerAccessPermission('banner-manager')
             ])
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
                    ->label('Scan QR')
                    ->url('scaner')
                    ->icon('heroicon-o-qr-code')
            ]);
        });
    }
}
