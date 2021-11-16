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

use Firebase\JWT\JWT;

class JWTAuthenticator {

    private static $secretKey = 'T3sT$JWT';
    private static $encryptionType = ['HS256'];

    public static function createToken($data) {
        $time_now = time();
        $payload = array(
            'iat' => $time_now,
            'exp' => $time_now + (150000),
            'aud' => self::Aud(),
            'data' => $data,
            'app' => "Test JWT"
        );
        return JWT::encode($payload, self::$secretKey);
    }

    public static function verifyToken($token) {
        if (empty($token)) {
            throw new Exception("The token is empty.");
        }
        try {
            $decoded = JWT::decode(
                $token,
                self::$secretKey,
                self::$encryptionType
            );

        } catch (Exception $e) {
            throw $e;
        }
        if ($decoded->aud !== self::Aud()) {
            throw new Exception("User wrong");
        }
    }

    public static function getPayload($token) {
        if (empty($token)) {
            throw new Exception("The token is empty.");
        }
        return JWT::decode(
            $token,
            self::$secretKey,
            self::$encryptionType
        );
    }

    public static function getTokenData($token) {
        $array = JWT::decode(
            $token,
            self::$secretKey,
            self::$encryptionType
        )->data;
        return $array;
    }

    private static function Aud() {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}