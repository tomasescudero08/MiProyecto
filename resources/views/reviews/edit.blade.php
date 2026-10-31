<x-app-layout>
    <div class="container my-5 text-white">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card p-4 shadow-lg border-0" style="background-color: #1a1a1a; border: 1px solid #333 !important;">
                    <h2 class="fw-bold mb-4 text-center" style="color: #d4af37;">Editar Reseña</h2>

                    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="guest_name" class="form-label">Nombre del Huésped</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="guest_name" name="guest_name" value="{{ old('guest_name', $review->guest_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="guest_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control bg-dark text-white border-secondary" id="guest_email" name="guest_email" value="{{ old('guest_email', $review->guest_email) }}">
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Calificación</label>
                            <select class="form-select bg-dark text-white border-secondary" id="rating" name="rating" required>
                                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>★★★★★ (5)</option>
                                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>★★★★☆ (4)</option>
                                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3)</option>
                                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2)</option>
                                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comentario</label>
                            <textarea class="form-control bg-dark text-white border-secondary" id="comment" name="comment" rows="4" required>{{ old('comment', $review->comment) }}</textarea>
                        </div>

                        <button type="submit" class="btn w-100 text-dark fw-bold py-2" style="background-color: #d4af37;">Actualizar Reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
