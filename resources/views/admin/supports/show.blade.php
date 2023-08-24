<h1>Detalhes da dúvida {{ $support->id }}</h1>

<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }}</li>
    <li>Detalhes: {{ $support->body }}</li>
</ul>

<form action="{{ route('supports.destroy', $support->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Deletar</button>
</form>
