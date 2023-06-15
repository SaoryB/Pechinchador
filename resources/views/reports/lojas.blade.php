<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Lojas</title>
</head>
<body>
    <h1>Relatório de Lojas</h1>
    <hr>
    <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
        @forelse ($lojas as $loja)
            <tr>
                <td>{{ $loja->id }}</td>
                <td>{{ $loja->nome }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhuma loja cadastrada</td>
            </tr>
        @endforelse
    </table>
</body>
</html>
