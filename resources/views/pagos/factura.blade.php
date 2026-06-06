<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Hospedaje #{{ $pago->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        .invoice-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .header-table td {
            vertical-align: top;
        }
        .brand-title {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .company-details {
            font-size: 11px;
            color: #666;
        }
        .invoice-title {
            text-align: right;
            text-transform: uppercase;
            color: #555;
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .invoice-number {
            text-align: right;
            font-size: 18px;
            color: #22c55e;
            font-weight: bold;
            margin-top: 5px;
        }
        .invoice-date {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .divider {
            border-top: 2px solid #1e3a8a;
            margin-bottom: 25px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table td {
            width: 50%;
            vertical-align: top;
        }
        .section-heading {
            font-size: 11px;
            text-transform: uppercase;
            color: #999;
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }
        .info-profile {
            font-size: 13px;
        }
        .info-profile strong {
            color: #111;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #1f2937;
            color: #ffffff;
            text-align: left;
            padding: 10px;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }
        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }
        .items-table tr:nth-child(even) td {
            background-color: #f9fafb;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .totals-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .totals-table td {
            padding: 6px 10px;
            font-size: 13px;
        }
        .totals-label {
            text-align: right;
            color: #666;
        }
        .totals-value {
            text-align: right;
        }
        .grand-total-row td {
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .grand-total-label {
            color: #111;
        }
        .grand-total-value {
            color: #16a34a;
        }
        .payment-method-badge {
            display: inline-block;
            background-color: #f3f4f6;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            text-transform: uppercase;
            color: #4b5563;
            margin-top: 15px;
            border: 1px solid #e5e7eb;
        }
        .footer {
            margin-top: 70px;
            text-align: center;
            color: #9ca3af;
            font-size: 11px;
            clear: both;
            border-top: 1px dashed #e5e7eb;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <table class="header-table">
        <tr>
            <td>
                <div class="brand-title">Grand Hotel</div>
                <div class="company-details">
                    NIT: 900.123.456-7<br>
                    Calle Principal #12-34<br>
                    Contacto: info@grandhotel.com
                </div>
            </td>
            <td>
                <div class="invoice-title">Factura de Venta</div>
                <div class="invoice-number">FAC-00{{ $pago->id }}</div>
                <div class="invoice-date">
                    <strong>Emisión:</strong> {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y h:i A') }}
                </div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <table class="details-table">
        <tr>
            <td>
                <div class="section-heading">Datos del Cliente / Huésped</div>
                <div class="info-profile">
                    <strong>Nombre:</strong> {{ $pago->reserva->cliente->nombre }}<br>
                    <strong>Identificación:</strong> {{ $pago->reserva->cliente->identificacion ?? 'No registrada' }}<br>
                    <strong>Correo Electrónico:</strong> {{ $pago->reserva->cliente->correo ?? 'N/A' }}
                </div>
            </td>
            <td style="padding-left: 40px;">
                <div class="section-heading">Detalles del Registro de Alojamiento</div>
                <div class="info-profile">
                    <strong>Código Reserva:</strong> #RES-00{{ $pago->reserva_id }}<br>
                    <strong>Fecha Entrada (Check-In):</strong> {{ \Carbon\Carbon::parse($pago->reserva->fecha_entrada)->format('d/m/Y') }}<br>
                    <strong>Fecha Salida (Check-Out):</strong> {{ \Carbon\Carbon::parse($pago->reserva->fecha_salida)->format('d/m/Y') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
        <tr>
            <th style="width: 50%;">Descripción del Servicio</th>
            <th class="text-center" style="width: 15%;">Habitación</th>
            <th class="text-center" style="width: 15%;">Huéspedes</th>
            <th class="text-right" style="width: 20%;">Precio por Noche</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <strong>Servicio de Hospedaje Hotelero</strong><br>
                <span style="font-size: 11px; color:#666;">Estancia desde el {{ \Carbon\Carbon::parse($pago->reserva->fecha_entrada)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($pago->reserva->fecha_salida)->format('d/m/Y') }}</span>
            </td>
            <td class="text-center">#{{ $pago->reserva->habitacion->numero }}</td>
            <td class="text-center">{{ $pago->reserva->num_huespedes }}</td>
            <td class="text-right">${{ number_format($pago->reserva->habitacion->precio, 2) }}</td>
        </tr>
        </tbody>
    </table>

    <div>
        <div style="float: left; width: 50%;">
            <div class="payment-method-badge">
                <strong>Forma de pago:</strong> {{ $pago->metodo_pago }}
            </div>
        </div>

        <table class="totals-table">
            <tr>
                <td class="totals-label">Subtotal:</td>
                <td class="totals-value">${{ number_format($pago->monto, 2) }}</td>
            </tr>
            <tr>
                <td class="totals-label">IVA (0% - Exento):</td>
                <td class="totals-value">$0.00</td>
            </tr>
            <tr class="grand-total-row">
                <td class="totals-label grand-total-label">Total Pagado:</td>
                <td class="totals-value grand-total-value">${{ number_format($pago->monto, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p style="margin-bottom: 5px;">¡Gracias por hospedarse en el Grand Hotel! Su comodidad es nuestra máxima prioridad.</p>
        <p style="margin-top: 0; font-size: 9px; color: #bcbcbc;">Documento electrónico simplificado generado con fines estrictamente académicos.</p>
    </div>
</div>

</body>
</html>
