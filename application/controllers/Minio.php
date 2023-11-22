<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Minio extends MY_Controller {

    public function set_token()
	{
		$query = $this->db->query("
		SELECT user_id, activity
		FROM user
		WHERE NOW() >= activity + INTERVAL 2 HOUR");
		foreach($query->result() as $r){
			$this->db->set('remember_token', null);
			$this->db->where('user_id', $r->user_id);
			$this->db->update('user');
		}
	}
    public function get_minio(){
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => 'http://103.169.233.45:9000/',
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);
        $bucket_name = 'dinsos';
        $file_name = 'test.txt';

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

    public function upload_minio(){
        $s3client = new Aws\S3\S3Client([
            'region' => 'us-west-2', 
            'version' => 'latest',
            'endpoint' => 'http://103.169.233.45:9000/',
            'useSSL' => false,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('MINIO_ACCESS_KEY'),
                'secret' => getenv('MINIO_SECRET_KEY'),
        ],
        ]);

        $bucket_name = 'dinsos';
        $file_name = "local-file-" . uniqid();
        try {
            $s3client->putObject([
                'Bucket' => $bucket_name,
                'Key' => $file_name,
                'SourceFile' => 'testfile.txt'
            ]);
            echo "Uploaded $file_name to $bucket_name.\n";
        } catch (Exception $exception) {
            echo "Failed to upload $file_name with error: " . $exception->getMessage();
            exit("Please fix error with file upload before continuing.");
        }


    }

}
