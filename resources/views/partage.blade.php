<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta property="og:title" content="Nom : {{ $demande->name ?? 'Inconnu' }}" />
    <meta property="og:description" content="{{ $demande->description }}" />
    <meta property="og:image" content="{{ $demande->image  }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="{{ url('https://www.nouwiwa.com/detailevents/' . $demande->id) }}" />
    <meta property="og:type" content="article" />
    <title>{{ $demande->name ?? 'Inconnu' }}</title>
</head>
<body>
    <script>
        window.location.href = "{{ url('https://www.nouwiwa.com/detailevents/' . $demande->id) }}";
    </script>
    {{-- <img src="{{ $demande->image ?? asset('default.jpg') }}" alt="Logo"
    > --}}
</body>
</html>
