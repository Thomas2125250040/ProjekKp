@extends('layouts.main')
@section('content')
{{ $data }}
<script>
    console.log({{ $data }});
</script>
@endsection