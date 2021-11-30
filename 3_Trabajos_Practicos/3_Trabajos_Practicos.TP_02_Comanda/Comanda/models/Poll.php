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

class Poll {
    public $id;
    public $order_id;
    public $table_score;
    public $resto_score;
    public $waitress_score;
    public $cheff_score;
    public $average_score;
    public $comment;

    public function __construct() {}

    /**
     * Creates a poll Object.
     * @param int $order_id The order id associated with the poll.
     * @param int $table_score The score of the table.
     * @param int $resto_score The score of the resto.
     * @param int $waitress_score The score of the waitress.
     * @param int $cheff_score The score of the cheff.
     * @param string $comment The comment of the user experience in the restaurant.
     * @return Poll The poll object.
     */
    public static function createPoll($order_id, $table_score, $resto_score, $waitress_score, $cheff_score, $comment) {
        $poll = new Poll();
        $poll->setOrderId($order_id);
        $poll->setTableScore($table_score);
        $poll->setRestoScore($resto_score);
        $poll->setWaitressScore($waitress_score);
        $poll->setCheffScore($cheff_score);
        $poll->setAverageScore();
        $poll->setComment($comment);

        return $poll;
    }

    //--- Getters ---//
    
    /**
     * Gets the id of the poll.
     *
     * @return int The id of the poll.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gets the order_id of the poll.
     *
     * @return int The order_id of the poll.
     */
    public function getOrderId() {
        return $this->order_id;
    }

    /**
     * Gets the table score of the poll.
     *
     * @return int The table score of the poll.
     */
    public function getTableScore() {
        return $this->table_score;
    }

    /**
     * Gets the resto score of the poll.
     *
     * @return int The resto score of the poll.
     */
    public function getRestoScore() {
        return $this->resto_score;
    }

    /**
     * Gets the waitress score of the poll.
     *
     * @return int The waitress score of the poll.
     */
    public function getWaitressScore() {
        return $this->waitress_score;
    }

    /**
     * Gets the cheff score of the poll.
     *
     * @return int The cheff score of the poll.
     */
    public function getCheffScore() {
        return $this->cheff_score;
    }

    /**
     * Gets the average score of the poll.
     *
     * @return int The average score of the poll.
     */
    public function getAverageScore() {
        return $this->average_score;
    }

    /**
     * Gets the comment of the poll.
     *
     * @return string The comment of the poll.
     */
    public function getComment() {
        return $this->comment;
    }

    //--- Setters ---//

