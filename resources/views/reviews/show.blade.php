@extends('layouts.app')

@section('content')
    <div class="container my-5 text-white">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg border-0" style="background-color: #1a1a1a; border: 1px solid #333 !important;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0" style="color: #d4af37;">Detalle de la Reseña</h3>
                        <a href="{{ route('reviews.index') }}" class="btn btn-outline-light btn-sm">Volver al listado</a>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted d-block">Huésped:</label>
                        <h5 class="fw-bold">{{ $review->guest_name }} <small class="text-muted fs-6">({{ $review->guest_email ?? 'Sin email' }})</small></h5>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted d-block">Ítem Evaluado:</label>
                        <p class="fw-semibold">
                            @if($review->room) Habitación: {{ $review->room->title }}
                            @elseif($review->service) Servicio: {{ $review->service->name }}
                            @else General / Hotel @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted d-block">Calificación:</label>
                        <div class="fs-4 text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating) ★ @else ☆ @endif
                            @endfor
                            <span class="text-white fs-6 ms-2">({{ $review->rating }}.0 / 5.0)</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted d-block">Comentario:</label>
                        <div class="p-3 rounded bg-dark border border-secondary text-light">
                            &ldquo;{{ $review->comment }}&rdquo;
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                        <small class="text-muted">Fecha de publicación: {{ $review->created_at->format('d/m/Y H:i') }}</small>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta reseña?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar Reseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
