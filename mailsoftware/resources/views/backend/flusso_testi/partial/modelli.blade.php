<div class="col-sm-3 col-md-3">
    <div class="mb-8 d-flex flex-column">
        <div class="form-group">
            <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modelli</label>
            <select class="form-control" name="type_id" id="type_id">
                @foreach(session()->get('types') as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