    /**
     * Sets the id of the poll.
     *
     * @param int $id The id of the poll.
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Sets the order_id of the poll.
     *
     * @param int $order_id The order_id of the poll.
     */
    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }

    /**
     * Sets the table score of the poll.
     *
     * @param int $table_score The table score of the poll.
     */
    public function setTableScore($table_score) {
        $this->table_score = $table_score;
    }

    /**
     * Sets the resto score of the poll.
     *
     * @param int $resto_score The resto score of the poll.
     */
    public function setRestoScore($resto_score) {
        $this->resto_score = $resto_score;
    }

    /**
     * Sets the waitress score of the poll.
     *
     * @param int $waitress_score The waitress score of the poll.
     */
    public function setWaitressScore($waitress_score) {
        $this->waitress_score = $waitress_score;
    }

    /**
     * Sets the cheff score of the poll.
     *
     * @param int $cheff_score The cheff score of the poll.
     */
    public function setCheffScore($cheff_score) {
        $this->cheff_score = $cheff_score;
    }

    /**
     * Sets the average score of the poll.
     *
     * @param int $average_score The average score of the poll.
     */
    public function setAverageScore() {
        $average = 0;
        $arraySum = array($this->table_score, $this->resto_score, $this->waitress_score, $this->cheff_score);
        if(count($arraySum) > 0) {
            $average = round(array_sum($arraySum) / count($arraySum), 2, PHP_ROUND_HALF_EVEN);
        }
        $this->average_score = $average; 
    }

    /**
     * Sets the comment of the poll.
     *
     * @param string $comment The comment of the poll.
     */
    public function setComment($comment) {
        $this->comment = $comment;
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Poll Data</caption>';
        echo "<th>[POLL_ID]</th><th>[ORDER_ID]</th><th>[TABLE_SCORE]</th><th>[RESTO_SCORE]</th><th>[WAITRESS_SCORE]</th><th>[CHEFF_SCORE]</th><th>[AVERAGE_SCORE]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getId()."]</td>";
        echo "<td>[".$this->getOrderId()."]</td>";
        echo "<td>[".$this->getTableScore()."]</td>";
        echo "<td>[".$this->getRestoScore()."]</td>";
        echo "<td>[".$this->getWaitressScore()."]</td>";
        echo "<td>[".$this->getCheffScore()."]</td>";
        echo "<td>[".$this->getAverageScore()."]</td>";
        echo "</tr>";
        echo "<th colspan='7' align='center'>[COMMENT]</th>";
        echo "<tr>";
        echo "<td colspan='7' align='center'>[".$this->getComment()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Employees objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Polls List</caption>';
        echo "<th>[POLL_ID]</th><th>[ORDER_ID]</th><th>[TABLE_SCORE]</th><th>[RESTO_SCORE]</th><th>[WAITRESS_SCORE]</th><th>[CHEFF_SCORE]</th><th>[AVERAGE_SCORE]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getOrderId()."]</td>";
            echo "<td>[".$entity->getTableScore()."]</td>";
            echo "<td>[".$entity->getRestoScore()."]</td>";
            echo "<td>[".$entity->getWaitressScore()."]</td>";
            echo "<td>[".$entity->getCheffScore()."]</td>";
            echo "<td>[<strong>".$entity->getAverageScore()."</strong>]</td>";
            echo "</tr>";
            echo "<th colspan='7' align='center'>[COMMENT]</th>";
            echo "<tr>";
            echo "<td colspan='7' align='center'>[".$entity->getComment()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Creates and downloads a pdf file with the info of the query.
     *
     * @param string $directory The directory where the file will be saved.
     * @param int $amountPolls The amount of the polls.
     * @return array $payload The info of the query.
     */
    public static function DownloadPdf($directory, $amountPolls){
        $polls = self::getBestPolls($amountPolls);
        if ($polls) {
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }


            $pdf = new FPDF();
            $pdf->AddPage();

            // Letter type size
            $pdf->SetFont('Arial', 'B', 25);

            // Main title of the pdf
            $pdf->Cell(160, 15, 'Comanda', 1, 3, 'L');
            $pdf->Ln(3);

            $pdf->SetFont('Arial', '', 15);

            // Secondary title of the pdf
            $pdf->Cell(60, 4, 'TP Final Programacion III', 0, 1, 'L');
            $pdf->Cell(60, 0, '', 'T');
            $pdf->Ln(3);
            
            // Title of the table
            $pdf->Cell(60, 4, 'Facundo Falcone', 0, 1, 'L');
            $pdf->Cell(40, 0, '', 'T');
            $pdf->Ln(5);

            // Columns of Poll Class
            $header = array('ID', 'ORDER', 'T_SCORE', 'R_SCORE', 'W_SCORE', 'C_SCORE', 'AVERAGE', 'COMMENT');
            
            // RGB colors of the table
            $pdf->SetFillColor(125, 0, 0);
            $pdf->SetTextColor(125);
            $pdf->SetDrawColor(50, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 8);
            $w = array(10, 12, 15, 15, 15, 15, 15, 92);
            
            // Writes the header of the columns except the last one
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            }
            $pdf->Ln();

            // Set the color of the text
            $pdf->SetFillColor(215, 209, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            $fill = false;

            foreach ($polls as $poll) {
                //* Every column except the last one
                $pdf->Cell($w[0], 6, $poll->getId(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[1], 6, $poll->getOrderId(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[2], 6, $poll->getTableScore(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[3], 6, $poll->getRestoScore(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[4], 6, $poll->getWaitressScore(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[5], 6, $poll->getCheffScore(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[6], 6, $poll->getAverageScore(), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[7], 6, $poll->getComment(), 'LR', 0, 'C', $fill);
                $pdf->Ln();
                $fill = !$fill;
            }

            $pdf->Cell(array_sum($w), 0, '', 'T');

            $newFilename = $directory.'Polls_' . date('Y_m_d') .'.pdf';
            $pdf->Output('F', $newFilename, 'I');

            $payload = json_encode(array("message" => 'pdf created ' . $newFilename));
        } else {
            $payload = json_encode(array("error" => 'error getting data'));
        }
        
        return $payload;
    }

    /**
     * Creates a new poll in the database.
     *
     * @param Poll $poll The poll to be created.
     * @return int The id of the created poll.
     */
    public static function insertPoll($poll){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('INSERT INTO `poll` (order_id, table_score, resto_score, waitress_score, cheff_score, average_score, comment) 
        VALUES (:order_id, :table_score, :resto_score, :waitress_score, :cheff_score, :average_score, :comment)');
        $query->bindValue(':order_id', $poll->getOrderId());
        $query->bindValue(':table_score', $poll->getTableScore());
        $query->bindValue(':resto_score', $poll->getRestoScore());
        $query->bindValue(':waitress_score', $poll->getWaitressScore());
        $query->bindValue(':cheff_score', $poll->getCheffScore());
        $query->bindValue(':average_score', $poll->getAverageScore());
        $query->bindValue(':comment', $poll->getComment());
        $query->execute();

        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Gets all the `poll` from the database.
     *
     * @return array An array of all the `poll`.
     */
    public static function getAll(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM `poll`');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Poll');
    }

    /**
     * Gets the Poll with the given ID.
     *
     * @param int $id The ID of the Poll to be retrieved.
     * @return Poll The Poll with the given ID.
     */
    public static function getPollById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM `poll` WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetchObject('Poll');
    }

    /**
     * Gets the best polls bassed on their average score.
     *
     * @param int $amount The amount of the best polls to be retrieved.
     * @return array An array of the best polls.
     */
    public static function getBestPolls($amount){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery(
            'SELECT * FROM `poll` 
            ORDER BY average_score DESC 
            LIMIT :amount');
        $query->bindParam(':amount', $amount);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Poll');
    }
}
?>