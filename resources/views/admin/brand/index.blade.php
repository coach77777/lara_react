<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}

            All Brand<b></b>

        </h2>
    </x-slot>

    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}





            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                <div class="card">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif






                <div class="card-header">
                All Brand

                </div>


                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                {{-- @php($i =1) --}}
                @foreach($brands as $brand)
                          <tr>
                            {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                            {{-- <th scope="row">{{ $i++ }}</th> --}}

                            <td>{{$brand->brand_name}}</td>

                            {{-- EOM changed user_id to user to get name from user table --}}
                            <td><img src=" " alt = " " />></td>

                            {{-- with Query Builder just name --}}
                            {{-- <td>{{$category->name}}</td> --}}

                            @if($category->created_at == NULL)
                            <span class="text-danger">No Date Set</span>
                            @else
                            {{-- <td>{{ $category->created_at->diffForHumans() }}</td> --}}

                             {{-- Query Builder --}}
                            <td>{{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}</td>
                            @endif
                            {{-- //Eloquent ORM
                            <td>{{$user->created_at->diffForHumans()}}</td>--}}

                            {{-- Query Builder --}}
                            {{-- <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> --}}
                            <td>
                            <a href="{{ route('brand.edit', ['id' => $brand->id]) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('brand.delete', ['id' => $brand->id]) }}" class="btn btn-danger">Delete</a>
                            </td>

                          </tr>
                @endforeach
                        </tbody>
                      </table>
                      {{ $brands->links() }}



                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">
                    Add Brand

                    </div>
                    <div class="card-body">


                    <form action="{{ route('store.brand') }}" method="POST">

                        @csrf

                        <div class="form-group mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                          <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('brand_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                        </div>

{{-- //Image Upload --}}
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                            <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('brand_image')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                          </div>

                        <button type="submit" class="btn btn-primary">Add Brand</button>
                      </form>
                </div>
                </div>
                </div>



                </div>

                </div>









    </div>
</x-app-layout>
