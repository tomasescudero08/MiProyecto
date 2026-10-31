<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ServiceController extends Controller
{
    // Método para mostrar el catálogo público de servicios
    public function catalogue()
    {
        $services = Service::latest()->get();
        return view('service_catalogue', compact('services'));
    }

// 2. Método para la GESTIÓN DE ADMINISTRACIÓN (Tu tabla con Editar/Eliminar)
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * GET /services/create -> Mostrar formulario de creación
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * POST /services -> Guardar el nuevo servicio
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'icon'        => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create([
            'name'        => $request->name,
            'icon'        => $request->icon ?? '✦',
            'description' => $request->description,
            'price'       => $request->price,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('services.index')->with('success', 'Servicio creado con éxito.');
    }

    /**
     * GET /services/{service} -> Ver un servicio
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * GET /services/{service}/edit -> Mostrar formulario de edición
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * PUT /services/{service} -> Guardar los cambios
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'icon'        => 'nullable|string',
        ]);

        $service->update([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
            'price'       => $request->price,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('services.index')->with('success', 'Servicio actualizado con éxito.');
    }

    /**
     * DELETE /services/{service} -> Eliminar
     */
    public function destroy(Service $service)
    {
        $service->rooms()->detach(); // Limpia la tabla pivote antes de borrar
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Servicio eliminado con éxito.');
    }
}
