<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}

            HI.. <b>{{ Auth::user()->name }}</b>
            <b style="float:right">Total Users
            <span class="badge bg-success">{{ count($users) }}</span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}
<div class="container">
<div class="row">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">SL No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
          </tr>
        </thead>
        <tbody>
@php($i = 1)
            @foreach($users as $user)
          <tr>
            <th scope="row">{{$i++}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            {{-- //Eloquent ORM
            <td>{{$user->created_at->diffForHumans()}}</td>--}}
            {{-- Query Builder --}}
            <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
          </tr>
@endforeach

        </tbody>
      </table>










</div>







</div>
    </div>
</x-app-layout>
