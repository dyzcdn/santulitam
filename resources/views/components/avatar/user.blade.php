@props([
    'user' => auth()->user(),
])

@php
    $avatarUrl = auth()->user()->getFilamentAvatarUrl($user);
    $avatarPath = asset($avatarUrl);
@endphp

<x-filament::avatar
    :src="$avatarPath"
    :alt="__('filament-panels::layout.avatar.alt', ['name' => filament()->getUserName($user)])"
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->class(['fi-user-avatar'])
    "
/>



