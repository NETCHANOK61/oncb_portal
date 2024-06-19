<form action="{{ route('submitLoginForm') }}" method="POST">
    @csrf
    <input type="text" name="api_url" value="{{ old('api_url') }}">

    {{-- <button type="submit">Submit</button> --}}
    <!-- Back Button -->
    <button type="button" onclick="history.back();">Go Back</button>
</form>
