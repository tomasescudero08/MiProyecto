<x-app-layout>
    <div class="container my-5 text-white">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card p-4 shadow-lg border-0" style="background-color: #1a1a1a; border: 1px solid #333 !important;">
                    <h2 class="fw-bold mb-4 text-center" style="color: #d4af37;">Déjanos tu Experiencia</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="guest_name" class="form-label">Tu Nombre *</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="guest_name" name="guest_name" required value="{{ old('guest_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="guest_email" class="form-label">Correo Electrónico (Opcional)</label>
                            <input type="email" class="form-control bg-dark text-white border-secondary" id="guest_email" name="guest_email" value="{{ old('guest_email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Calificación (Estrellas) *</label>
                            <select class="form-select bg-dark text-white border-secondary" id="rating" name="rating" required>
                                <option value="5">★★★★★ (5 - Excelente)</option>
                                <option value="4">★★★★☆ (4 - Muy bueno)</option>
                                <option value="3">★★★☆☆ (3 - Bueno)</option>
                                <option value="2">★★☆☆☆ (2 - Regular)</option>
                                <option value="1">★☆☆☆☆ (1 - Malo)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Tu Opinión / Comentario *</label>
                            <textarea class="form-control bg-dark text-white border-secondary" id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="btn w-100 text-dark fw-bold py-2" style="background-color: #d4af37;">Publicar Reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
