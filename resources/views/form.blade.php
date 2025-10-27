<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sekem Fake Location</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Sekem Fake Location</h1>

        @if(session('response'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
                <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
            </div>
        @endif

        <form method="POST" action="{{ route('form.submit') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Customer Name</label>
                <input type="text" name="customer_name" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Notes</label>
                <textarea name="notes" class="w-full border rounded-lg p-2"></textarea>
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_mocking" id="mocking" class="w-4 h-4">
                <label for="mocking" class="text-sm font-semibold">Is Mocking</label>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Latitude</label>
                <input type="number" step="any" name="latitude" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Longitude</label>
                <input type="number" step="any" name="longitude" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Upload Image</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full border rounded-lg p-2"
                    onchange="previewImage(event)"
                >
                <div id="imagePreview" class="mt-3 hidden">
                    <img id="preview" src="" alt="Image Preview" class="w-40 h-40 object-cover rounded-lg shadow-md border border-gray-200">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Send Request
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
