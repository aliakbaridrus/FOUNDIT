@extends('layouts.app')

@section('title', 'Post an Item – FoundIt')

@section('content')

<div class="max-w-[1200px] mx-auto px-6 py-10">

    <div class="mb-8">
        <span class="text-xs font-semibold text-brand uppercase tracking-wider">Submit</span>
        <h1 class="font-heading font-bold text-4xl text-txt mt-2">Post an Item</h1>
        <p class="text-txt-secondary mt-2">Report lost or found items to help the community.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <ul class="text-red-700 text-sm font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        @csrf

        <div class="flex flex-col lg:flex-row">

            <div class="lg:w-5/12 p-8 bg-slate-50 flex flex-col items-center justify-center border-r border-slate-100">

                <div id="upload-zone"
                     class="w-full aspect-square rounded-3xl border-2 border-dashed border-slate-200 bg-white flex flex-col items-center justify-center cursor-pointer hover:border-brand transition-all">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mb-4">
                        <i data-lucide="image-plus" class="w-8 h-8 text-brand"></i>
                    </div>
                    <p id="upload-text" class="font-semibold text-txt text-sm mb-1">Upload Image</p>
                    <p id="upload-subtext" class="text-xs text-txt-secondary text-center px-6">PNG, JPG up to 5MB</p>
                </div>

                <input type="file" name="image" id="imageInput" accept="image/png, image/jpeg" class="hidden" required>

            </div>

            <div class="lg:w-7/12 p-8 space-y-5">

                <div>
                    <label class="block text-sm font-medium mb-2">Item Name</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Black Leather Wallet" required
                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium mb-2">Category</label>
                        <select name="category" required
                                class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm">
                            <option value="">Select Category</option>
                            @foreach (['Electronics', 'Accessories', 'Documents', 'Pets', 'Keys', 'Other'] as $category)
                                <option @selected(old('category') === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Status</label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="Lost" class="peer hidden" checked>
                                <div class="px-4 py-3 rounded-xl bg-slate-50 border border-transparent text-center text-sm font-medium peer-checked:bg-red-50 peer-checked:border-red-200 peer-checked:text-red-600 transition">
                                    Lost
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="Found" class="peer hidden">
                                <div class="px-4 py-3 rounded-xl bg-slate-50 border border-transparent text-center text-sm font-medium peer-checked:bg-green-50 peer-checked:border-green-200 peer-checked:text-green-600 transition">
                                    Found
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="4" required placeholder="Describe the item..."
                              class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm resize-none">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Location</label>
                    <div class="flex items-center gap-2 px-4 py-3 bg-slate-50 rounded-xl">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                        <input type="text" name="location" value="{{ old('location') }}" required placeholder="Where was it lost/found?"
                               class="bg-transparent w-full outline-none text-sm">
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-4 rounded-xl bg-brand hover:bg-blue-700 text-white font-semibold flex items-center justify-center gap-2 transition shadow-lg shadow-blue-200">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Submit Item
                </button>

            </div>

        </div>

    </form>

</div>

@push('scripts')
<script>
    const uploadZone = document.getElementById('upload-zone');
    const imageInput = document.getElementById('imageInput');
    const uploadText = document.getElementById('upload-text');
    const uploadSubtext = document.getElementById('upload-subtext');

    uploadZone.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            uploadText.textContent = this.files[0].name;
            uploadSubtext.textContent = 'Image ready to upload';
        }
    });
</script>
@endpush

@endsection
