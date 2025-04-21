<h4>💬 Discussion</h4>
<form method="POST" action="{{ route('tontine.messages.store', $tontine->id) }}">
    @csrf
    <textarea name="contenu" class="form-control" rows="3" placeholder="Votre message..."></textarea>
    <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
</form>

<hr>

@foreach($tontine->messages as $message)
    <div class="mb-3 border rounded p-2">
        <strong>{{ $message->user->prenom }} {{ $message->user->nom }}</strong>
        <span class="text-muted">({{ $message->created_at->diffForHumans() }})</span>
        <p>{{ $message->contenu }}</p>
    </div>
@endforeach
