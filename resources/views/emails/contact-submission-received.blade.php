<h1>Nuovo contatto generico</h1>

<p><strong>Nome:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Budget:</strong> {{ $contact->budget ?: '-' }}</p>

<hr>

<p><strong>Messaggio:</strong></p>
<p>{{ $contact->message }}</p>

<hr>

<p><strong>IP:</strong> {{ $contact->ip_address ?: '-' }}</p>
<p><strong>User agent:</strong> {{ $contact->user_agent ?: '-' }}</p>
