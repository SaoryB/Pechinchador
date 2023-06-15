<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Produtos</title>
</head>
<body>
    <h1>Relatório de Produtos</h1>
    <hr>
    <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
        @forelse ($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhum produto cadastrado</td>
            </tr>
        @endforelse
    </table>
</body>
</html>
