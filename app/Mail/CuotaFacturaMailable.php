<?php
namespace App\Mail;

use App\Models\Cuota;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CuotaFacturaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $cuota;

    /**
     * Create a new message instance.
     */
    public function __construct(Cuota $cuota)
    {
        $this->cuota = $cuota;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $pdf = Pdf::loadView('cuota.factura', ['cuota' => $this->cuota]);

        return $this->view('emails.cuota.factura')
                    ->subject('Factura de Cuota')
                    ->attachData($pdf->output(), 'factura_cuota_' . $this->cuota->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}