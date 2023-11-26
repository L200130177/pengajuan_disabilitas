<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Maintenance_m', 'pengajuan/Pengajuan_m']);
    }

	public function index()
	{
        $this->load->view('pengajuan');
	}

    public function submit()
    {
        $bucket_name = getenv('MINIO_BUCKET');
        $data_minio = array(
            'inputor' 	=> htmlentities($this->input->post('nama')) . "_" . htmlentities($this->input->post('nik')),
            'date' 	=> date("F-Y"),
            'file_name1'    => uniqid() . "_" . $_FILES['ref_file1']['name'],
            // 'file_name2'    => uniqid() . "_" . $_FILES['ref_file2']['name'],
            'file_tmp1'   => $_FILES['ref_file1']['tmp_name'],
            // 'file_tmp2'   => $_FILES['ref_file2']['tmp_name'],
        );
        $data = array(
            'email' 	                => htmlentities($this->input->post('email')),
            'nama' 	                    => htmlentities($this->input->post('nama')),
            'nik'                       => htmlentities($this->input->post('nik')),
            'umur'                      => htmlentities($this->input->post('umur')),
            'jenis_kelamin' 	        => htmlentities($this->input->post('jenis_kelamin')),
            'alamat_lengkap' 	        => htmlentities($this->input->post('alamat')),
            'agama' 	                => htmlentities($this->input->post('agama')),
            'anak_ke' 	                => htmlentities($this->input->post('anak_ke')),
            'pendidikan_terakhir' 	    => htmlentities($this->input->post('pendidikan_terakhir')),
            'status_pernikahan' 	    => htmlentities($this->input->post('status_pernikahan')),
            'pekerjaan' 	            => htmlentities($this->input->post('pekerjaan')),
            'jenis_layanan_diterima'    => htmlentities($this->input->post('jenis_layanan_diterima')) == 'LAINNYA' ? htmlentities($this->input->post('jenis_layanan_lainnya')) : htmlentities($this->input->post('jenis_layanan_diterima')),
            'jenis_kedisabilitasan'     => htmlentities($this->input->post('jenis_kedisabilitasan')),
            'no_telepon' 	            => htmlentities($this->input->post('no_telepon')),
            'program_rehabilitasi' 	    => htmlentities($this->input->post('program_rehabilitasi')),
            'nama_wali' 	            => htmlentities($this->input->post('nama_wali')),
            'alamat_wali' 	            => htmlentities($this->input->post('alamat_wali')),
            'pekerjaan_wali' 	        => htmlentities($this->input->post('pekerjaan_wali')),
            'penghasilan_wali' 	        => htmlentities($this->input->post('penghasilan')),
            'agama_wali' 	            => htmlentities($this->input->post('agama_wali')),
            'keluarga_wali' 	        => htmlentities($this->input->post('jumlah_anak')),
            'no_telepon_wali' 	        => htmlentities($this->input->post('nohp_wali')),
            'hubungan_ppks' 	        => htmlentities($this->input->post('hubungan_ppks')),
            'jenis_layanan' 	        => htmlentities($this->input->post('jenis_layanan')),
            'ref_file' 	                => $data_minio['file_name1'],
            );
        
        $check_nik = $this->db->get_where('pengajuan_disabilitas', array('nik' => $this->input->post('nik')))->row_array();
        // var_dump($check_nik);
        // die();

        if(isset($check_nik['nik']) != $this->input->post('nik')){
            $insert = $this->db->insert('pengajuan_disabilitas',$data);
            if($this->db->affected_rows()>0){
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
                    try {
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_name1'],
                            'SourceFile' => $data_minio['file_tmp1']
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
    
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil ditambahkan</div>');
                redirect('pengajuan');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>NIK sudah terdaftar</div>');
            redirect('pengajuan');
        }
    }

    public function upload_minio()
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
            'inputor' 	=> uniqid() . "_" . htmlentities($this->input->post('nama')),
            'date' 	=> date("F-Y"),
            'file_name1'    => uniqid() . "_" . $_FILES['ref_file1']['name'],
            'file_name2'    => uniqid() . "_" . $_FILES['ref_file2']['name'],
            'file_tmp1'   => $_FILES['ref_file1']['tmp_name'],
            'file_tmp2'   => $_FILES['ref_file2']['tmp_name'],
        );
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
    
            try {
                $s3client->putObject([
                    'Bucket' => $bucket_name,
                    'Key' => $data['date'] . "/" . $data['inputor'] . "/" . $data['file_name2'],
                    'SourceFile' => $data['file_tmp2']
                ]);
                echo "Uploaded to $bucket_name.\n";
            } catch (Exception $exception) {
                echo "Failed to upload with error: " . $exception->getMessage();
                exit("Please fix error with file upload before continuing.");
            }
    }

}
