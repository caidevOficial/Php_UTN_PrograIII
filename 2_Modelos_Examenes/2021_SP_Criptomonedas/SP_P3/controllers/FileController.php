<?php
/**
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * You should have received a copy of the MIT license
 * along with this program.  If not, see <https://opensource.org/licenses/MIT>.
 *
 * @author Facundo Falcone <CaidevOficial> 
 */

use Fpdf\Fpdf;
require_once './models/Sale.php';

class FileController extends Sale{
    
    public function CreatePDF($request, $response, $args) {
        
        $sales = Sale::getAllEntities();
        var_dump($sales);
        if ($sales) {
            $pdf = new FPDF();
            $pdf->AddPage();

            //tipo de letra del pdf 'arial black'
            $pdf->SetFont('Arial', 'B', 25);

            // titulo principal del pdf
            $pdf->Cell(160, 15, 'SPP3', 1, 3, 'L');
            $pdf->Ln(3);

            $pdf->SetFont('Arial', '', 15);

            // titulo secundario del pdf
            $pdf->Cell(60, 4, 'Facundo Falcone', 0, 1, 'L');
            $pdf->Cell(20, 0, '', 'T');
            $pdf->Ln(3);
            
            // titulo de la tabla
            $pdf->Cell(60, 4, 'Facundo Falcone', 0, 1, 'L');
            $pdf->Cell(15, 0, '', 'T');
            $pdf->Ln(5);

            // Columnas de la clase venta
            $header = array('ID', 'DATE', 'CRYPTO_NAME', 'AMOUNT', 'CUSTOMER', 'USER', 'IMAGE');
            
            // colores RGB del fondo de las filas de la tabla del pdf
            $pdf->SetFillColor(125, 0, 0);
            $pdf->SetTextColor(125);
            $pdf->SetDrawColor(50, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 8);
            $w = array(20, 30, 30, 30, 40, 30);
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            }
            $pdf->Ln();

            // Colores de los bordes de las filas de la tabla del pdf en rgb
            $pdf->SetFillColor(215, 209, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            $fill = false;

            // Header
            foreach ($sales as $sale) { // cada una de las columnas de la clase venta
                $pdf->Cell($w[0], 6, $sale->getId(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[1], 6, $sale->getdate(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[2], 6, $sale->getCryptoName(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[3], 6, $sale->getAmount(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[4], 6, $sale->getCustomer(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[5], 6, $sale->getUser(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[6], 6, $sale->getImage(), 'LR', 0, 'C', $fill);
                
                $pdf->Ln();
                $fill = !$fill;
            }
            $pdf->Cell(array_sum($w), 0, '', 'T');

            // ruta del pdf, hay que crear el directorio manualmente
            $pdf->Output('F', './MyFiles/' . $sale->getCustomer() .'.pdf', 'I');

            // ruta del pdf, hay que crear el directorio manualmente
            $payload = json_encode(array("message" => 'pdf created ./MyFiles/' . $sale->getCustomer() .'.pdf'));
        } else {
            $payload = json_encode(array("error" => 'error getting data'));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    
}
?>