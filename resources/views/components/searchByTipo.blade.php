<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <a href="{{ $create }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle "></i> Crear {{ $module }}
            </a>
        </div>
    </div>
    <form action="{{ $index }}" method="GET" novalidate id="formSearch">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <select name="tipo" class="form-control" id="exampleFormControlSelect1">
                        <option>Buscar por tipo</option>
                        <option>Anfitrion</option>
                        <option>Instructor</option>
                    </select>
                    <input class="form-control" type="text" name="Buscar" placeholder="Buscar por" value="{{ old('Buscar') }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i> Buscar</button>
                        <button class="btn btn-default btn-sm" type="button" id="getAll"><i class="fas fa-sync-alt"></i> Todos</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>