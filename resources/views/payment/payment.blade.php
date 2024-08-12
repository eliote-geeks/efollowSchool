<base href="/">
<x-layouts>

<form action="" method="post">
    <select class="form-control" name="" id="">
        <option value="">Selctionnner une scolarite</option>
        @foreach ($scolarites as $s)
       
        <option value="">{{ $s->name }}</option> 
        
        @endforeach
    </select>

    <option value="">montant</option>
</form>
</x-layouts>
