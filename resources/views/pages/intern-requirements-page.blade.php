<x-app-layout>
    <x-slot name="header">
        @if (session('error'))
            <div id="flash-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    </x-slot>
    <livewire:student-requirement-manager>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.transition = "opacity 0.5s";
                    flashMessage.style.opacity = 0;
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 500);
                }
            }, 3000);
        });
    </script>
</x-app-layout>
