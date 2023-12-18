<?php

namespace App\Controllers\b2b;

use App\Controllers\b2b\BaseController;
use App\Models\b2b\ClientModel;
use App\Models\b2b\FileModel;
use App\Models\UserModel;

define('FILE_ENCRYPTION_BLOCKS', 10000);

class Files extends BaseController
{
    protected $userModel = "";
    protected $fileModel = "";

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->fileModel = new FileModel();
    }

    public function index()
    {
        //
    }

    public function downloadBackUp($date, $id) {        
        $fileName = $date.'_backup.sql';
        $myfile = fopen($fileName, "w") or die("Unable to open file!");
        $txt = $date.'_'.$id;
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "oa";
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($txt, $ciphering,
        $encryption_key, $options, $encryption_iv);
        
        fwrite($myfile, $encryption);
        fclose($myfile);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($fileName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        flush();
        readfile($fileName);
    }

    public function restoreData() {
        $file = $this->request->getFile('file');        
        $openFile = $file->getPathname();
        // dd($openFile);
        $myfile = fopen($openFile, "r") or die("Unable to open file!");
        $txt = fread($myfile,filesize($openFile));        
        fclose($myfile);

        
        $decryption_iv = '1234567891011121';
        $options = 0;
        $ciphering = "AES-128-CTR";
        // Store the decryption key
        $decryption_key = "oa";
        
        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($txt, $ciphering,
                $decryption_key, $options, $decryption_iv);
        
        $arr = explode('_', $decryption);
        if (count($arr) > 0) {
            $this->fileModel->restoreData($arr[0]);                
            return redirect()->to(base_url('backup-and-restore'))->with('message', 'Sucess');    
        } else {
            return redirect()->to(base_url('backup-and-restore'))->with('fail', 'fail');    
        }
    }

    public function test() {
        $simple_string = "Welco\n";
        // Display the original string
        echo "Original String: " . $simple_string;
        
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "oa";
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($simple_string, $ciphering,
                    $encryption_key, $options, $encryption_iv);
        
        // Display the encrypted string
        echo "Encrypted String: " . $encryption . "\n";
        
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';
        
        // Store the decryption key
        $decryption_key = "oa";
        
        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($encryption, $ciphering,
                $decryption_key, $options, $decryption_iv);
        
        // Display the decrypted string
        echo "Decrypted String: " . $decryption;
        
        // $fileName = 'backup-.sql';
        // $myfile = fopen($fileName, "w") or die("Unable to open file!");
        // $txt = "John Doe\n";
        // fwrite($myfile, $txt);
        // fclose($myfile);
        // $this->encryptFile($fileName, $fileName, '112');
        // $this->decryptFile($fileName,  $fileName, '112');
    }

}
