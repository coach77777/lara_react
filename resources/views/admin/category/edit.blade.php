<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}

          Edit Cateory<b></b>

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
    <div class="card-header">
    Edit Category

    </div>
    <div class="card-body">


    <form action="{{ route('category.update', ['id' => $categories->id]) }} " method="POST">

        @csrf

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Update Category Name</label>
          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          value="{{ $categories->category_name }}">
@error('category_name')
<span class="text-danger">{{$message}}</span>
@enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
      </form>
</div>
</div>
</div>



</div>

</div>
    </div>
</x-app-layout>
