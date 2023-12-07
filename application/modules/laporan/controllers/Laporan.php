<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    // Include librari PhpSpreadsheet
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // check_not_validate();
        // check_not_login();
        $this->load->model(['Maintenance_m','laporan/Laporan_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $jenis = $this->input->get('jenis');
            $jenis == 'PENDING' ? $desc = "PENDING" : ($jenis == 'REVIEW' ? $desc = 'REVIEW' : ($jenis == 'LAYAK' ? $desc = 'LAYAK' : $desc = 'TIDAK LAYAK'));
            $data = [
                'title'         => 'Laporan',
                'description'   => $desc,
                'jenis_laporan' => $jenis,
                'content'       => 'laporan/laporan' //user adalah nama module, user_data nama file di view yang akan di load
            ];
            $this->load->module('template');
            $this->template->index($data);
        }else{
            $this->load->view('maintenance');
        }
	}

    public function submit()
    {
        $post = $this->input->post(null, TRUE);
        // var_dump($post);
        // die();
        $this->Laporan_m->add($post);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil disimpan</div>');
            $data_session = array('cek_nik');
            $this->session->unset_userdata($data_session);
            redirect('dashboard');
        }
    }

    public function list_data()
    {
        $laporan = $this->input->post('jenis_laporan',TRUE);
        $list = $this->Laporan_m->get_datatables($laporan);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $usr) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $usr->nama;
            $row[] = $usr->nik;
            $row[] = $usr->status;
            $row[] = '<a data-id="'.$usr->nik.'" data-toggle="modal" class="open-editModal btn btn-info">Ubah Status</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Laporan_m->count_all(),
                    "recordsFiltered" => $this->Laporan_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        // var_dump($data);
        echo json_encode($output);
    }

    public function get_status($nik) {
        $record = $this->Laporan_m->get_status($nik);
        echo json_encode($record);
    }

    public function update_status() {
        $nik = $this->input->post('nik');
        $data = array(
            // 'nik' => $this->input->post('nik'),
            'status' => $this->input->post('status'),
            // Add other fields as needed
        );

        $this->Laporan_m->update_status($nik, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function export(){
        $post = $this->input->post();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "NO");
        $sheet->setCellValue('B1', "No KK");
        $sheet->setCellValue('C1', "NIK/KITAS/KITAP");
        $sheet->setCellValue('D1', "Nama Lengkap");
        $sheet->setCellValue('E1', "Hubungan Keluarga");
        $sheet->setCellValue('F1', "Tempat Lahir");
        $sheet->setCellValue('G1', "Tanggal Lahir");
        $sheet->setCellValue('H1', "Jenis Kelamin");
        $sheet->setCellValue('I1', "Status Kawin");
        $sheet->setCellValue('J1', "Alamat Tempat Tinggal");
        $sheet->setCellValue('K1', "RT");
        $sheet->setCellValue('L1', "RW");
        $sheet->setCellValue('M1', "Kode Pos");
        $sheet->setCellValue('N1', "Kode Kecamatan");
        $sheet->setCellValue('O1', "Nama Kecamatan");
        $sheet->setCellValue('P1', "Kode Desa");
        $sheet->setCellValue('Q1', "Nama Desa");
        $sheet->setCellValue('R1', "Nama Faskes");
        $sheet->setCellValue('S1', "Nama Faskes Dokter Gigi");
        $sheet->setCellValue('T1', "Nomor Telepon Peserta");
        $sheet->setCellValue('U1', "Email");
        $sheet->setCellValue('V1', "NPP");
        $sheet->setCellValue('W1', "Jabatan");
        $sheet->setCellValue('X1', "Status");
        $sheet->setCellValue('Y1', "Kelas Rawat");
        $sheet->setCellValue('Z1', "TMT Kerja");
        $sheet->setCellValue('AA1', "Gaji Pokok");
        $sheet->setCellValue('AB1', "Kewarganegaraan");
        $sheet->setCellValue('AC1', "No. Polis");
        $sheet->setCellValue('AD1', "Nama Asuransi");
        $sheet->setCellValue('AE1', "No. NPWP");
        $sheet->setCellValue('AF1', "No. Passport");
        $sheet->setCellValue('AG1', "Skor Kuesioner");
        $sheet->setCellValue('AH1', "Tanggal");
        $sheet->setCellValue('AI1', "Inputor");

        $laporan = $this->Laporan_m->laporan_bulanan($post)->result();
        if($laporan != null || $laporan != ''){
            $no = 1;
            $numrow = 2;
            foreach($laporan as $data){
                $sheet->setCellValue('A'.$numrow, $no);
                $sheet->setCellValue('B'.$numrow, $data->nomor_kk);
                $sheet->setCellValue('C'.$numrow, $data->nik);
                $sheet->setCellValue('D'.$numrow, $data->nama_lengkap);
                $sheet->setCellValue('E'.$numrow, $data->hubkel);
                $sheet->setCellValue('F'.$numrow, $data->tmpt_lahir);
                $sheet->setCellValue('G'.$numrow, $data->tgl_lahir);
                $sheet->setCellValue('H'.$numrow, $data->jenis_kelamin);
                $sheet->setCellValue('I'.$numrow, $data->status_kawin);
                $sheet->setCellValue('J'.$numrow, $data->alamat);
                $sheet->setCellValue('K'.$numrow, $data->rt);
                $sheet->setCellValue('L'.$numrow, $data->rw);
                $sheet->setCellValue('M'.$numrow, $data->kode_pos);
                $sheet->setCellValue('N'.$numrow, $data->kode_kecamatan);
                $sheet->setCellValue('O'.$numrow, $data->nama_kecamatan);
                $sheet->setCellValue('P'.$numrow, $data->kode_desa);
                $sheet->setCellValue('Q'.$numrow, $data->nama_desa);
                $sheet->setCellValue('R'.$numrow, $data->nama_faskes);
                $sheet->setCellValue('S'.$numrow, $data->nama_faskes_dokter_gigi);
                $sheet->setCellValue('T'.$numrow, $data->nomor_telepon_peserta);
                $sheet->setCellValue('U'.$numrow, $data->email);
                $sheet->setCellValue('V'.$numrow, $data->npp);
                $sheet->setCellValue('W'.$numrow, $data->jabatan);
                $sheet->setCellValue('X'.$numrow, $data->status);
                $sheet->setCellValue('Y'.$numrow, $data->kelas_rawat);
                $sheet->setCellValue('Z'.$numrow, $data->tmt_kerja);
                $sheet->setCellValue('AA'.$numrow, $data->gaji_pokok);
                $sheet->setCellValue('AB'.$numrow, $data->kewarganegaraan);
                $sheet->setCellValue('AC'.$numrow, $data->no_polis);
                $sheet->setCellValue('AD'.$numrow, $data->nama_asuransi);
                $sheet->setCellValue('AE'.$numrow, $data->no_npwp);
                $sheet->setCellValue('AF'.$numrow, $data->no_passport);
                $sheet->setCellValue('AG'.$numrow, $data->skor);
                $sheet->setCellValue('AH'.$numrow, $data->created_at);
                $sheet->setCellValue('AI'.$numrow, $data->created_by);
                
                $no++;
                $numrow++;
            }
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $judul_laporan = "Laporan-Usulan-PBI-JKN-" . $this->input->post('export_laporan') . date("d-m-Y") . ".xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=$judul_laporan"); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }else{
            echo "Data tidak ditemukan";
        }
    }
}
