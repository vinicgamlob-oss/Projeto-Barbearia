<h1>Novo Agendamento!</h1>
<p>Um novo agendamento foi realizado com sucesso.</p>
<ul>
    <li>Cliente: {{ $scheduling->client->user->name }}</li>
    <li>Data Início: {{ $scheduling->start_date }}</li>
    <li>Data Fim: {{ $scheduling->end_date }}</li>
</ul>