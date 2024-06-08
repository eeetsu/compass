@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
      <div class="h-75 border">
        <table class="table">
          <thead>
              <tr class="table-thead" width="100%">
                <th>ID</th>
                <th>名前</th>
                <th>場所</th>
              </tr>
          </thead>
          <tbody>
              @foreach($reservePersons as $reservePerson)
                <tr class="text-center">
                  <td class="table-thead-in">{{ $reservePerson->id }}</td>
                  <td class="table-thead-in">{{ $reservePerson->over_name }} {{ $reservePerson->under_name }}</td>
                  <td class="table-thead-in">リモート</td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
@endsection
