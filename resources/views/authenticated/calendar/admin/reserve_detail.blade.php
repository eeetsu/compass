@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
<div class="w-50 m-auto h-75">
<p><span>該当日時：{{ $date }}</span><span class="ml-3">選択した部：{{ $part }}</span></p>
<div class="h-75 border">
<table class="table">
<thead>
<tr>
<th>ID</th>
<th>名前</th>
<th>場所</th>
</tr>
</thead>
<tbody>
@foreach($reservePersons as $reservePerson)
<tr class="text-center">
<td>{{ $reservePerson->users->id }}</td>
<td>{{ $reservePerson->users->name }}</td>
<td>リモート</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection
