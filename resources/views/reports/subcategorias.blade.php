<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Subcategorias</title>
</head>
<body>
    <h1>Relatório de Subcategorias</h1>
    <hr>
    <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
        </tr>
        @forelse ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->id }}</td>
                <td>{{ $subcategoria->nome }}</td>
                <td>{{ $subcategoria->categoria->nome }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhuma categoria cadastrada</td>
            </tr>
        @endforelse
    </table>
</body>
</html>
