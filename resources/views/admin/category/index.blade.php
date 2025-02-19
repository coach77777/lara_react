<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}

            All Cateory<b></b>

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
All category

</div>


    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">SL No.</th>
            <th scope="col">Category Name</th>
            <th scope="col">User</th>
            <th scope="col">Created At</th>
          </tr>
        </thead>
        <tbody>
@php($i =1)
@foreach($categories as $category)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{$category->category_name}}</td>
            <td>{{$category->user_id }}</td>
            @if($category->created_at == NULL)
            <span class="text-danger">No Date Set</span>
            @else
            {{-- <td>{{ $category->created_at->diffForHumans() }}</td> --}}
             {{-- Query Builder --}}
            <td>{{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
            @endif
            {{-- //Eloquent ORM
            <td>{{$user->created_at->diffForHumans()}}</td>--}}
            {{-- Query Builder --}}
            {{-- <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> --}}
          </tr>
@endforeach
        </tbody>
      </table>



    </div>
</div>


<div class="col-md-4">
    <div class="card">
    <div class="card-header">
    Add Category

    </div>
    <div class="card-body">


    <form action={{route('store.category')}} method="POST">

        @csrf

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Category Name</label>
          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
