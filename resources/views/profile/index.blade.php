<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>

    @if (Auth::user()->usertype == 'user')
        @include('profile.user')
    @endif

    @if (Auth::user()->usertype == 'mentor')
        @include('profile.mentor')
    @endif
    
</x-app-layout> 