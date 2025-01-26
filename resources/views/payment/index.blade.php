<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
<div class="container mx-auto px-4 py-8 flex justify-center items-center" style="height: 100vh;">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <!-- Course Image -->
        <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="rounded-t-lg  h-10 bject-cover mb-4">

        <!-- Course Information -->
        <h3 class="text-2xl font-bold text-center">{{ $course->name }}</h3>
        <p class="text-gray-600 text-center mt-2">Anda akan membeli kursus ini:</p>
        
        <!-- Course Price -->
        <p class="text-lg font-semibold text-green-600 text-center mt-2">Rp. {{ number_format($course->price, 2, ',', '.') }}</p>

        <!-- Checkout Button -->
        <button id="pay-button" class="mt-6 w-full px-6 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-600">
            Bayar Sekarang
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay("{{ $snapToken }}", {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                console.log(result);
            },
            onPending: function(result) {
                alert('Pembayaran tertunda.');
                console.log(result);
            },
            onError: function(result) {
                alert('Pembayaran gagal.');
                console.log(result);
            }
        });
    });
</script>

</x-app-layout>
