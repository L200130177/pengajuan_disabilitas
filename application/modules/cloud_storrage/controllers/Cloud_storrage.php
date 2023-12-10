<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use CodeIgniter\Files\File;

class Cloud_storrage extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // check_not_validate();
        // check_not_login();
        $this->load->model(['Maintenance_m', 'cloud_storrage/Cloud_storrage_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $this->load->model('Maintenance_m');
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $data = [
                'title'         => 'Upload',
                'description'   => 'File',
                'content'       => 'cloud_storrage/cloud_data' //user adalah nama module, user_data nama file di view yang akan di load
            ];
            // $this->template->index($data);
            $this->load->module('template');
            $this->template->index($data);
        }else{
            $this->load->view('maintenance');
        }
	}

    public function tampil()
    {
        $asd = $this->Cloud_storrage_m->get()->result();
        $owner = $asd[0]->ref_owner;
        $pos = strpos($owner, "_");
        $hapus_uniq = substr($owner,0,$pos+1);
        $nama_owner = str_replace($hapus_uniq,"",$owner);
        var_dump($nama_owner);
        die();
    }

    public function upload_old()
    {
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $bucket_name = getenv('MINIO_BUCKET');
        $data = array(
            'inputor' 	=> uniqid() . "_" . htmlentities($this->input->post('nama_lengkap')),
            'date' 	=> date("F-Y"),
            'file_name1'    => uniqid() . "_" . $_FILES['ref_file1']['name'],
            'file_name2'    => uniqid() . "_" . $_FILES['ref_file2']['name'],
            'file_tmp1'   => $_FILES['ref_file1']['tmp_name'],
            'file_tmp2'   => $_FILES['ref_file2']['tmp_name'],
        );
        // var_dump($data);
        // die();
        // $this->Cloud_storrage_m->add($data);
        // if($this->db->affected_rows()>0){
            if($a == 1){
                try {
                    $s3client->putObject([
                        'Bucket' => $bucket_name,
                        'Key' => $data['date'] . "/" . $data['inputor'] . "/" . $data['file_name1'],
                        'SourceFile' => $data['file_tmp1']
                    ]);
                    echo "Uploaded to $bucket_name.\n";
                } catch (Exception $exception) {
                    echo "Failed to upload with error: " . $exception->getMessage();
                    exit("Please fix error with file upload before continuing.");
                }
            }
            try {
                $s3client->putObject([
                    'Bucket' => $bucket_name,
                    'Key' => $data['date'] . "/" . $data['inputor'] . "/" . $data['file_name1'],
                    'SourceFile' => $data['file_tmp1']
                ]);
                echo "Uploaded to $bucket_name.\n";
            } catch (Exception $exception) {
                echo "Failed to upload with error: " . $exception->getMessage();
                exit("Please fix error with file upload before continuing.");
            }
    
            // try {
            //     $s3client->putObject([
            //         'Bucket' => $bucket_name,
            //         'Key' => $data['date'] . "/" . $data['inputor'] . "/" . $data['file_name2'],
            //         'SourceFile' => $data['file_tmp2']
            //     ]);
            //     echo "Uploaded to $bucket_name.\n";
            // } catch (Exception $exception) {
            //     echo "Failed to upload with error: " . $exception->getMessage();
            //     exit("Please fix error with file upload before continuing.");
            // }
        // }
        // var_dump($data);
        // die();
        // $inputor = uniqid() . "_" . $this->input->post('nama_lengkap');
        // $date = date("F-Y");
        // $file_name1  =  uniqid() . "_" . $_FILES['ref_file1']['name'];
        // $file_tmp1   = $_FILES['ref_file1']['tmp_name'];
        // $file_name2  =  uniqid() . "_" . $_FILES['ref_file2']['name'];
        // $file_tmp2   = $_FILES['ref_file2']['tmp_name'];

    }

    public function upload_minio_multiple(){
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $bucket_name = getenv('MINIO_BUCKET');
        $inputor = uniqid() . "_" . $this->input->post('nama_lengkap');
        $date = date("F-Y");

        foreach ($_FILES['urlfile']['tmp_name'] as $key => $tmp_name) {
            $file_name  =  uniqid() . "_" . $_FILES['urlfile']['name'][$key];
            $file_tmp   = $_FILES['urlfile']['tmp_name'][$key];
            $fileSize   = $_FILES['urlfile']['size'][$key];

            try {
                $s3client->putObject([
                    'Bucket' => $bucket_name,
                    'Key' => $date . "/" . $inputor . "/" . $file_name,
                    'SourceFile' => $file_tmp
                ]);
                echo "Uploaded $file_name to $bucket_name.\n";
            } catch (Exception $exception) {
                echo "Failed to upload $file_name with error: " . $exception->getMessage();
                exit("Please fix error with file upload before continuing.");
            }
        }
    }

    public function list_minio()
    {
        $data = [
            'title'         => 'List',
            'description'   => 'Minio',
            'content'       => 'cloud_storrage/cloud_list',
        ];
        $this->load->module('template');
        $this->template->index($data);

    }

    public function list_minio_new()
    {
        $data = array();
        $no = @$_POST['start'];
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);
        $bucket_name = getenv('MINIO_BUCKET');
            try {
                $contents = $s3client->listObjects([
                    'Bucket' => $bucket_name,
                ]);
                foreach ($contents['Contents'] as $content) {
                    $no++;
                    $row = array();
                    $row[] = $no.".";
                    $row[] =  $content['Key'];
                    $row[] = '<button type="button" title="download" class="btn btn-success btn-xs" onclick="byid(' . $content['Key'] . ')">
                        <i class="fa fa-download"></i> Download
                        </button>';
                    $data[] = $row;
                }
            } catch (Exception $exception) {
                echo "Failed to list objects in $bucket_name with error: " . $exception->getMessage();
                exit("Please fix error with listing objects before continuing.");
            }

            $output = array(
                "draw" => @$_POST['draw'],
                "data" => $data,
            );
            echo json_encode($output);
    }

    public function list_minio_v2()
    {
        $data = array();
        $no = @$_POST['start'];
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $bucket = getenv('MINIO_BUCKET');
        try {
            $results = $s3client ->getPaginator('ListObjects', [
                'Bucket' => $bucket
            ]);
        
            foreach ($results as $result) {
                foreach ($result['Contents'] as $object) {
                    echo $object['Key'] . PHP_EOL;
                }
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
        // var_dump($results['Contents']);
        // die();
        
        // Use the plain API (returns ONLY up to 1000 of your objects).
        try {
            $objects = $s3client ->listObjectsV2([
                'Bucket' => $bucket,
                'Delimiter'=>'/',
                'Prefix' => 'December-2023/dani_1234567890123451'
            ]);
            foreach ($objects['Contents']  as $object) {
                echo $object['Key'] . PHP_EOL;
                $no++;
                $row = array();
                $row[] = $no.".";
                $row[] =  $object['Key'] . PHP_EOL;
                // $row[] = '<button type="button" title="download" class="btn btn-success btn-xs">
                //     <i class="fa fa-download"></i> Download
                //     </button>';
                $data[] = $row;
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
        
        $output = array(
            "draw" => @$_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);

    }

    public function download_minio()
    {
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);
        $bucket_name = getenv('MINIO_BUCKET');
        $file_name = "November-2023/6554e455cd55e_nathan/6554e455cd56c_wallpaperflare.com_wallpaper (1).jpg";
        try {
            $file = $s3client->getObject([
                'Bucket' => $bucket_name,
                'Key' => $file_name,
            ]);
            $body = $file->get('Body');
            $body->rewind();
            echo "Downloaded the file and it begins with: {$body->read(26)}.\n";
        } catch (Exception $exception) {
            echo "Failed to download $file_name from $bucket_name with error: " . $exception->getMessage();
            exit("Please fix error with file downloading before continuing.");
        }

    }

    public function download_folder()
    {

        $myDirectoryName = 'dinsos/Desember-2023/dani_1234567890123451';
        // include dirname(__FILE__) . '/aws.phar';
        // $baseDirectory = dirname(__FILE__) .'/'.$myDirectoryName;

        //Create a S3Client
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $s3client->registerStreamWrapper();
        
        $bucket = getenv('MINIO_ENDPOINT') . $myDirectoryName;
        $key = "65377578c8993_response.txt";
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($bucket),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach($iterator as $name => $object) {
            if ($object->getFileName() !== '.' && $object->getFileName() !== '..') {
                $relative = substr($name,strlen($bucket)+1);
                if (!file_exists($myDirectoryName . '/' . $path . '/' . $relative)) {
                    if ($object->isDir()) {
                        mkdir($myDirectoryName . '/' . $path . '/' . $relative, 0777, true);
                    } else {
                        file_put_contents(
                            $myDirectoryName . '/' . $path . '/' . $relative,
                            file_get_contents($name)
                        );
                    }
                }
            }
        }
        
        // try {
        //     // Save object to a file.
        //     $result = $s3Client->getObject(array(
        //         'Bucket' => $bucket,
        //         'Key' => $key,
        //         'SaveAs' => $key
        //     ));
        // } catch (S3Exception $e) {
        //     echo $e->getMessage() . "\n";
        // }
         
         
    }

    public function download_zip()
    {

        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);
        // $bucket = 'dinsos';
        // $key = 'December-2023';
        // $coba = $s3client->getObjectUrl($bucket, $key);
        // var_dump($coba);
        // die();

        $s3client->registerStreamWrapper();

        // make sure to send all headers first
        // Content-Type is the most important one (probably)
        //
        header('Content-Type: application/octet-stream');
        header('Content-disposition: attachment; filename="file.zip"');

        // use popen to execute a unix command pipeline
        // and grab the stdout as a php stream
        // (you can use proc_open instead if you need to 
        // control the input of the pipeline too)
        //
        $fp = popen('zip -r - http://103.169.233.45:9000/dinsos/December-2023/dani_1234567890123451/656b5ba479b9e_maintain.png http://103.169.233.45:9000/dinsos/December-2023/dani_1234567890123451/WhatsApp Image 2023-09-08 at 18.59.46.jpg', 'r');

        // pick a bufsize that makes you happy (8192 has been suggested).
        $bufsize = 8192;
        $buff = '';
        while( !feof($fp) ) {
        $buff = fread($fp, $bufsize);
        echo $buff;
        }
        pclose($fp);
    }

    public function list_download()
    {
        $nama = 'December-2023/dani_1234567890123451.zip';
        $s3 = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => getenv('MINIO_ENDPOINT'),
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $s3->registerStreamWrapper();
        $zip = new ZipArchive;
        $zip->open('dani_1234567890123459.zip', ZipArchive::CREATE);
        $bucket = 'dinsos';
        $prefix = 'December-2023/dani aditya_1234567890123459'; // ex.: 'image/test/folder/'
        $objects = $s3->getIterator('ListObjects', array(
            'Bucket' => $bucket,
            'Prefix' => $prefix
        ));
        foreach ($objects as $object) {
            $contents = file_get_contents("s3://{$bucket}/{$object['Key']}"); // get file
            $zip->addFromString($object['Key'], $contents); // add file contents in zip
        }
        $zip->close();
        // Download de zip file
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        // header("Content-Disposition: attachment; filename=$nama"); 
        header("Content-disposition: attachment; filename=\"dani_1234567890123459.zip\"");
        readfile ('dani_1234567890123459.zip');

    }

}
