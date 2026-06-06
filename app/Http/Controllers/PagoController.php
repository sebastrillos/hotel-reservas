<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Reserva;
use Carbon\Carbon;
// IMPORTANTE: Agregamos el alias de la librería PDF de DomPDF
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Muestra el listado histórico de pagos / caja.
     */
    public function index()
    {
        $pagos = Pago::with('reserva.cliente')->orderBy('id', 'desc')->get();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Muestra el formulario para registrar un pago.
     */
    public function create()
    {
        $reservaciones = Reserva::with('cliente')
            ->where('estado', '!=', 'cancelada')
            ->get();

        return view('pagos.create', compact('reservaciones'));
    }

    /**
     * Almacena el pago en la base de datos de forma automática.
     */


    /**
     * Muestra los detalles de un pago específico.
     */
    public function show(string $id)
    {
        // Vacio
    }

    /**
     * Muestra el formulario para editar un pago existente.
     */
    public function edit(string $id)
    {
        $pago = Pago::findOrFail($id);
        $reservaciones = Reserva::with('cliente')->get();

        return view('pagos.edit', compact('pago', 'reservaciones'));
    }

    /**
     * Actualiza un registro de pago.
     */
    /**
     * Almacena el pago en la base de datos de forma automática.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reserva_id'  => 'required|exists:reservas,id',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
            'referencia'  => 'nullable|string|max:100', // Validamos el campo nuevo
        ]);

        $reserva = Reserva::findOrFail($request->reserva_id);
        $montoTotal = $reserva->total;

        $pago = new Pago();
        $pago->reserva_id   = $request->reserva_id;
        $pago->monto        = $montoTotal;
        $pago->metodo_pago  = $request->metodo_pago;
        $pago->fecha_pago   = Carbon::now()->format('Y-m-d H:i:s');

        // ASIGNACIÓN DE REFERENCIA: Si viene vacía, guardamos un texto por defecto para evitar el error de MySQL
        $pago->referencia   = $request->referencia ?? 'N/A (Efectivo)';

        $pago->save();

        if ($reserva->estado == 'pendiente') {
            $reserva->estado = 'confirmada';
            $reserva->save();
        }

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago procesado correctamente por un valor de $' . number_format($montoTotal, 2));
    }

    /**
     * Actualiza un registro de pago en caso de correcciones de auditoría.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'reserva_id'  => 'required|exists:reservas,id',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
            'referencia'  => 'nullable|string|max:100',
        ]);

        $reserva = Reserva::findOrFail($request->reserva_id);

        $pago = Pago::findOrFail($id);
        $pago->reserva_id   = $request->reserva_id;
        $pago->monto        = $reserva->total;
        $pago->metodo_pago  = $request->metodo_pago;
        $pago->referencia   = $request->referencia ?? 'N/A (Efectivo)';

        $pago->save();

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Registro de pago actualizado correctamente.');
    }

    /**
     * Elimina o anula un recibo de pago del historial.
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Registro de pago eliminado correctamente.');
    }

    /**
     * Genera y descarga el archivo PDF real de la factura usando DomPDF.
     */
    public function generarFactura($id)
    {
        $pago = Pago::with(['reserva.cliente', 'reserva.habitacion'])->findOrFail($id);

        // Cargamos la vista de la factura pasándole los datos
        $pdf = Pdf::loadView('pagos.factura', compact('pago'));

        // Configuración opcional para asegurar tamaño carta y orientación vertical
        $pdf->setPaper('letter', 'portrait');

        // Descarga el archivo con un nombre dinámico limpio
        $nombreArchivo = 'Factura_Hospedaje_No_' . $pago->id . '.pdf';
        return $pdf->stream($nombreArchivo);
        // Nota: Si prefieres que se descargue directo en vez de abrir en el navegador, cambia ->stream por ->download
    }
}
