<div style="background-image: url('https://st2.depositphotos.com/1284918/6819/i/450/depositphotos_68193493-stock-photo-blue-mail-illustration.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center ;height: 100%; padding: 40px">
  <h1>Hai un nuovo messaggio da: {{$lead->email}}</h1>
  <h2 style="margin: 0"><strong>Nome completo: </strong>{{$lead->name}} {{$lead->surname}}</h2>
  <h3><strong>Email: </strong>{{$lead->email}}</h3>
  <p><strong>Messaggio: </strong><br>{{$lead->message}}</p>
</div>

