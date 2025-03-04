<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b> Multi Pictures</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container overflow-hidden"> <!-- Added overflow-hidden -->
            <div class="row">
                <!-- Image Display Section -->
                <div class="col-md-8">
                    <div class="row"> <!-- Wrapped inside a row -->

                              {{-- Sucess Message --}}
                              @if (session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>{{ session('success') }}</strong>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"
                                      aria-label="Close"></button>
                              </div>
                          @endif

                          
                        @foreach ($images as $multi)
                            <div class="col-md-3 mt-4"> <!-- Removed m-2 -->
                                <div class="card">
                                    <img src="{{ asset($multi->image) }}" alt="" class="img-fluid"> <!-- Used img-fluid -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi Images
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Image Upload -->
                                <div class="form-group mb-3">
                                    <label for="imageUpload" class="form-label">Brand Image</label>
                                    <input type="file" name="image[]" class="form-control" id="imageUpload" multiple>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
