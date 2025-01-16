<x-app-layout>

    @if (Auth::user()->usertype == 'user')

    @endif

    @if (Auth::user()->usertype == 'mentor')

    @endif
</x-app-layout> 