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
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $this->load->view('pengajuan');
        }else{
            $this->load->view('maintenance');
        }
	}

    public function submit()
    {
        $bucket_name = getenv('MINIO_BUCKET');
        $data_minio = array(
            'inputor' 	                    => htmlentities($this->input->post('nama')) . "_" . htmlentities($this->input->post('nik')),
            'date' 	                        => date("F-Y"),
            'file_kk'                       => uniqid() . "_" . $_FILES['kartu_keluarga']['name'],
            'file_ktp'                      => uniqid() . "_" . $_FILES['ktp']['name'],
            'file_pas_foto'                 => uniqid() . "_" . $_FILES['pas_foto']['name'],
            'file_sktm'                     => uniqid() . "_" . $_FILES['sktm']['name'],
            'file_ijazah'                   => uniqid() . "_" . $_FILES['ijazah']['name'],
            'file_sertifikat_keahlian'      => uniqid() . "_" . $_FILES['sertifikat_keahlian']['name'],
            'file_domisili'                 => uniqid() . "_" . $_FILES['domisili']['name'],
            'file_foto_usaha'               => uniqid() . "_" . $_FILES['foto_usaha']['name'],
            'file_kk_tmp'                   => $_FILES['kartu_keluarga']['tmp_name'],
            'file_ktp_tmp'                  => $_FILES['ktp']['tmp_name'],
            'file_pas_foto_tmp'             => $_FILES['pas_foto']['tmp_name'],
            'file_sktm_tmp'                 => $_FILES['sktm']['tmp_name'],
            'file_ijazah_tmp'               => $_FILES['ijazah']['tmp_name'],
            'file_sertifikat_keahlian_tmp'  => $_FILES['sertifikat_keahlian']['tmp_name'],
            'file_domisili_tmp'             => $_FILES['domisili']['tmp_name'],
            'file_foto_usaha_tmp'           => $_FILES['foto_usaha']['tmp_name'],
        );

        $data = array(
            'nama' 	                        => htmlentities($this->input->post('nama')),
            'nik'                           => htmlentities($this->input->post('nik')),
            'umur'                          => htmlentities($this->input->post('umur')),
            'jenis_kelamin' 	            => htmlentities($this->input->post('jenis_kelamin')),
            'alamat_lengkap' 	            => htmlentities($this->input->post('alamat')),
            'agama' 	                    => htmlentities($this->input->post('agama')),
            'anak_ke' 	                    => htmlentities($this->input->post('anak_ke')),
            'pendidikan_terakhir' 	        => htmlentities($this->input->post('pendidikan_terakhir')),
            'status_pernikahan' 	        => htmlentities($this->input->post('status_pernikahan')),
            'pekerjaan' 	                => htmlentities($this->input->post('pekerjaan')),
            'jenis_layanan_diterima'        => htmlentities($this->input->post('jenis_layanan_diterima')) == 'LAINNYA' ? htmlentities($this->input->post('jenis_layanan_lainnya')) : htmlentities($this->input->post('jenis_layanan_diterima')),
            'jenis_kedisabilitasan'         => htmlentities($this->input->post('jenis_kedisabilitasan')),
            'no_telepon' 	                => htmlentities($this->input->post('no_telepon')),
            'program_rehabilitasi' 	        => htmlentities($this->input->post('program_rehabilitasi')),
            'nama_wali' 	                => htmlentities($this->input->post('nama_wali')),
            'alamat_wali' 	                => htmlentities($this->input->post('alamat_wali')),
            'pekerjaan_wali' 	            => htmlentities($this->input->post('pekerjaan_wali')),
            'penghasilan_wali' 	            => htmlentities($this->input->post('penghasilan')),
            'agama_wali' 	                => htmlentities($this->input->post('agama_wali')),
            'keluarga_wali' 	            => htmlentities($this->input->post('jumlah_anak')),
            'no_telepon_wali' 	            => htmlentities($this->input->post('nohp_wali')),
            'hubungan_ppks' 	            => htmlentities($this->input->post('hubungan_ppks')),
            'jenis_layanan' 	            => htmlentities($this->input->post('jenis_layanan')),
            'ref_file_kk' 	                => $data_minio['file_kk'],
            'ref_file_ktp' 	                => $data_minio['file_ktp'],
            'ref_file_pas_foto' 	        => $data_minio['file_pas_foto'],
            'ref_file_sktm' 	            => $data_minio['file_sktm'],
            'ref_file_ijazah' 	            => $data_minio['file_ijazah_tmp'] != "" ? $data_minio['file_ijazah'] : "",
            'ref_file_sertifikat_keahlian'  => $data_minio['file_sertifikat_keahlian_tmp'] != "" ? $data_minio['file_sertifikat_keahlian'] : "",
            'ref_file_domisili' 	        => $data_minio['file_domisili_tmp'] != "" ? $data_minio['file_domisili'] : "",
            'ref_file_foto_usaha' 	        => $data_minio['file_foto_usaha_tmp'] != "" ? $data_minio['file_foto_usaha'] : "",
            'status' 	                    => "PENDING",
            );
        
        $check_nik = $this->db->get_where('pengajuan_disabilitas', array('nik' => $this->input->post('nik')))->row_array();

        if(isset($check_nik['nik']) != $this->input->post('nik')){
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
                if(htmlentities($this->input->post('jenis_layanan')) == 'bimbingan pelatihan ketrampilan') {
                    try {
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_kk'],
                            'SourceFile' => $data_minio['file_kk_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ktp'],
                            'SourceFile' => $data_minio['file_ktp_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_pas_foto'],
                            'SourceFile' => $data_minio['file_pas_foto_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_sktm'],
                            'SourceFile' => $data_minio['file_sktm_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ijazah'],
                            'SourceFile' => $data_minio['file_ijazah_tmp']
                        ]);
                        echo "Uploaded to $bucket_name.\n";
                        $insert = $this->db->insert('pengajuan_disabilitas',$data);
                    } catch (Exception $exception) {
                        $this->db->set('error_message', $exception->getMessage());
                        $insert = $this->db->insert('log_error',$data);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data gagal ditambahkan, silakan coba beberapa saat lagi</div>');
                        redirect('pengajuan');
                    }
                } elseif(htmlentities($this->input->post('jenis_layanan')) == 'permohonan bursa kerja'){
                    try{
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_kk'],
                            'SourceFile' => $data_minio['file_kk_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ktp'],
                            'SourceFile' => $data_minio['file_ktp_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_pas_foto'],
                            'SourceFile' => $data_minio['file_pas_foto_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_sktm'],
                            'SourceFile' => $data_minio['file_sktm_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ijazah'],
                            'SourceFile' => $data_minio['file_ijazah_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_sertifikat_keahlian'],
                            'SourceFile' => $data_minio['file_sertifikat_keahlian_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_domisili'],
                            'SourceFile' => $data_minio['file_domisili_tmp']
                        ]);
                        echo "Uploaded to $bucket_name.\n";
                        $insert = $this->db->insert('pengajuan_disabilitas',$data);
                    } catch (Exception $exception) {
                        $this->db->set('error_message', $exception->getMessage());
                        $insert = $this->db->insert('log_error',$data);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data gagal ditambahkan, silakan coba beberapa saat lagi</div>');
                        redirect('pengajuan');
                    }
                } elseif(htmlentities($this->input->post('jenis_layanan')) == 'permohonan bantuan modal usaha'){
                    try {
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_kk'],
                            'SourceFile' => $data_minio['file_kk_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ktp'],
                            'SourceFile' => $data_minio['file_ktp_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_pas_foto'],
                            'SourceFile' => $data_minio['file_pas_foto_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_sktm'],
                            'SourceFile' => $data_minio['file_sktm_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ijazah'],
                            'SourceFile' => $data_minio['file_ijazah_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_foto_usaha'],
                            'SourceFile' => $data_minio['file_foto_usaha_tmp']
                        ]);
                        echo "Uploaded to $bucket_name.\n";
                        $insert = $this->db->insert('pengajuan_disabilitas',$data);
                    } catch (Exception $exception) {
                        $this->db->set('error_message', $exception->getMessage());
                        $insert = $this->db->insert('log_error',$data);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data gagal ditambahkan, silakan coba beberapa saat lagi</div>');
                        redirect('pengajuan');
                    }
                }else{
                    try {
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_kk'],
                            'SourceFile' => $data_minio['file_kk_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_ktp'],
                            'SourceFile' => $data_minio['file_ktp_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_pas_foto'],
                            'SourceFile' => $data_minio['file_pas_foto_tmp']
                        ]);
                        $s3client->putObject([
                            'Bucket' => $bucket_name,
                            'Key' => $data_minio['date'] . "/" . $data_minio['inputor'] . "/" . $data_minio['file_sktm'],
                            'SourceFile' => $data_minio['file_sktm_tmp']
                        ]);
                        echo "Uploaded to $bucket_name.\n";
                        $insert = $this->db->insert('pengajuan_disabilitas',$data);
                    } catch (Exception $exception) {
                        $this->db->set('error_message', $exception->getMessage());
                        $insert = $this->db->insert('log_error',$data);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data gagal ditambahkan, silakan coba beberapa saat lagi</div>');
                        redirect('pengajuan');
                    }
                }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil ditambahkan</div>');
            redirect('pengajuan');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>NIK sudah terdaftar</div>');
            redirect('pengajuan');
        }
    }

    public function search()
    {
        $data = $this->input->post();
        $check_nik = $this->db->get_where('pengajuan_disabilitas', array('nik' => $this->input->post('cek_nik')))->row_array();
        if(isset($check_nik) != $this->input->post('cek_nik')){
            echo json_encode(array('message'=>'<font color="red">NIK <b>'.$this->input->post('cek_nik').'</b> tidak terdaftar</font>'));
        }else{
            echo json_encode(array('message'=>'<font color="green">NIK <b>'.$this->input->post('cek_nik').'</b> sudah terdaftar dengan status '.$check_nik['status'].'</font>'));
        }
    }

}
